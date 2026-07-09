<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\Controller;
use App\Services\Statistics\SpatialDataService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class SpatialDataController extends Controller
{
    public function __construct(protected SpatialDataService $spatialDataService) {}

    public function index(Request $request)
    {
        $isGenerated = $request->has('generated') || session('spatial_generated');
        $stats = [];
        $spatialData =new LengthAwarePaginator([], 0, 5);

        if ($isGenerated) {
            try {
                $stats = $this->spatialDataService->getSpatialStats();
                $spatialData = $this->spatialDataService->getSpatialRegistry(5, $request->query('search'));
            } catch (Exception $e) {
                Log::error('Gagal memuat statistik spasial: ' . $e->getMessage(), [
                    'exception' => $e
                ]);

                return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat memproses statistik data spasial.');
            }
        }

        return view('dashboard.statistics.spatial-data.index', compact('stats', 'spatialData', 'isGenerated'));
    }

    public function generate()
    {
        try {
            session(['spatial_generated' => true]);

            return redirect()->route('dashboard.statistics.spatial-data', ['generated' => 'true'])
                ->with('success', 'Agregat statistik spasial berhasil dihitung.');
        } catch (Exception $e) {
            Log::error('Gagal generate agregat spasial: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memulai proses hitung agregat.');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
