<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Citizens\StoreCitizenRequest;
use App\Models\Citizen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Citizens\UpdateCitizenRequest;
use App\Models\Family;
use App\Services\ManageData\CitizenService;

class CitizensController extends Controller
{
    public function __construct(protected CitizenService $citizenService) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'religion' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'family_id' => 'nullable|exists:families,id',
        ]);

        $query = Citizen::with([
            'family',
            'educationProfile',
            'employmentProfile',
            'healthProfile',
            'childGrowthLogs'
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_number', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        if ($request->filled('family_id')) {
            $query->where('family_id', $request->family_id);
        }

        $citizens = $query->latest()->paginate(10)->withQueryString();

        $families = Family::all();

        $counts = (object) [
            'total_Citizens' => Citizen::count(),
            'total_Male' => Citizen::where('gender', Gender::MALE)->count(),
            'total_Female' => Citizen::where('gender', Gender::FEMALE)->count(),
        ];

        return view('dashboard.manage-data.citizens.index', compact('citizens', 'families', 'counts'));
    }


    public function create()
    {
        //
    }

    public function store(StoreCitizenRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->citizenService->create($validated);
            return redirect()->route('dashboard.manage-data.citizens')->with('success', 'Data Warga berhasil ditambahkan!');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan warga: ' . $err->getMessage(), [
                'user_id' => Auth::id(),
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function show(Citizen $citizen)
    {
        $citizen->load([
            'family',
            'educationProfile',
            'employmentProfile',
            'healthProfile',
            'childGrowthLogs' => function ($query) {
                $query->latest()->limit(3);
            }
        ]);

        return view('dashboard.manage-data.citizens.detail', compact('citizen'));
    }

    public function edit(Citizen $citizen)
    {
        return view('dashboard.manage-data.citizens.detail', compact('citizen'));
    }

    public function update(UpdateCitizenRequest $request, Citizen $citizen)
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $citizen->update($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.citizens')->with('success', 'Data Warga berhasil diupdate!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal mengupdate warga: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $validated,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function destroy(Citizen $citizen): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $citizen->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.citizens')->with('success', 'Data Warga berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus warga: ' . $err->getMessage(), [
                'citizen_id' => $citizen->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus data warga. Data mungkin masih digunakan.');
        }
    }

    //     public function store(StoreCitizenRequest $request)
    // {
    //     $currentUser = Auth::user();
    //     $validated = $request->validated();

    //     DB::beginTransaction();

    //     try {
    //         $validated['id'] = Str::uuid()->toString();
    //         $citizenData = $request->only(
    //             'id',
    //             'full_name',
    //             'id_number',
    //             'family_card_number',
    //             'gender',
    //             'birth_place',
    //             'birth_date',
    //             'religion',
    //             'marital_status'
    //         );
    //         $citizen = Citizen::create($citizenData);

    //         $citizen->educationProfile()->create($request->only(['education_level', 'highest_diploma', 'school_participation']));

    //         $citizen->employmentProfile()->create($request->only([
    //             'occupation',
    //             'job_sector',
    //             'employment_status',
    //             'monthly_income',
    //             'economic_status',
    //             'is_welfare_recipient',
    //             'assistance_type'
    //         ]));

    //         $citizen->healthProfile()->create($request->only([
    //             'disability_type',
    //             'is_pregnant',
    //             'kb_method',
    //             'bpjs_status'
    //         ]));

    //         $citizen->housingProfile()->create($request->only([
    //             'house_ownership',
    //             'house_condition',
    //             'floor_material',
    //             'wall_material',
    //             'roof_material',
    //             'water_source',
    //             'sanitation_type',
    //             'cooking_fuel',
    //             'electricity_source',
    //             'electricity_capacity'
    //         ]));

    //         DB::commit();

    //         return redirect()->route('dashboard.manage-data.citizens')->with('success', 'Data Warga berhasil ditambahkan!');
    //     } catch (\Throwable $err) {
    //         DB::rollBack();

    //         Log::error('Gagal menyimpan warga: ' . $err->getMessage(), [
    //             'user_id' => $currentUser->id,
    //             'payload' => $request->all(),
    //             'trace'   => $err->getTraceAsString()
    //         ]);

    //         return back()
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
    //     }
    // }
}
