<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRsvpRequest;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\RedirectResponse;
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
     * Store RSVP response for a guest.
     *
     * @param Wedding $wedding
     * @param Guest $guest
     * @param StoreRsvpRequest $request
     * @return RedirectResponse
     */
    public function updateRsvp(Wedding $wedding, Guest $guest, StoreRsvpRequest $request): RedirectResponse
    {
        // Verify guest belongs to this wedding
        if ($guest->wedding_id !== $wedding->id) {
            abort(404);
        }

        // Update RSVP status
        $guest->update([
            'rsvp_status' => $request->rsvp_status,
            'total_guest' => $request->rsvp_status === 'yes' ? $request->total_guest : null,
        ]);

        return redirect()
            ->route('guest.show', [
                'wedding' => $wedding->slug,
                'guest' => $guest->uuid,
            ])
            ->with('success', 'RSVP saved successfully!');
    }
}
