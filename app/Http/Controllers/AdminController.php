<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the dashboard for business owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get counts for statistics
        $userCount = User::where('role', '!=', 'admin')->count();
        $listingCount = Listing::count();
        $verifiedUsersCount = User::where('isVerified', 1)
                              ->where('role', '!=', 'admin')
                              ->count();
        $spaceOwnersCount = User::where('role', 'space_owner')->count();
        $businessOwnersCount = User::where('role', 'business_owner')->count();
        
        // Pass statistics to the view
        return view('dashboard.admin', compact('userCount', 'listingCount', 'verifiedUsersCount', 'spaceOwnersCount', 'businessOwnersCount'));
    }

    public function users() {
        $userCount = User::where('role', '!=', 'admin')->count();
        $users  = User::where('role', '!=', 'admin')->get();
        return view('admin.usermanagement', compact('userCount','users'));
    }

    public function listing() {
        $pendingListings = Listing::where('status', 'pending')->get();
        $userCount = User::where('role', '!=', 'admin')->count();
        $listingCount = Listing::count();
        $allListings = Listing::all();

        return view('admin.listingmanagement', compact('userCount','listingCount','pendingListings','allListings'));
    }
    public function approveListing($id) {
        // Find the listing by ID
        $listing = Listing::find($id);
    
        // Approve the listing
        if ($listing) {
            $listing->status = 'Vacant';
            $listing->save();
        }
        // Redirect back to the listing management page with success message
        return redirect()->route('admin.listingmanagement')->with('status', 'Listing approved successfully!');
    }

    public function disapproveListing($id) {
        $listing = Listing::find($id);
        if ($listing) {
            $listing->status = 'Disapproved';
            $listing->save();
        }

        return redirect()->route('admin.listingmanagement')->with('status', 'Listing disapproved!');
    }

    public function viewListing($id) {
    // Find the listing by ID, with its images and owner
    $listing = Listing::with(['images', 'owner'])->find($id);

    // Check if the listing exists
    if (!$listing) {
        return response()->json(['error' => 'Listing not found'], 404);
    }

    // Return the listing details and images as JSON
    return response()->json($listing);
    }

    public function payment() {
        $userCount = User::where('role', '!=', 'admin')->count();
        return view('admin.payment', compact('userCount'));
    }
    
}
