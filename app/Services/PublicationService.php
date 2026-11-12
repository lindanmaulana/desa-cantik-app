<?php

namespace App\Services;

use App\Models\Publication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicationService
{
    public const CATEGORIES = [
        'profil-desa' => 'Profil Desa',
        'monografi-desa' => 'Monografi Desa',
        'infografis' => 'Infografis',
        'publikasi' => 'Publikasi',
        'metadata-statistik' => 'Metadata Statistik',
    ];

    public function publicList(array $filters): LengthAwarePaginator
    {
        return Publication::query()
            ->where('status', 'published')
            ->when($filters['category'] ?? null, fn ($query, $category) => $query->where('category', $category))
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('document_number', 'like', "%{$search}%");
                });
            })
            ->when($filters['year'] ?? null, fn ($query, $year) => $query->where('year', $year))
            ->latest('published_at')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function adminList(array $filters): LengthAwarePaginator
    {
        return Publication::query()
            ->when($filters['category'] ?? null, fn ($query, $category) => $query->where('category', $category))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['search'] ?? null, fn ($query, $search) => $query->where('title', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function years(): array
    {
        return Publication::query()->where('status', 'published')->distinct()->orderByDesc('year')->pluck('year')->all();
    }

    public function create(array $data, UploadedFile $file, ?UploadedFile $thumbnail, string $userId): Publication
    {
        return DB::transaction(function () use ($data, $file, $thumbnail, $userId) {
            unset($data['file'], $data['thumbnail']);
            $path = $file->store('publications/files', 'public');
            $thumbnailPath = $thumbnail?->store('publications/thumbnails', 'public');

            return Publication::create([
                ...$data,
                'slug' => Str::slug($data['title']) . '-' . Str::lower(Str::random(6)),
                'file_path' => $path,
                'file_original_name' => $file->getClientOriginalName(),
                'file_mime_type' => $file->getMimeType() ?: 'application/octet-stream',
                'file_size' => $file->getSize(),
                'thumbnail_path' => $thumbnailPath,
                'published_at' => $data['status'] === 'published' ? now() : null,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);
        });
    }

    public function update(Publication $publication, array $data, ?UploadedFile $file, ?UploadedFile $thumbnail, string $userId): Publication
    {
        return DB::transaction(function () use ($publication, $data, $file, $thumbnail, $userId) {
            if ($file) {
                Storage::disk('public')->delete($publication->file_path);
                $data['file_path'] = $file->store('publications/files', 'public');
                $data['file_original_name'] = $file->getClientOriginalName();
                $data['file_mime_type'] = $file->getMimeType() ?: 'application/octet-stream';
                $data['file_size'] = $file->getSize();
            }

            if ($thumbnail) {
                if ($publication->thumbnail_path) {
                    Storage::disk('public')->delete($publication->thumbnail_path);
                }
                $data['thumbnail_path'] = $thumbnail->store('publications/thumbnails', 'public');
            }

            $data['updated_by'] = $userId;
            $data['published_at'] = $data['status'] === 'published'
                ? ($publication->published_at ?: now())
                : null;
            unset($data['file'], $data['thumbnail']);
            $publication->update($data);

            return $publication->refresh();
        });
    }

    public function delete(Publication $publication): void
    {
        DB::transaction(function () use ($publication) {
            Storage::disk('public')->delete(array_filter([$publication->file_path, $publication->thumbnail_path]));
            $publication->delete();
        });
    }

    public function recordDownload(Publication $publication): void
    {
        $publication->increment('download_count');
    }
}
