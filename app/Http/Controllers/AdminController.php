<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImages;
use App\Models\User;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    // NAVBAR USERS ACCOUNT MANAGEMENT
    public function spaceOwners()
    {
        $users = User::where('role', 'space_owner')->get();
        $userCount = $users->count();
        $currentRole = 'space_owner';
        return view('admin.usermanagement', compact('userCount', 'users', 'currentRole'));
    }

    public function businessOwners()
    {
        $users = User::where('role', 'business_owner')->get();
        $userCount = $users->count();
        $currentRole = 'business_owner';
        return view('admin.usermanagement', compact('userCount', 'users', 'currentRole'));
    }

    public function adminUsers()
    {
        $users = User::where('role', 'admin')->get();
        $userCount = $users->count();
        $currentRole = 'admin';
        return view('admin.usermanagement', compact('userCount', 'users', 'currentRole'));
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
            $listing->approvedBy_userID = Auth::id();
            $listing->save();
            $this->notifySpaceOwner($listing);
        }
        // Redirect back to the listing management page with success message
        return redirect()->route('admin.listingmanagement')->with('status', 'Listing approved successfully!');
    }

    public function disapproveListing($id) {
        $listing = Listing::find($id);
        if ($listing) {
            $listing->status = 'Disapproved';
            $listing->approvedBy_userID = Auth::id();
            $listing->save();
            $this->notifySpaceOwner($listing);
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
        // Fetch all payments with related details
        $payments = Payment::with(['renter', 'listing', 'rentalAgreement', 'spaceOwner','sender'])
            ->get();
    
        $userCount = User::where('role', '!=', 'admin')->count();
    
        return view('admin.payment', compact('userCount', 'payments'));
    }

    public function updatePaymentStatus(Request $request, $paymentID)
    {
        // Find the payment by ID
        $payment = Payment::find($paymentID);
        
        // Update the status based on form input
        $payment->status = $request->input('status');
        
        // Save the updated payment
        $payment->save();

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }
    public function transfer(Request $request)
    {
        // Find the payment by ID
        $payment = Payment::find($request->paymentID);

        // Handle the proof of payment file upload
        if ($request->hasFile('proof')) {
            $filePath = $request->file('proof')->store('payments', 'public');
            $payment->admin_proof = $filePath; // Save proof uploaded by admin
        }

        $payment->status = 'transferred';  // Update status to transferred
        $payment->save();

        return redirect()->back()->with('success', 'Payment transferred successfully!');
    }

    protected function notifySpaceOwner(Listing $listing)
    {
    // Find the space owner based on the ownerID in the Listing model
    $spaceOwner = User::find($listing->ownerID);  // Assuming ownerID is the space owner's user ID

    // Check if the space owner exists
    if ($spaceOwner) {
        // Create the notification for the space owner
        Notification::create([
            'n_userID' => $spaceOwner->userID,  // The space owner's user ID
            'data' => $listing->title,  // Store the title in the notification's data field as JSON
            'type' => 'listing_approved',  // Notification type
            ]);
        }
    }
    public function create() {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Ensure email is unique
            'password' => 'required|string|min:8|confirmed', // Password confirmation required
            'mobile_number' => 'required|string|max:15|unique:users,mobileNumber', // Ensure mobile number is unique
        ]);

        // Create the admin user
        User::create([
            'firstName' => $request->first_name, // Ensure this matches your database field
            'lastName' => $request->last_name,   // Ensure this matches your database field
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'mobileNumber' => $request->mobile_number, // Ensure this matches your database field
            'role' => 'admin', // Assign the 'admin' role
            'isVerified' => true, // Assuming new admins are verified by default
        ]);

        // Redirect back to the admin list page with a success message
        return redirect()->route('admin.adminUsers')->with('success', 'Admin created successfully!');
    }


}
