<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Listing;

class BusinessOwnerController extends Controller
{
    /**
     * Display the dashboard for business owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Define the locations you want to filter
        $locations = ['Cebu City', 'Mandaue City', 'Talisay City', 'Lapu-Lapu City', 'Naga City', 'Minglanilla City', 'Toledo City', 'Carcar', 'Asturias', 'Dumanjug', 'Barili', 'Danao'];
        
        // Initialize an array to store the counts
        $listingsCount = [];

        // Loop through the locations and get the count for each
        foreach ($locations as $location) {
            // Count listings for the current location
            $listingsCount[$location] = Listing::where('location', 'LIKE', '%' . $location . '%')->count();
        }

        // Return the count to the view
        return view('dashboard.business', compact('listingsCount'));
    }
    public function myads()
    {
        return view('myads.business');
    }
    public function negotiations()
    {
        return view('negotiations.business');
    }
    public function bh()
    {
        return view('bh.business');
    }
    public function feedback()
    {
        return view('feedback.business');
    }

    // Add additional methods specific to business owners here
    // For example, methods to manage businesses, view reports, etc.
}
