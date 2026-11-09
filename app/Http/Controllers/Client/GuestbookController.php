<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guestbook\StoreGuestbookEntryRequest;
use App\Services\Guestbook\GuestbookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class GuestbookController extends Controller
{
    public function __construct(protected GuestbookService $guestbookService) {}

    public function index(): View
    {
        return view('client.guestbook.index');
    }

    public function store(StoreGuestbookEntryRequest $request): RedirectResponse
    {
        try {
            $this->guestbookService->create($request->validated());

            return redirect()
                ->route('guestbook.index')
                ->with('success', 'Data buku tamu berhasil dikirim dan menunggu verifikasi petugas.');
        } catch (\Throwable $exception) {
            Log::error('Gagal menyimpan buku tamu publik.', [
                'message' => $exception->getMessage(),
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Data belum dapat disimpan. Silakan coba beberapa saat lagi.');
        }
    }
}
