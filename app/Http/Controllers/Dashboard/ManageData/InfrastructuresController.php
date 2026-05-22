<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Infrastructures\StoreInfrastructureRequest;
use App\Http\Requests\Infrastructures\UpdateInfrastructureRequest;
use App\Models\Infrastructure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InfrastructuresController extends Controller
{
    /**
     * Display a listing of physical infrastructures with filters.
     */
    public function index(Request $request): View
    {
        $query = Infrastructure::query();

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('facility_name', 'like', "%{$search}%")
                  ->orWhere('funding_source', 'like', "%{$search}%");
            });
        }

        if ($request->filled('facility_type')) {
            $query->where('facility_type', $request->input('facility_type'));
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->input('condition'));
        }

        // Fetch paginated infrastructures
        $infrastructures = $query->latest()->paginate(10)->withQueryString();

        // Calculate card statistics
        $counts = (object) [
            'total_Assets' => Infrastructure::count(),
            'good_Condition' => Infrastructure::where('condition', 'good')->count(),
            'damaged_Assets' => Infrastructure::whereIn('condition', ['damaged_light', 'damaged_severe'])->count(),
        ];

        return view('dashboard.manage-data.infrastructures.index', compact('infrastructures', 'counts'));
    }

    /**
     * Store a newly created infrastructure profile.
     */
    public function store(StoreInfrastructureRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        // Mandated Fallback Rule: if condition is empty/blank, default to 'good'
        if (empty($validated['condition'])) {
            $validated['condition'] = 'good';
        }

        DB::beginTransaction();

        try {
            // Generate primary UUID
            $validated['id'] = Str::uuid()->toString();

            Infrastructure::create($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.infrastructures')->with('success', 'Aset infrastruktur berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan aset infrastruktur: ' . $err->getMessage(), [
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
     * Update the specified infrastructure profile.
     */
    public function update(UpdateInfrastructureRequest $request, Infrastructure $infrastructure): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $infrastructure->update($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.infrastructures')->with('success', 'Aset infrastruktur berhasil diupdate!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal mengupdate aset infrastruktur: ' . $err->getMessage(), [
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
     * Remove the specified infrastructure profile (soft delete).
     */
    public function destroy(Infrastructure $infrastructure): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $infrastructure->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.infrastructures')->with('success', 'Aset infrastruktur berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus aset infrastruktur: ' . $err->getMessage(), [
                'infrastructure_id' => $infrastructure->id,
                'trace'             => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus aset. Silakan coba beberapa saat lagi.');
        }
    }
}
