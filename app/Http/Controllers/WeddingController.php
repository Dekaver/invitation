<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\View\View;

class WeddingController extends Controller
{
    /**
     * Display the wedding invitation page.
     * Public route for viewing wedding details.
     *
     * @param Wedding $wedding
     * @return View
     */
    public function show(Wedding $wedding): View
    {
        // Eager load relationships to minimize queries
        $wedding->load(['guests', 'gifts']);
        $guests = $wedding->guests()->latest()->paginate(5);

        return view('invitations.show', [
            'wedding' => $wedding,
            'guests' => $guests,
        ]);
    }
}
