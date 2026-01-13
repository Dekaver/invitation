<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRsvpRequest;
use App\Models\Guest;
use App\Models\Wedding;
use App\Services\ThemeService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PublicInvitationController extends Controller
{
    /**
     * Display the main invitation page with wedding details
     */
    public function show(Wedding $wedding): View
    {
        $wedding->load('guests', 'gifts');

        $themeService = app(ThemeService::class);
        $themePath = $themeService->getThemePath($wedding->theme, 'show');

        return view($themePath, [
            'wedding' => $wedding,
            'guests' => $wedding->guests()->get(),
            'gifts' => $wedding->gifts()->get(),
        ]);
    }

    /**
     * Display RSVP form for a specific guest
     */
    public function showRsvpForm(Wedding $wedding, Guest $guest): View
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
     * Handle RSVP submission
     */
    public function updateRsvp(StoreRsvpRequest $request, Wedding $wedding, Guest $guest): RedirectResponse
    {
        // Verify guest belongs to this wedding
        if ($guest->wedding_id !== $wedding->id) {
            abort(404);
        }

        $guest->update([
            'rsvp_status' => $request->validated('rsvp_status'),
            'total_guest' => $request->validated('total_guest', 1),
        ]);

        return redirect()
            ->route('invitations.guest.show', [$wedding->slug, $guest->uuid])
            ->with('success', 'RSVP updated successfully!');
    }
}
