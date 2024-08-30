<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\SpaceOwnerController;

class CreateListingController extends Controller
{
    /**
     * Show the form to create a new listing.
     *
     * @return \Illuminate\View\View
     */

    public function create() {
        return view('space_owner.newspaces');
    }
    /**
     * Store a new listing in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $listing = new Listing([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'dateCreated' => now(),
            'ownerID' => Auth::id(),
            'status' => 'Vacant',
            'approvedBy_userID' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $listing->save();
        return redirect()->route('space.dashboard')->with('success', 'Listing created successfully.');
    }
}
