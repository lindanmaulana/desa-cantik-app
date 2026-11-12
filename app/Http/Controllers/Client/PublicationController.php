<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\PublicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function __construct(protected PublicationService $publicationService) {}

    public function index(Request $request, ?string $category = null)
    {
        abort_if($category && !array_key_exists($category, PublicationService::CATEGORIES), 404);

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
        ]);
        $filters['category'] = $category;
        $publications = $this->publicationService->publicList($filters);

        return view('client.publications.index', [
            'publications' => $publications,
            'category' => $category,
            'categories' => PublicationService::CATEGORIES,
            'years' => $this->publicationService->years(),
        ]);
    }

    public function download(string $publication)
    {
        $document = \App\Models\Publication::where('status', 'published')->findOrFail($publication);
        abort_unless(Storage::disk('public')->exists($document->file_path), 404);
        $this->publicationService->recordDownload($document);

        return Storage::disk('public')->download($document->file_path, $document->file_original_name);
    }

    public function preview(string $publication)
    {
        $document = \App\Models\Publication::where('status', 'published')->findOrFail($publication);
        abort_unless(Storage::disk('public')->exists($document->file_path), 404);

        return response()->file(Storage::disk('public')->path($document->file_path), [
            'Content-Disposition' => 'inline; filename="' . addslashes($document->file_original_name) . '"',
        ]);
    }
}
