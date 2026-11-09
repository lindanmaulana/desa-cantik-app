<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guestbook\UpdateGuestbookStatusRequest;
use App\Models\GuestbookEntry;
use App\Services\Guestbook\GuestbookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class GuestbookController extends Controller
{
    public function __construct(protected GuestbookService $guestbookService) {}

    public function index(Request $request): View
    {
        $entries = $this->guestbookService->getAll($request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:pending,approved,rejected,completed'],
            'visit_date' => ['nullable', 'date'],
        ]));
        $stats = $this->guestbookService->getStats();

        return view('dashboard.guestbook.index', compact('entries', 'stats'));
    }

    public function show(GuestbookEntry $guestbookEntry): View
    {
        return view('dashboard.guestbook.show', compact('guestbookEntry'));
    }

    public function updateStatus(UpdateGuestbookStatusRequest $request, GuestbookEntry $guestbookEntry): RedirectResponse
    {
        try {
            $this->guestbookService->updateStatus($guestbookEntry, $request->validated('status'));

            return back()->with('success', 'Status buku tamu berhasil diperbarui.');
        } catch (\Throwable $exception) {
            Log::error('Gagal memperbarui status buku tamu.', [
                'entry_id' => $guestbookEntry->id,
                'user_id' => Auth::id(),
                'message' => $exception->getMessage(),
            ]);

            return back()->with('error', 'Status belum dapat diperbarui.');
        }
    }

    public function destroy(GuestbookEntry $guestbookEntry): RedirectResponse
    {
        try {
            $this->guestbookService->delete($guestbookEntry);

            return back()->with('success', 'Data buku tamu berhasil dihapus.');
        } catch (\Throwable $exception) {
            Log::error('Gagal menghapus buku tamu.', [
                'entry_id' => $guestbookEntry->id,
                'user_id' => Auth::id(),
                'message' => $exception->getMessage(),
            ]);

            return back()->with('error', 'Data belum dapat dihapus.');
        }
    }
}
