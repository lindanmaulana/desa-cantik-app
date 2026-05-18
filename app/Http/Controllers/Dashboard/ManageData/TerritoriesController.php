<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Territories\StoreTerritoryRequest;
use App\Http\Requests\Territories\UpdateTerritoryRequest;
use App\Models\Territory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Str;

class TerritoriesController extends Controller
{
    /**
     * Display a listing of the resource.e
     */
    public function index()
    {
        $territories = Territory::latest()->paginate(10);

        // dd($territories->toArray());

        return view('dashboard.manage-data.territories.index', compact('territories'));
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
    public function store(StoreTerritoryRequest $request)
    {
        $currentUser = Auth::user();
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $validated['id'] = Str::uuid()->toString();

            Territory::create($validated);

            DB::commit();

            return redirect()
                ->route('dashboard.manage-data.territories')
                ->with('success', 'Data Wilayah berhasil ditambahkan!');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menyimpan territory: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
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
    public function update(UpdateTerritoryRequest $request, Territory $territory): RedirectResponse
    {
        $currentUser = Auth::user();
        DB::beginTransaction();

        try {
            $territory->update($request->validated());

            DB::commit();

            return redirect()->route('dashboard.manage-data.territories')->with('success', 'Data Wilayah berhasil di perbarui.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal memperbarui territory: ' . $err->getMessage(), [
                'user_id' => $currentUser->id,
                'territory_id' => $territory->id,
                'sub_village' => $territory->sub_village,
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal memperbarui data wilayah');
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
