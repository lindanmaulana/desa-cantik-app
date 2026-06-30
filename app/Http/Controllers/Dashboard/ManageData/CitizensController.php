<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Http\Requests\Citizens\GetAllCitizenRequest;
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
use App\Services\ManageData\FamilyService;

class CitizensController extends Controller
{
  public function __construct(protected CitizenService $citizenService, protected FamilyService $familyService) {}

  public function index(GetAllCitizenRequest $request)
  {
    $validated = $request->validated();

    $citizens = $this->citizenService->getAll($validated);
    $families = $this->familyService->getFamilies();
    $counts = $this->citizenService->getStats();

    return view('dashboard.manage-data.citizens.index', compact('citizens', 'families', 'counts'));
  }


  public function create() {}

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
    $citizen = $this->citizenService->getDetail($citizen);

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

    try {
      $this->citizenService->update($citizen, $validated);

      return redirect()->back()->with('success', 'Data Warga berhasil diupdate!');
    } catch (\Throwable $err) {
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
    try {
      $this->citizenService->delete($citizen);

      return redirect()->back()->with('success', 'Data Warga berhasil dihapus.');
    } catch (\Throwable $err) {

      Log::error('Gagal menghapus warga: ' . $err->getMessage(), [
        'citizen_id' => $citizen->id,
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->with('error', 'Gagal menghapus data warga. Data mungkin masih digunakan.');
    }
  }
}
