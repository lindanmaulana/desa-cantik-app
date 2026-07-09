<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class ProfileService
{
    public function updateProfile(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $user->fullname = $data['fullname'];

            if (!$user->save()) {
                throw new Exception('Gagal menyimpan pembaruan profil ke database.');
            }

            return $user;
        });
    }
}
