<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    // Store the notification to the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'type' => 'required|string|max:255',
            'data' => 'required|string|max:255',
        ]);

        // Retrieve all users except admins
        $users = User::where('role', '!=', 'admin')->get(); 

        // Loop through each user and create a notification entry for them
        foreach ($users as $user) {
            Notification::create([
                'n_userID' => $user->userID,  // Ensure the n_userID references the users table
                'type' => $request->type,  // You can put additional data here if needed
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
        $notifications = Notification::where('n_userID', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }
}
