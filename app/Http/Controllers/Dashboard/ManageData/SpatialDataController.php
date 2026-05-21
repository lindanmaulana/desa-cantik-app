<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpatialData\StoreSpatialDataRequest;
use App\Http\Requests\SpatialData\UpdateSpatialDataRequest;
use App\Models\Citizen;
use App\Models\Infrastructure;
use App\Models\Msme;
use App\Models\SpatialData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SpatialDataController extends Controller
{
    public function index(Request $request): View
    {
        $query = SpatialData::query()->with('feature');

        // Apply filters
        if ($request->filled('feature_type')) {
            $query->where('feature_type', $request->input('feature_type'));
        }

        $spatialDataList = $query->latest()->paginate(10)->withQueryString();

        // Calculate card statistics
        $counts = SpatialData::selectRaw("COUNT(*) as total_Points, COUNT(CASE WHEN feature_type = 'resident_house' THEN 1 END) as houses_Count, COUNT(CASE WHEN feature_type = 'public_facility' THEN 1 END) as facilities_Count, COUNT(CASE WHEN feature_type = 'msme_location' THEN 1 END) as msmes_Count")->first();

        // Fetch select list items for the create/update dropdowns
        $citizens = Citizen::orderBy('full_name')->get();
        $infrastructures = Infrastructure::orderBy('facility_name')->get();
        $msmes = Msme::orderBy('business_name')->get();

        return view('dashboard.manage-data.spatial-data.index', compact(
            'spatialDataList',
            'counts',
            'citizens',
            'infrastructures',
            'msmes'
        ));
    }

    /**
     * Store a newly created spatial record.
     */
    public function store(StoreSpatialDataRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        // Handle geojson string parse
        if (!empty($validated['geojson'])) {
            $validated['geojson'] = json_decode($validated['geojson'], true);
        }

        DB::beginTransaction();

        try {
            $validated['id'] = Str::uuid()->toString();

            SpatialData::create($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.spatial-data')->with('success', 'Koordinat spasial GIS berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan koordinat spasial: ' . $err->getMessage(), [
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
     * Update the specified spatial record.
     */
    public function update(UpdateSpatialDataRequest $request, SpatialData $spatialData): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        // Handle geojson string parse
        if (!empty($validated['geojson'])) {
            $validated['geojson'] = json_decode($validated['geojson'], true);
        } else {
            $validated['geojson'] = null;
        }

        DB::beginTransaction();

        try {
            $spatialData->update($validated);

            DB::commit();

            return redirect()->route('dashboard.manage-data.spatial-data')->with('success', 'Koordinat spasial GIS berhasil diupdate!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal mengupdate koordinat spasial: ' . $err->getMessage(), [
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
     * Remove the specified spatial record.
     */
    public function destroy(SpatialData $spatialData): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $spatialData->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.spatial-data')->with('success', 'Koordinat spasial GIS berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus koordinat spasial: ' . $err->getMessage(), [
                'spatial_data_id' => $spatialData->id,
                'trace'           => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus koordinat. Silakan coba beberapa saat lagi.');
        }
    }
}
