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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Create the listing
        $listing = new Listing([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'dateCreated' => now(),
            'ownerID' => Auth::id(),
            'status' => 'Vacant',
            'approvedBy_userID' => 4,
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique file name
            $filename = time() . '-' . $image->getClientOriginalName();
            // Save the file to public/images directory
            $image->storeAs('public/images', $filename);

            //save the file to storage/public/images php artisan storage:link
            // Save the file path to the database 
            $listing->image = $filename;
        }

        // Save the listing
        $listing->save();

        return redirect()->route('space.dashboard')->with('success', 'Listing created successfully.');
    }
}
