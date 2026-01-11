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
        $weddings = Wedding::with(['guests', 'wishes'])
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
                'wishes_count' => $w->wishes->count(),
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
        $wedding->groom_name = $request->groom_name;
        $wedding->bride_name = $request->bride_name;
        $wedding->akad_date = $request->akad_date;
        $wedding->akad_location = $request->akad_location;
        $wedding->reception_date = $request->reception_date;
        $wedding->reception_location = $request->reception_location;
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
