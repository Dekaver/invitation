<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRsvpRequest;
use App\Http\Requests\StoreWishRequest;
use App\Models\Guest;
use App\Models\Wedding;
use App\Models\Wish;
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
        $wedding->load('guests', 'wishes', 'gifts');

        $themeService = app(ThemeService::class);
        $themePath = $themeService->getThemePath($wedding->theme, 'show');

        return view($themePath, [
            'wedding' => $wedding,
            'guests' => $wedding->guests()->get(),
            'wishes' => $wedding->wishes()->latest()->limit(5)->get(),
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

    /**
     * Display wishes list with pagination
     */
    public function showWishes(Wedding $wedding): View
    {
        $wishes = Wish::where('wedding_id', $wedding->id)
            ->latest()
            ->paginate(10);

        return view('invitations.wishes.index', [
            'wedding' => $wedding,
            'wishes' => $wishes,
        ]);
    }

    /**
     * Store a new wish
     */
    public function storeWish(StoreWishRequest $request, Wedding $wedding): RedirectResponse
    {
        Wish::create([
            'wedding_id' => $wedding->id,
            'guest_name' => $request->validated('guest_name'),
            'message' => $request->validated('message'),
        ]);

        return redirect()
            ->route('invitations.wishes.index', $wedding->slug)
            ->with('success', 'Thank you for your blessing!');
    }
}
