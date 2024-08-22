<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaceOwnerController extends Controller
{
    /**
     * Display the dashboard for space owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.space'); // Ensure this view exists
    }

    // Add additional methods specific to space owners here
    // For example, methods to manage spaces, view bookings, etc.
}
