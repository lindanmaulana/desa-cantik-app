<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Infrastructures\GetAllInfrastructureRequest;
use App\Http\Requests\Infrastructures\StoreInfrastructureRequest;
use App\Http\Requests\Infrastructures\UpdateInfrastructureRequest;
use App\Models\Infrastructure;
use App\Services\ManageData\InfrastructureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InfrastructuresController extends Controller
{

    public function __construct(protected InfrastructureService $infrastructureService) {}


    public function index(GetAllInfrastructureRequest $request): View
    {
        $validated = $request->validated();
        $infrastructures = $this->infrastructureService->getAll($validated);
        $counts = $this->infrastructureService->getStats();

        return view('dashboard.manage-data.infrastructures.index', compact('infrastructures', 'counts'));
    }

    public function store(StoreInfrastructureRequest $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        if (empty($validated['condition'])) {
            $validated['condition'] = 'good';
        }

        try {

            $this->infrastructureService->create($validated);

            return redirect()->back()->with('success', 'Aset infrastruktur berhasil ditambahkan!');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan aset infrastruktur: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function update(UpdateInfrastructureRequest $request, Infrastructure $infrastructure): RedirectResponse
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        try {
            $this->infrastructureService->update($infrastructure, $validated);

            return redirect()->back()->with('success', 'Aset infrastruktur berhasil diupdate!');
        } catch (\Throwable $err) {
            Log::error('Gagal mengupdate aset infrastruktur: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $validated,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function destroy(Infrastructure $infrastructure): RedirectResponse
    {
        try {
            $this->infrastructureService->delete($infrastructure);

            return redirect()->back()->with('success', 'Aset infrastruktur berhasil dihapus.');
        } catch (\Throwable $err) {
            Log::error('Gagal menghapus aset infrastruktur: ' . $err->getMessage(), [
                'infrastructure_id' => $infrastructure->id,
                'trace'             => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus aset. Silakan coba beberapa saat lagi.');
        }
    }
}
