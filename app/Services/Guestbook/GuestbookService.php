<?php

namespace App\Services\Guestbook;

use App\Models\GuestbookEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuestbookService
{
    public function getStats(): object
    {
        return (object) [
            'total' => GuestbookEntry::count(),
            'pending' => GuestbookEntry::where('status', 'pending')->count(),
            'approved' => GuestbookEntry::where('status', 'approved')->count(),
            'completed' => GuestbookEntry::where('status', 'completed')->count(),
        ];
    }

    public function getAll(array $filters)
    {
        return GuestbookEntry::query()
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('full_name', 'like', "%{$search}%")
                        ->orWhere('institution', 'like', "%{$search}%")
                        ->orWhere('purpose', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn($query, $status) => $query->where('status', $status))
            ->when($filters['visit_date'] ?? null, fn($query, $date) => $query->whereDate('visit_date', $date))
            ->latest('visit_date')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function create(array $data): GuestbookEntry
    {
        $data['id'] = Str::uuid()->toString();
        unset($data['website'], $data['privacy_agreement']);

        return DB::transaction(fn() => GuestbookEntry::create($data));
    }

    public function updateStatus(GuestbookEntry $entry, string $status): bool
    {
        return DB::transaction(fn() => $entry->update(['status' => $status]));
    }

    public function delete(GuestbookEntry $entry): ?bool
    {
        return DB::transaction(fn() => $entry->delete());
    }
}
