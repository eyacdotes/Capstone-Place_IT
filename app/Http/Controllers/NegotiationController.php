<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negotiation;
use App\Models\Reply;
use App\Models\RentalAgreement;
use Illuminate\Support\Facades\Auth;

class NegotiationController extends Controller
{
    /**
     * Show the list of negotiations for the authenticated user (either space owner or business owner).
     */
    public function index()
    {
        // Fetch negotiations where the current user is either the sender (business owner) or receiver (space owner)
        $negotiations = Negotiation::where('senderID', Auth::id())
                                   ->orWhere('receiverID', Auth::id())
                                   ->with('listing', 'sender', 'receiver')
                                   ->get();

        // Check role and return appropriate view
        if (Auth::user()->role === 'business_owner') {
            return view('business_owner.negotiations', compact('negotiations'));
        } else {
            return view('space_owner.negotiations', compact('negotiations'));
        }
    }

    /**
     * Show the negotiation details with messages.
     */
    public function show($negotiationID)
    {
        $negotiation = Negotiation::with('listing', 'sender', 'receiver', 'replies')->findOrFail($negotiationID);

        // Conditionally return the correct view based on the user's role
        if (Auth::user()->role === 'business_owner') {
            return view('business_owner.messagedetail', compact('negotiation'));
        } else if (Auth::user()->role === 'space_owner') {
            return view('space_owner.messagedetail', compact('negotiation'));
        }
    }

    /**
     * Store a reply (message) for a negotiation.
     */
    public function reply(Request $request, $negotiationID)
    {
    $request->validate([
        'message' => 'nullable|string|max:1000',
        'aImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the rules as needed
    ]);

    $negotiation = Negotiation::findOrFail($negotiationID);

    // Ensure only the sender (business owner) or receiver (space owner) can reply
    if (Auth::id() != $negotiation->senderID && Auth::id() != $negotiation->receiverID) {
        abort(403, 'Unauthorized');
    }

    // Handle the image upload
    $imageName = null;
    if ($request->hasFile('aImage')) {
        $image = $request->file('aImage');
        $imageName = $image->getClientOriginalName(); // Get the original name of the uploaded file
        $image->storeAs('negotiation_images', $imageName, 'public'); // Store the file with its original name
    }

    // Prepare the reply data
    $replyData = [
        'negotiationID' => $negotiationID,
        'senderID' => Auth::id(),
        'message' => $imageName ?? $request->input('message'), // Save the image name or the message text
    ];

    // Create a reply
    Reply::create($replyData);

    // Conditionally redirect based on the user's role
    return redirect()->route('negotiation.show', ['negotiationID' => $negotiationID]);
    }

    /**
     * Get all messages for a negotiation (for API or dynamic loading purposes).
     */
    public function getMessages($negotiationID)
    {
        $replies = Reply::where('negotiationID', $negotiationID)->get();
        return response()->json($replies);
    }
    public function store(Request $request)
    {
        $request->validate([
            'listingID' => 'required|exists:listing,listingID',
            'receiverID' => 'required|exists:users,userID',
            'message' => 'required|string',
            'offerAmount' => 'required|numeric',
        ]);

        Negotiation::create([
            'listingID' => $request->listingID,
            'senderID' => Auth::id(),
            'receiverID' => $request->receiverID,
            'message' => $request->message, 
            'negoStatus' => 'Pending',
            'offerAmount' => $request->offerAmount,
        ]);
        return redirect()->route('business.negotiations')->with('success', 'Your offer has been sent successfully.');
    }

    public function updateStatus (Request $request, $negotiationID) {
        // Validate the status field
        $request->validate([
            'status' => 'required|in:Pending,Approve,Disapprove',
        ]);

        // Find the negotiation by ID
        $negotiation = Negotiation::findOrFail($negotiationID);

        // Ensure the current user is the receiver (space owner)
        if (Auth::id() != $negotiation->receiverID) {
            abort(403, 'Unauthorized');
        }

        // Update the status
        $negotiation->negoStatus = $request->input('status');
        $negotiation->save();

        // Redirect back with a success message
        return redirect()->route('negotiation.show', ['negotiationID' => $negotiationID])
                        ->with('success', 'Negotiation status updated successfully.');
    }

    public function rentAgree(Request $request, $negotiationID)
    {

    // Validate the input fields
    $request->validate([
        'ownerID' => 'required|exists:users,userID',
        'renterID' => 'required|exists:users,userID',
        'listingID' => 'required|exists:listing,listingID',
        'rentalTerm' => 'required|in:weekly,monthly,yearly',
        'offerAmount' => 'required|numeric',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate', // Ensure end date is after start date
    ]);

    // Create a new rental agreement and insert into the database
    RentalAgreement::create([
        'ownerID' => $request->input('ownerID'),
        'renterID' => $request->input('renterID'),
        'listingID' => $request->input('listingID'),
        'rentalTerm' => $request->input('rentalTerm'),
        'dateCreated' => now(),
        'offerAmount' => $request->input('offerAmount'),
        'dateStart' => $request->input('startDate'),
        'dateEnd' => $request->input('endDate'),
        'status' => 'Agree', // Set status to 'Agree' by default
    ]);

    // Redirect to the business owner dashboard after successful insert
    return redirect()->route('business.dashboard')->with('success', 'Rental agreement created successfully.');
    }
}