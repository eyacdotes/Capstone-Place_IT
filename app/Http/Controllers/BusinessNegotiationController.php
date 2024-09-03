<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negotiation;
use Illuminate\Support\Facades\Auth;

class BusinessNegotiationController extends Controller
{
    /**
     * Show the list of sent negotiations for the business owner.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch negotiations where the current user is the sender (business owner)
        $negotiations = Negotiation::where('senderID', Auth::id())
                                   ->with('listing', 'receiver')
                                   ->get();

        return view('business_owner.negotiations', compact('negotiations'));
    }
}
