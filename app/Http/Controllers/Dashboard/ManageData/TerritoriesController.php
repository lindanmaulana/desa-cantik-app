<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Territories\getAllTerritoryRequest;
use App\Http\Requests\Territories\StoreTerritoryRequest;
use App\Http\Requests\Territories\UpdateTerritoryRequest;
use App\Models\Territory;
use App\Services\ManageData\TerritoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TerritoriesController extends Controller
{
    public function __construct(protected TerritoryService $territoryService) {}

    public function index(getAllTerritoryRequest $request)
    {

        $validated = $request->validated();
        $territories = $this->territoryService->getAll($validated);
        $rwList = $this->territoryService->getUniqueRwOptions();
        $counts = $this->territoryService->getCount();

        return view('dashboard.manage-data.territories.index', compact('territories', 'counts', 'rwList'));
    }

    public function create()
    {
        //
    }

    public function store(StoreTerritoryRequest $request)
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        try {
            $this->territoryService->create($validated);

            return redirect()->back()->with('success', 'Data Wilayah berhasil ditambahkan!');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan territory: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(UpdateTerritoryRequest $request, Territory $territory): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        try {
            $this->territoryService->update($territory, $validated);

            return redirect()->back()->with('success', 'Data Wilayah berhasil di perbarui.');
        } catch (\Throwable $err) {
            Log::error('Gagal memperbarui territory: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'territory_id' => $territory->id,
                'sub_village' => $territory->sub_village,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal memperbarui data wilayah');
        }
    }

    public function destroy(Territory $territory)
    {
        try {
            $this->territoryService->delete($territory);

            return redirect()->back()->with('success', 'Data Wilayah berhasil dihapus.');
        } catch (\Throwable $err) {
            Log::error('Gagal menghapus territory: ' . $err->getMessage(), [
                'territory_id' => $territory->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus data wilayah. Data mungkin masih digunakan.');
        }
    }
}
