<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Families\StoreFamilyRequest;
use App\Http\Requests\Families\UpdateFamilyRequest;
use App\Http\Requests\Families\GetAllFamilyRequest;
use App\Models\Family;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\ManageData\FamilyService;
use App\Services\ManageData\TerritoryService;
use Illuminate\Support\Facades\Log;

class FamiliesController extends Controller
{
  public function __construct(protected FamilyService $familyService, protected TerritoryService $territoryService) {}

  public function index(GetAllFamilyRequest $request)
  {
    $validated = $request->validated();
    $families = $this->familyService->getAll($validated);
    $territories = $this->territoryService->getAllTerritories();
    $counts = $this->familyService->getStats();

    return view('dashboard.manage-data.families.index', compact('families', 'territories', 'counts'));
  }


  public function create() {}

  public function store(StoreFamilyRequest $request)
  {
    $currentUser = Auth::user();
    $validated = $request->validated();

    try {
      $this->familyService->create($validated);

      return redirect()->back()->with('success', 'Data Keluarga berhasil ditambahkan!');
    } catch (\Throwable $err) {
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

  public function edit(string $id) {}

  public function update(UpdateFamilyRequest $request, Family $family): RedirectResponse
  {
    $currentUser = Auth::user();
    $validated = $request->validated();

    try {
      $this->familyService->update($family, $validated);
      return redirect()->back()->with('success', 'Data Keluarga berhasil diperbarui.');
    } catch (\Throwable $err) {
      Log::error('Gagal memperbarui keluarga: ' . $err->getMessage(), [
        'user_id' => $currentUser->id,
        'family_id' => $family->id,
        'payload' => $request->all(),
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->withInput()->with('error', 'Gagal memperbarui data keluarga.');
    }
  }

  public function destroy(Family $family): RedirectResponse
  {
    try {
      $this->familyService->delete($family);

      return redirect()->back()->with('success', 'Data Keluarga berhasil dihapus.');
    } catch (\Throwable $err) {
      Log::error('Gagal menghapus keluarga: ' . $err->getMessage(), [
        'family_id' => $family->id,
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->with('error', 'Gagal menghapus data keluarga. Data mungkin masih digunakan.');
    }
  }
}
