<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Msmes\StoreMsmeRequest;
use App\Http\Requests\Msmes\UpdateMsmeRequest;
use App\Models\Citizen;
use App\Models\Msme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MsmesController extends Controller
{
    /**
     * Display a listing of MSME business profiles with filters.
     */
    public function index(Request $request): View
    {
        $query = Msme::with('citizen');

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('license_number', 'like', "%{$search}%")
                    ->orWhereHas('citizen', function ($qc) use ($search) {
                        $qc->where('full_name', 'like', "%{$search}%")
                            ->orWhere('id_number', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('business_category')) {
            $query->where('business_category', $request->input('business_category'));
        }

        // Fetch paginated businesses
        $msmes = $query->latest()->paginate(10)->withQueryString();

        // Calculate card statistics
        $counts = (object) [
            'total_Msmes' => Msme::count(),
            'total_Employees' => Msme::sum('employee_count'),
            'total_Revenue' => Msme::sum('mothly_revenue') ?? 0.00,
        ];

        // Fetch all citizens to populate owner dropdown selections
        $citizens = Citizen::orderBy('full_name')->get();

        return view('dashboard.manage-data.msmes.index', compact('msmes', 'counts', 'citizens'));
    }

    /**
     * Store a newly created MSME business profile.
     */
    public function store(StoreMsmeRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // Generate primary UUID
            $validated['id'] = Str::uuid()->toString();

            Msme::create($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.msmes')->with('success', 'Profil UMKM berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan profil UMKM: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    /**
     * Update the specified MSME business profile.
     */
    public function update(UpdateMsmeRequest $request, Msme $msme): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $msme->update($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.msmes')->with('success', 'Profil UMKM berhasil diupdate!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal mengupdate profil UMKM: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $validated,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified MSME business profile from storage (soft delete).
     */
    public function destroy(Msme $msme): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $msme->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.msmes')->with('success', 'Profil UMKM berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus profil UMKM: ' . $err->getMessage(), [
                'msme_id' => $msme->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus profil. Silakan coba beberapa saat lagi.');
        }
    }
}
