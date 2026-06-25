<?php

namespace App\Services\SuperAdmin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class AdminService
{
    /**
     * Membuat akun user/pengelola baru dengan database transaction.
     */
    public function createAdmin(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $password = !empty($data['password'])
                ? Hash::make($data['password'])
                : Hash::make('resident');

            return User::create([
                'username'     => $data['username'],
                'fullname'    => $data['fullname'],
                'role'         => $data['role'],
                'territory_id' => $data['territory_id'] ?? null,
                'password'     => $password,
            ]);
        });
    }

    /**
     * Memperbarui data user/pengelola dengan database transaction.
     */
    public function updateAdmin(string $id, array $data): User
    {
        return DB::transaction(function () use ($id, $data) {
            $user = User::findOrFail($id);

            $updateData = [
                'fullname'    => $data['fullname'],
                'role'         => $data['role'],
                'territory_id' => $data['territory_id'] ?? null,
            ];

            // Update password hanya jika kolom diisi
            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $user->update($updateData);

            return $user;
        });
    }

    /**
     * Menghapus user/pengelola dengan database transaction (Soft Delete).
     */
    public function deleteUser(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            return $user->delete();
        });
    }
}
