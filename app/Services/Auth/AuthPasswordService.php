<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthPasswordService
{
    public function updatePassword(User $user, array $data): void
    {
        DB::transaction(function () use ($user, $data) {
            $user->password = Hash::make($data['password']);

            if (!$user->save()) {
                throw new Exception('Gagal menyimpan kata sandi baru ke database.');
            }
        });
    }
}
