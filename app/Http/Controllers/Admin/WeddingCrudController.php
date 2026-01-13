<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeddingRequest;
use App\Http\Requests\UpdateWeddingRequest;
use App\Models\Wedding;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WeddingCrudController extends Controller
{
    /**
     * Display a listing of weddings.
     */
    public function index(): Response
    {
        $weddings = Wedding::with(['guests'])
            ->get()
            ->map(fn ($w) => [
                'id' => $w->id,
                'slug' => $w->slug,
                'groom_name' => $w->groom_name,
                'bride_name' => $w->bride_name,
                'akad_date' => $w->akad_date,
                'reception_date' => $w->reception_date,
                'theme' => $w->theme,
                'guests_count' => $w->guests->count(),
            ]);

        return Inertia::render('Admin/Weddings/Index', [
            'weddings' => $weddings,
        ]);
    }

    /**
     * Show the form for creating a new wedding.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Weddings/Create');
    }

    /**
     * Store a newly created wedding.
     */
    public function store(StoreWeddingRequest $request): RedirectResponse
    {
        Wedding::create($request->validated());

        return redirect()->route('admin.weddings.index')
            ->with('success', 'Pernikahan berhasil dibuat!');
    }

    /**
     * Show the form for editing the wedding.
     */
    public function edit($id): Response
    {
        $wedding = Wedding::find($id);
        return Inertia::render('Admin/Weddings/Edit', [
            'wedding' => $wedding,
        ]);
    }

    /**
     * Update the specified wedding.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $wedding = Wedding::find($id);
        $wedding->slug = $request->slug;
        $wedding->groom_short_name = $request->groom_short_name;
        $wedding->groom_name = $request->groom_name;
        $wedding->groom_father = $request->groom_father;
        $wedding->groom_mother = $request->groom_mother;
        $wedding->bride_short_name = $request->bride_short_name;
        $wedding->bride_father = $request->bride_father;
        $wedding->bride_mother = $request->bride_mother;
        $wedding->akad_date = $request->akad_date;
        $wedding->akad_start = $request->akad_start;
        $wedding->akad_end = $request->akad_end;
        $wedding->akad_location = $request->akad_location;
        $wedding->reception_date = $request->reception_date;
        $wedding->reception_start = $request->reception_start;
        $wedding->reception_end = $request->reception_end;
        $wedding->reception_location = $request->reception_location;
        $wedding->map_url = $request->map_url;
        $wedding->map_embed_url = $request->map_embed_url;
        $wedding->theme = $request->theme;
        $wedding->save();

        return redirect()->route('admin.weddings.index')
            ->with('success', 'Pernikahan berhasil diperbarui!');
    }

    /**
     * Delete the specified wedding.
     */
    public function destroy(Wedding $wedding): RedirectResponse
    {
        $wedding->delete();

        return redirect()->route('admin.weddings.index')
            ->with('success', 'Pernikahan berhasil dihapus!');
    }
}
