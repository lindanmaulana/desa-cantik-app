<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreAdminRequest;
use App\Http\Requests\Users\UpdateAdminRequest;
use App\Models\Citizen;
use App\Models\User;
use App\Services\SuperAdmin\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ManageAdminController extends Controller
{
    public function __construct(protected AdminService $adminService) {}

    public function index()
    {
        $users = User::whereIn('role', [UserRole::ADMIN->value])
            ->latest()
            ->paginate(10);

        $registeredUsernames = User::pluck('username')->toArray();
        $citizens = Citizen::whereNotIn('id', $registeredUsernames)
            ->orderBy('full_name', 'asc')
            ->get();

        return view('dashboard.super-admin.manage-admins.index', compact('users', 'citizens'));
    }

    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->adminService->createAdmin($validated);

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

    public function update(UpdateAdminRequest $request, string $id)
    {
        $validated = $request->validated();

        try {
            $this->adminService->updateAdmin($id, $validated);

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
            $this->adminService->deleteUser($id);

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
