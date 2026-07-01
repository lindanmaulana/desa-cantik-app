<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreOperatorRequest;
use App\Http\Requests\Users\UpdateOperatorRequest;
use App\Models\Citizen;
use App\Models\User;
use App\Services\Admin\OperatorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManageOperatorController extends Controller
{
  public function __construct(protected OperatorService $operatorService) {}

  public function index()
  {
    $users = User::whereIn('role', [UserRole::OPERATOR->value])
      ->latest()
      ->paginate(10);

    $registeredUsernames = User::pluck('username')->toArray();
    $citizens = Citizen::whereNotIn('id', $registeredUsernames)
      ->orderBy('full_name', 'asc')
      ->get();

    return view('dashboard.admin.manage-operators.index', compact('users', 'citizens'));
  }

  public function store(StoreOperatorRequest $request)
  {
    $validated = $request->validated();

    try {
      $this->operatorService->createOperator($validated);

      return redirect()->back()->with('success', 'Akun pengelola berhasil didaftarkan.');
    } catch (\Throwable $err) {
      Log::error('Gagal mendaftarkan akun pengelola baru: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'payload' => $request->except(['password', 'password_confirmation']),
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
    }
  }

  public function update(UpdateOperatorRequest $request, string $id)
  {
    $validated = $request->validated();

    try {
      $this->operatorService->updateOperator($id, $validated);

      return redirect()->back()->with('success', 'Data akun pengelola berhasil diperbarui.');
    } catch (\Throwable $err) {
      Log::error('Gagal memperbarui data akun pengelola: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'target_id' => $id,
        'payload' => $request->except(['password']),
        'trace'   => $err->getTraceAsString()
      ]);

      return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
    }
  }

  public function destroy(string $id)
  {
    try {
      $this->operatorService->deleteUser($id);

      return redirect()->back()->with('success', 'Akun pengelola berhasil dinonaktifkan.');
    } catch (\Throwable $err) {
      Log::error('Gagal menonaktifkan akun pengelola: ' . $err->getMessage(), [
        'user_id' => Auth::id(),
        'target_id' => $id,
        'trace'   => $err->getTraceAsString()
      ]);

      return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Gagal menonaktifkan akun.');
    }
  }
}
