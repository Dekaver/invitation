<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRsvpRequest;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    /**
     * Display guest RSVP page with wedding and guest details.
     *
     * @param Wedding $wedding
     * @param Guest $guest
     * @return View
     */
    public function show(Wedding $wedding, Guest $guest): View
    {
        // Verify guest belongs to this wedding
        if ($guest->wedding_id !== $wedding->id) {
            abort(404);
        }

        return view('invitations.guest', [
            'wedding' => $wedding,
            'guest' => $guest,
        ]);
    }

    /**
     * Display guest RSVP page with wedding and guest details.
     *
     * @param Wedding $wedding
     * @param Guest $guest
     * @return View
     */
    public function share(Wedding $wedding): View
    {
        return view('invitations.share', [
            'wedding' => $wedding,
        ]);
    }

    /**
     * Store RSVP response for a guest.
     *
     * @param Wedding $wedding
     * @param Guest $guest
     * @param StoreRsvpRequest $request
     * @return RedirectResponse
     */
    public function store(Wedding $wedding, Request $request): RedirectResponse
    {
        // Update RSVP status

        
        Guest::insert([
            'wedding_id' => $wedding->id,
            'guest_name' => $request->name,
            'rsvp_status' => $request->rsvp_status === 'hadir' ? 'Hadir' : 'Tidak Hadir',
            'message' => $request->message,
        ]);

        return redirect()
            ->back()
            ->with('success', 'berhasil disimpan!');
    }
}
