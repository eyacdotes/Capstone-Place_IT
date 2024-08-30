<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class SpaceOwnerController extends Controller
{
    /**
     * Display the dashboard for space owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listings = Listing::where('ownerID', Auth::id())->get();
        return view('dashboard.space', compact('listings'));
    }

    public function newspaces()
    {
        $listings = Listing::where('ownerID', Auth::id())->get();
        return view('space_owner.newspaces', compact('listings'));
    }
    public function negotiations()
    {
        $listings = Listing::where('ownerID', Auth::id())->get();
        return view('space_owner.negotiations', compact('listings'));
    }
    public function feedback()
    {
        $listings = Listing::where('ownerID', Auth::id())->get();
        return view('space_owner.feedback', compact('listings'));
    }

    // Add additional methods specific to space owners here
    // For example, methods to manage spaces, view bookings, etc.
}
