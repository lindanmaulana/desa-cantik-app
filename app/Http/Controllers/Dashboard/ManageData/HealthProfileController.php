<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthProfiles\StoreHealthProfileRequest;
use App\Http\Requests\HealthProfiles\UpdateHealthProfileRequest;
use App\Models\Citizen;
use App\Services\ManageData\HealthProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class HealthProfileController extends Controller
{
  public function __construct(protected HealthProfileService $healthProfileService) {}
  /**
   * Display a listing of the resource.
   */
  public function index() {}

  /**
   * Show the form for creating a new resource.
   */
  public function create() {}

  /**
   * Store a newly created resource in storage.
   */
  public function store(Citizen $citizen, StoreHealthProfileRequest $request)
  {
    $validated = $request->validated();

    try {
      $this->healthProfileService->create($citizen, $validated);

      return redirect()->back()->with('success', 'Data kesehatan individu berhasil ditambahkan.');
    } catch (\Throwable $err) {
      Log::error('Gagal menyimpan data kesehatan individu: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'payload' => $request->all(),
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id) {}

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id) {}

  /**
   * Update the specified resource in storage.
   */
  public function update(Citizen $citizen, UpdateHealthProfileRequest $request)
  {
    $validated = $request->validated();

    try {
      $this->healthProfileService->update($citizen, $validated);

      return redirect()->back()->with('success', 'Data kesehatan individu berhasil diperbarui.');
    } catch (\Throwable $err) {
      Log::error('Gagal memperbarui data kesehatan individu: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'payload' => $request->all(),
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id) {}
}
