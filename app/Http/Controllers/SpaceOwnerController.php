<?php

namespace App\Http\Controllers;

use App\Models\RentalAgreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\Reviews;

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
    public function reviews()
    {
        // Fetch feedbacks from the reviews table, with related space title and renter details
        $feedbacks = Reviews::with(['rentalAgreement.space', 'renter'])
                    ->latest() // Order by the latest feedback
                    ->get();

        return view('space_owner.reviews', compact('feedbacks'));
    }
    

    // Add additional methods specific to space owners here
    // For example, methods to manage spaces, view bookings, etc.
}
