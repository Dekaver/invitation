<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishRequest;
use App\Models\Wedding;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishController extends Controller
{
    /**
     * Display wishes page for a wedding.
     *
     * @param Wedding $wedding
     * @return View
     */
    public function index(Wedding $wedding): View
    {
        // Get approved wishes (you can add approval system later)
        $wishes = $wedding->wishes()
            ->latest()
            ->paginate(10);

        return view('invitations.wishes.index', [
            'wedding' => $wedding,
            'wishes' => $wishes,
        ]);
    }

    /**
     * Store a new wish for the wedding.
     *
     * @param Wedding $wedding
     * @param StoreWishRequest $request
     * @return RedirectResponse
     */
    public function store(Wedding $wedding, StoreWishRequest $request): RedirectResponse
    {
        // Create new wish
        $wish = $wedding->wishes()->create([
            'guest_name' => $request->guest_name,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('wishes.index', ['wedding' => $wedding->slug])
            ->with('success', 'Thank you for your wishes!');
    }
}
