<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wedding;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class WishCrudController extends Controller
{
    /**
     * Display a listing of wishes for a wedding.
     */
    public function index(Wedding $wedding): Response
    {
        $wishes = $wedding->wishes()->get()->map(fn ($w) => [
            'id' => $w->id,
            'guest_name' => $w->guest_name,
            'message' => $w->message,
            'created_at' => $w->created_at,
        ]);

        return Inertia::render('Admin/Wishes/Index', [
            'wedding' => $wedding,
            'wishes' => $wishes,
            'total' => $wedding->wishes()->count(),
        ]);
    }

    /**
     * Delete the specified wish.
     */
    public function destroy(Wedding $wedding, Wish $wish): RedirectResponse
    {
        $wish->delete();

        return redirect()->route('admin.wishes.index', $wedding->id)
            ->with('success', 'Keinginan berhasil dihapus!');
    }
}

