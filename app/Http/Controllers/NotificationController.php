<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    // Store the notification to the database
    public function create() {
        return view('admin.notifications.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'type' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'selectUser' => 'required|string' // Add validation for the new field
        ]);

        // Determine the role based on the selected user type
        $role = $request->selectUser === 'space_owner' ? 'space_owner' : 'business_owner';

        // Retrieve all users except admins
        $users = User::where('role', $role)->get(); 

        // Loop through each user and create a notification entry for them
        foreach ($users as $user) {
            Notification::create([
                'n_userID' => $user->userID,  // Ensure the n_userID references the users table
                'type' => $request->type,  // You can put additional data here if needed
                'data' => $request->message,
                'created_at' => now(),
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Notification sent successfully!');
    }

    // Mark a notification as read
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        // Update the read_at column to the current timestamp
        $notification->update(['read_at' => now()]);

        return response()->json(['message' => 'Notification marked as read successfully.']);
    }

    // Fetch all notifications for the authenticated user
    public function getNotifications(Request $request)
    {
        // Define the number of notifications to load at a time
        $limit = $request->input('limit', 8);
        $offset = $request->input('offset', 0);

        // Retrieve notifications with offset
        $notifications = Notification::where('n_userID', auth()->id())
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($notifications);
    }
}
