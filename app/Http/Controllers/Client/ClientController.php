<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\VillageSettings\UpdateSopDiagramRequest;
use App\Services\Admin\VillageSettingService;
use App\Services\Statistics\DemographService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
  public function __construct(
    protected DemographService $demographService,
    protected VillageSettingService $villageSettingService
  ) {}

  public function index()
  {
    return view('index');
  }
  public function spacialData()
  {
    return view('client.spacial-data');
  }
  public function analisis()
  {
    return view('client.analisis');
  }
  public function sop()
  {
    return view('client.sop');
  }

  public function updateSopDiagram(UpdateSopDiagramRequest $request)
  {
    try {
      $this->villageSettingService->updateSopDiagram($request->file('sop_diagram'));

      return back()->with('success', 'Diagram SOP berhasil diperbarui.');
    } catch (\Throwable $err) {
      Log::error('Gagal memperbarui diagram SOP: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'trace' => $err->getTraceAsString(),
      ]);

      return back()->with('error', 'Gagal memperbarui diagram SOP. Silakan coba lagi.');
    }
  }

  public function deleteSopDiagram()
  {
    try {
      $this->villageSettingService->deleteSopDiagram();

      return back()->with('success', 'Diagram SOP berhasil dihapus.');
    } catch (\Throwable $err) {
      Log::error('Gagal menghapus diagram SOP: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'trace' => $err->getTraceAsString(),
      ]);

      return back()->with('error', 'Gagal menghapus diagram SOP. Silakan coba lagi.');
    }
  }
}
