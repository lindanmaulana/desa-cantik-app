<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildGrowthLogs\StoreChildGrowthLogRequest;
use App\Http\Requests\ChildGrowthLogs\UpdateChildGrowthLogRequest;
use App\Models\Citizen;
use App\Services\ManageData\ChildGrowthLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChildGrowthLogsController extends Controller
{
    public function __construct(protected ChildGrowthLogService $childGrowthLogService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Citizen $citizen, StoreChildGrowthLogRequest $request)
    {
        $validated = $request->validated();
        $validated['recorded_by'] = Auth::id();

        try {
            $this->childGrowthLogService->create($citizen, $validated);

            return redirect()->back()->with('success', 'Data log perkembangan balita berhasil disimpan.');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan data profil pendidikan: ' . $err->getMessage(), [
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Citizen $citizen, UpdateChildGrowthLogRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->childGrowthLogService->update($citizen, $validated);

            return redirect()->back()->with('success', 'Data log perkembangan balita berhasil diperbarui.');
        } catch (\Throwable $err) {
            Log::error('Gagal memperbarui data log perkembangan balita: ' . $err->getMessage(), [
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
    public function destroy(string $id)
    {
        //
    }
}
