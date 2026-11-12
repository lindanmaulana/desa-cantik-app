<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\StorePublicationRequest;
use App\Http\Requests\Publication\UpdatePublicationRequest;
use App\Models\Publication;
use App\Services\PublicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PublicationController extends Controller
{
    public function __construct(protected PublicationService $publicationService) {}

    public function index(Request $request): View
    {
        $publications = $this->publicationService->adminList($request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'in:profil-desa,monografi-desa,infografis,publikasi,metadata-statistik'],
            'status' => ['nullable', 'in:draft,published,archived'],
        ]));

        return view('dashboard.publications.index', [
            'publications' => $publications,
            'categories' => PublicationService::CATEGORIES,
        ]);
    }

    public function store(StorePublicationRequest $request): RedirectResponse
    {
        try {
            $this->publicationService->create(
                $request->validated(),
                $request->file('file'),
                $request->file('thumbnail'),
                Auth::id()
            );

            return back()->with('success', 'Dokumen berhasil ditambahkan.');
        } catch (\Throwable $exception) {
            Log::error('Gagal menambahkan dokumen publikasi.', ['user_id' => Auth::id(), 'message' => $exception->getMessage()]);

            return back()->withInput()->with('error', 'Dokumen belum dapat ditambahkan.');
        }

    }

    public function edit(Publication $publication): View
    {
        return view('dashboard.publications.edit', [
            'publication' => $publication,
            'categories' => PublicationService::CATEGORIES,
        ]);
    }

    public function update(UpdatePublicationRequest $request, Publication $publication): RedirectResponse
    {
        try {
            $this->publicationService->update(
                $publication,
                $request->validated(),
                $request->file('file'),
                $request->file('thumbnail'),
                Auth::id()
            );

            return back()->with('success', 'Dokumen berhasil diperbarui.');
        } catch (\Throwable $exception) {
            Log::error('Gagal memperbarui dokumen publikasi.', ['publication_id' => $publication->id, 'message' => $exception->getMessage()]);

            return back()->withInput()->with('error', 'Dokumen belum dapat diperbarui.');
        }
    }

    public function destroy(Publication $publication): RedirectResponse
    {
        try {
            $this->publicationService->delete($publication);

            return back()->with('success', 'Dokumen berhasil dihapus.');
        } catch (\Throwable $exception) {
            Log::error('Gagal menghapus dokumen publikasi.', ['publication_id' => $publication->id, 'message' => $exception->getMessage()]);

            return back()->with('error', 'Dokumen belum dapat dihapus.');
        }
    }
}
