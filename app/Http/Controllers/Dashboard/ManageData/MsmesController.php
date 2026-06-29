<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Msmes\GetAllMsmeRequest;
use App\Http\Requests\Msmes\StoreMsmeRequest;
use App\Http\Requests\Msmes\UpdateMsmeRequest;
use App\Models\Msme;
use App\Services\ManageData\CitizenService;
use App\Services\ManageData\MsmeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MsmesController extends Controller
{
    public function __construct(protected MsmeService $msmeService, protected CitizenService $citizenService) {}

    public function index(GetAllMsmeRequest $request): View
    {
        $validated = $request->validated();
        $msmes = $this->msmeService->getAll($validated);
        $counts = $this->msmeService->getStats();
        $citizens = $this->citizenService->getCitizenOptions();

        return view('dashboard.manage-data.msmes.index', compact('msmes', 'counts', 'citizens'));
    }

    public function store(StoreMsmeRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        try {
            $this->msmeService->create($validated);

            return redirect()->back()->with('success', 'Profile UMKM berhasil ditambahkan!');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan Profile UMKM: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function update(UpdateMsmeRequest $request, Msme $msme): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();
        try {
            $this->msmeService->update($msme, $validated);

            return redirect()->back()->with('success', 'Profil UMKM berhasil diupdate!');
        } catch (\Throwable $err) {
            Log::error('Gagal mengupdate profil UMKM: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $validated,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function destroy(Msme $msme): RedirectResponse
    {
        try {
            $this->msmeService->delete($msme);

            return redirect()->back()->with('success', 'Profil UMKM berhasil dihapus.');
        } catch (\Throwable $err) {
            Log::error('Gagal menghapus profil UMKM: ' . $err->getMessage(), [
                'msme_id' => $msme->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus profil. Silakan coba beberapa saat lagi.');
        }
    }
}
