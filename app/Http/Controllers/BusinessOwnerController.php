<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\History;
use App\Models\Negotiation;
use App\Models\Payment;
use App\Models\Reviews;
use App\Models\RentalAgreement;
use Illuminate\Support\Facades\Auth;

class BusinessOwnerController extends Controller
{
    /**
     * Display the dashboard for business owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Define the locations you want to filte
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

    public function showByLocation($location)
    {
        // Fetch all listings for the specific location
        $listings = Listing::with('owner')->where('location', 'LIKE', '%' . $location . '%')->get();

        // Pass the listings and the location to the view
        return view('place.showByLocation', compact('listings', 'location'));
    }
    public function storeProofOfPayment(Request $request, $negotiationID)
    {
        // Validate the request input
        $validated = $request->validate([
            'proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // Allow images or PDFs up to 2MB
            'details' => 'nullable|string|max:255'
        ]);

        // Store the proof of payment file
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('payments', 'public'); // Save in storage/app/public/payments
        }

        // Create the payment record in the database
        Payment::create([
            'rentalAgreementID' => $negotiationID, // This can be linked to your rental agreement/negotiation ID
            'renterID' => Auth::id(),
            'amount' => $request->amount ?? 0, // Assuming amount is already saved elsewhere
            'date' => now(),
            'proof' => $proofPath, // Save the proof path
            'details' => $request->details ?? ''
        ]);

        // Redirect back with a success message
        return redirect()->route('business.dashboard', ['negotiationID' => $negotiationID])
                         ->with('success', 'Proof of payment submitted successfully!');
    }

    public function detail($listingID)
    {
        $listing = Listing::with('owner')->findOrFail($listingID);
        return view('place.detail', compact('listing'));
    }
    public function negotiations()
    {
        return view('negotiations.business');
    }
    public function bookinghistory()
    {
        $bhistory = History::with(['rentalAgreement.space', 'rentalAgreement.owner'])
                           ->where('renterID', auth()->id())
                           ->get();
        
        return view('business_owner.bookinghistory', compact('bhistory'));
    }
    /**
     * Show the form for submitting feedback.
     *
     * @return \Illuminate\View\View
     */
    public function feedback()
    {
        // Retrieve any necessary data for the view
        $rentalAgreementID = 1; 
        return view('business_owner.feedback', compact('rentalAgreementID'));
    }

    /**
     * Store the submitted feedback.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {   
        // Validate the incoming request
        $validated = $request->validate([
            'renterID' => 'required|exists:users,userID',
            'rentalAgreementID' => 'required|exists:rental_agreements,rentalAgreementID',
            'rate' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        // Create a new review
        Reviews::create($validated);

        // Redirect with a success message
        return redirect()->route('business.dashboard')->with('success', 'Feedback submitted successfully.');
    }
    public function proceedToPayment($negotiationID)
    {
        // You can retrieve the negotiation details by negotiation ID
        $negotiation = Negotiation::findOrFail($negotiationID);

        // Additional logic for processing payments could be implemented here

        // For now, we'll just return a view where you could show the payment form or details
        return view('business_owner.payment', compact('negotiation'));
    }
    

    // Add additional methods specific to business owners here
    // For example, methods to manage businesses, view reports, etc.
}
