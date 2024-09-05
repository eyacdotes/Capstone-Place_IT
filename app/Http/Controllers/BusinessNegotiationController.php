<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negotiation;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class BusinessNegotiationController extends Controller
{
    /**
     * Show the list of sent negotiations for the business owner.
     */
    public function index()
    {
        // Fetch negotiations where the current user is the sender (business owner)
        $negotiations = Negotiation::where('senderID', Auth::id())
                                   ->with('listing', 'receiver')
                                   ->get();

        return view('business_owner.negotiations', compact('negotiations'));
    }

    /**
     * Show negotiation details with messages.
     */
    public function show($negotiationID)
    {
        $negotiation = Negotiation::with('listing', 'sender', 'receiver', 'replies')->findOrFail($negotiationID);
        return view('business_owner.bmessagedetail', compact('negotiation'));
    }

    /**
     * Store a reply (message) for a negotiation.
     */
    public function breply(Request $request, $negotiationID)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $negotiation = Negotiation::findOrFail($negotiationID);

        // Create a reply (message)
        Reply::create([
            'negotiationID' => $negotiation->negotiationID,
            'senderID' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('business.bmessagedetail', ['negotiationID' => $negotiationID]);
    }

    /**
     * Get all messages for a negotiation (for API or dynamic loading purposes).
     */
    public function getMessages($negotiationID)
    {
        $replies = Reply::where('negotiationID', $negotiationID)->get();
        return response()->json($replies);
    }
}
