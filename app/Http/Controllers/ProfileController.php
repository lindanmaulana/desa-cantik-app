<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\Auth\AuthPasswordService;
use App\Services\Profile\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Exception;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService, protected AuthPasswordService $passwordService) {}
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.profile.index', compact('user'));
    }

    public function edit(Request $request) {}

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        try {
            $this->profileService->updateProfile(
                $request->user(),
                $request->validated()
            );

            return Redirect::back()->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        try {
            $this->passwordService->updatePassword(
                $request->user(),
                $request->validated()
            );

            return Redirect::back()->with('success', 'Kata sandi Anda berhasil diperbarui.');
        } catch (Exception $e) {
            return Redirect::back()->with('error', 'Terjadi kesalahan saat memperbarui kata sandi.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
