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
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'sub_village' => 'nullable|in:pahing,pon,wage',
        ]);

        $query = Territory::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereAny([
                    'sub_village',
                    'area_name',
                    'rw',
                    'rt'
                ], 'like', "%{$search}%");
            });
        }

        if ($request->filled('sub_village')) {
            $query->where('sub_village', $request->sub_village);
        }

        $territories = $query->latest()->paginate(10)->withQueryString();

        $counts = Territory::selectRaw("
            COUNT(DISTINCT sub_village) as total_SubVillage,
            COUNT(DISTINCT rw) as total_RW,
            COUNT(DISTINCT rt) as total_RT
        ")->first();

        return view('dashboard.manage-data.territories.index', compact('territories', 'counts'));
    }

    public function create()
    {
        //
    }

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

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

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

    public function destroy(Territory $territory)
    {
        DB::beginTransaction();

        try {
            $territory->delete();

            DB::commit();

            return redirect()->route('dashboard.manage-data.territories')->with('success', 'Data Wilayah berhasil dihapus.');
        } catch (\Throwable $err) {
            DB::rollBack();

            Log::error('Gagal menghapus territory: ' . $err->getMessage(), [
                'territory_id' => $territory->id,
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal menghapus data wilayah. Data mungkin masih digunakan.');
        }
    }
}
