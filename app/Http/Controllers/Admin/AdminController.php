<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wedding;
use App\Models\Wish;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'totalWeddings' => Wedding::count(),
            'totalGuests' => Guest::count(),
            'upcomingWeddings' => Wedding::where('akad_date', '>=', now())
                ->where('akad_date', '<=', now()->addMonth())
                ->count(),
        ];

        return Inertia::render('Admin/Dashboard', ['stats' => $stats]);
    }
}