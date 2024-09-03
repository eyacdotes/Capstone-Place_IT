<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negotiation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class NegotiationController extends Controller
{
    /**
     * Show the list of negotiations for the space owner.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch negotiations where the current user is the receiver (space owner)
        $negotiations = Negotiation::where('receiverID', Auth::id())
                                   ->with('listing', 'sender')
                                   ->get();

        return view('space_owner.negotiations', compact('negotiations'));
    }
    /**
     * Store a new negotiation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            'offerAmount' => $request->offerAmount,
        ]);
        return redirect()->route('business.negotiations')->with('success', 'Your offer has been sent successfully.');
        
    }
    /**
         * Store a new negotiation.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function reply(Request $request, $negotiationId)
        {
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);
    
            $originalNegotiation = Negotiation::findOrFail($negotiationId);
    
            // Create a new entry in the negotiations table as a reply
            Negotiation::create([
                'listingID' => $originalNegotiation->listingID,
                'senderID' => Auth::id(),
                'receiverID' => $originalNegotiation->receiverID == Auth::id() ? $originalNegotiation->senderID : $originalNegotiation->receiverID,
                'message' => $request->input('message'),
                'offerAmount' => $originalNegotiation->offerAmount, // Offer amount remains the same as the original negotiation
            ]);
    
            return redirect()->route('space.messagedetail', ['negotiationID' => $negotiationId]);
        }

        public function show($negotiationID)
        {
            $negotiation = Negotiation::with('listing', 'sender', 'receiver', 'replies')->findOrFail($negotiationID);
            return view('space_owner.messagedetail', compact('negotiation'));
        }

        public function getMessages($id)
    {
        $negotiation = Negotiation::with('replies')->findOrFail($id);

        return response()->json($negotiation->replies);
    }
}
