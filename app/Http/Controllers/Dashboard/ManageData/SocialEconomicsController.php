<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialEconomics\StoreSocialEconomicRequest;
use App\Http\Requests\SocialEconomics\UpdateSocialEconomicRequest;
use App\Models\Citizen;
use App\Models\SocialEconomic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SocialEconomicsController extends Controller
{
    public function index(Request $request): View
    {
        $query = SocialEconomic::with('citizen');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('citizen', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('id_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->input('education_level'));
        }

        if ($request->filled('house_condition')) {
            $query->where('house_condition', $request->input('house_condition'));
        }

        if ($request->filled('economic_status')) {
            $query->where('economic_status', $request->input('economic_status'));
        }

        if ($request->filled('is_welfare_recipient')) {
            $query->where('is_welfare_recipient', $request->input('is_welfare_recipient') === '1');
        }

        // Fetch paginated profiles
        $profiles = $query->latest()->paginate(10)->withQueryString();

        // Calculate card statistics
        $counts = (object) [
            'total_Profiles' => SocialEconomic::count(),
            'total_Recipients' => SocialEconomic::where('is_welfare_recipient', true)->count(),
            'average_Income' => SocialEconomic::avg('monthly_income') ?? 0.00,
        ];

        $citizens = Citizen::orderBy('full_name')->get();

        return view('dashboard.manage-data.social-economics.index', compact('profiles', 'counts', 'citizens'));
    }

    /**
     * Store a newly created social economic profile.
     */
    public function store(StoreSocialEconomicRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // Generate primary UUID
            $validated['id'] = Str::uuid()->toString();

            SocialEconomic::create($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.social-economics')->with('success', 'Profil Sosial Ekonomi berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan profil sosial ekonomi: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function update(UpdateSocialEconomicRequest $request, SocialEconomic $socialEconomic): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $socialEconomic->update($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.social-economics')->with('success', 'Profil Sosial Ekonomi berhasil diupdate!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal mengupdate profil sosial ekonomi: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $validated,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function destroy(SocialEconomic $socialEconomic): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $socialEconomic->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.social-economics')->with('success', 'Profil Sosial Ekonomi berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus profil sosial ekonomi: ' . $err->getMessage(), [
                'profile_id' => $socialEconomic->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus profil. Silakan coba beberapa saat lagi.');
        }
    }
}
