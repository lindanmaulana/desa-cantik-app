<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Families\StoreFamilyRequest;
use App\Http\Requests\Families\UpdateFamilyRequest;
use App\Models\Family;
use App\Models\Territory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FamiliesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'territory_id' => 'nullable|exists:territories,id',
        ]);

        $query = Family::with(['territory', 'citizens']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereAny([
                    'family_card_number'
                ], 'like', "%{$search}%")
                    ->orWhereHas('territory', function ($qt) use ($search) {
                        $qt->whereAny([
                            'sub_village',
                            'area_name',
                        ], 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('territory_id')) {
            $query->where('territory_id', $request->territory_id);
        }

        $families = $query->latest()->paginate(10)->withQueryString();

        $territories = Territory::all();

        $counts = (object) DB::selectOne("SELECT (SELECT COUNT(*) FROM families) as total_Families, (SELECT COUNT(DISTINCT sub_village) FROM territories) as total_SubVillage, (SELECT COUNT(*) FROM citizens) as total_Citizens");

        return view('dashboard.manage-data.families.index', compact('families', 'territories', 'counts'));
    }


    public function create()
    {
        //
    }

    public function store(StoreFamilyRequest $request)
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $validated['id'] = Str::uuid()->toString();

            Family::create($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.families')->with('success', 'Data Keluarga berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan keluarga: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function show(Family $family)
    {
        $family->load([
            'territory',
            'housingProfile',
            'citizens' => function ($query) {
                $query->orderBy('family_role', 'asc');
            }
        ]);

        return view('dashboard.manage-data.families.detail', compact('family'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(UpdateFamilyRequest $request, Family $family): RedirectResponse
    {
        $currentUser = Auth::user();
        DB::beginTransaction();

        try {
            $family->update($request->validated());

            DB::commit();

            return redirect()->route('dashboard.manage-data.families')->with('success', 'Data Keluarga berhasil diperbarui.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal memperbarui keluarga: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'family_id' => $family->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal memperbarui data keluarga.');
        }
    }

    public function destroy(Family $family): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $family->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.families')->with('success', 'Data Keluarga berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus keluarga: ' . $err->getMessage(), [
                'family_id' => $family->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus data keluarga. Data mungkin masih digunakan.');
        }
    }
}
