<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;
use App\Models\Wedding;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Ramsey\Uuid\Uuid;

class GuestCrudController extends Controller
{
    /**
     * Display a listing of guests for a wedding.
     */
    public function index(Wedding $wedding): Response
    {
        $guests = $wedding->guests()->get()->map(fn ($g) => [
            'id' => $g->id,
            'uuid' => $g->uuid,
            'name' => $g->name,
            'phone' => $g->phone,
            'rsvp_status' => $g->rsvp_status,
            'total_guest' => $g->total_guest,
        ]);

        $stats = [
            'total' => $wedding->guests()->count(),
            'attending' => $wedding->guests()->where('rsvp_status', 'yes')->count(),
            'notAttending' => $wedding->guests()->where('rsvp_status', 'no')->count(),
            'maybe' => $wedding->guests()->where('rsvp_status', 'maybe')->count(),
        ];

        return Inertia::render('Admin/Guests/Index', [
            'wedding' => $wedding,
            'guests' => $guests,
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for creating a new guest.
     */
    public function create(Wedding $wedding): Response
    {
        return Inertia::render('Admin/Guests/Create', [
            'wedding' => $wedding,
        ]);
    }

    /**
     * Store a newly created guest.
     */
    public function store(StoreGuestRequest $request, Wedding $wedding): RedirectResponse
    {
        $data = $request->validated();
        $data['wedding_id'] = $wedding->id;
        $data['uuid'] = Uuid::uuid4()->toString();
        $data['total_guest'] = $data['total_guest'] ?? 1;

        Guest::create($data);

        return redirect()->route('admin.guests.index', $wedding->id)
            ->with('success', 'Tamu berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the guest.
     */
    public function edit(Wedding $wedding, Guest $guest): Response
    {
        return Inertia::render('Admin/Guests/Edit', [
            'wedding' => $wedding,
            'guest' => $guest,
        ]);
    }

    /**
     * Update the specified guest.
     */
    public function update(UpdateGuestRequest $request, Wedding $wedding, Guest $guest): RedirectResponse
    {
        $guest->update($request->validated());

        return redirect()->route('admin.guests.index', $wedding->id)
            ->with('success', 'Tamu berhasil diperbarui!');
    }

    /**
     * Delete the specified guest.
     */
    public function destroy(Wedding $wedding, Guest $guest): RedirectResponse
    {
        $guest->delete();

        return redirect()->route('admin.guests.index', $wedding->id)
            ->with('success', 'Tamu berhasil dihapus!');
    }
}
