<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImages; // Add this to use the ListingImage model
use App\Http\Controllers\Controller;

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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate each image
        ]);

        // Create the listing
        $listing = new Listing([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'dateCreated' => now(),
            'ownerID' => Auth::id(),
            'status' => 'Pending',
            'approvedBy_userID' => 4,
        ]);

        // Save the listing to get the listingID
        $listing->save();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate a unique file name
                $filename = time() . '-' . $image->getClientOriginalName();
                // Save the file to the public/images directory
                $image->storeAs('public/images', $filename);

                // Save the image path to the listing_images table
                $listingImage = new ListingImages([
                    'imageID' => $listing->listingID, // Foreign key to the listing table
                    'image_path' => $filename
                ]);

                $listingImage->save();
            }
        }

        return redirect()->route('space.dashboard')->with('success', 'Listing created successfully.');
    }
}
