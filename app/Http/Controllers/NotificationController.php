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
            'message' => 'required|string|max:255',
            'type'    => 'required|string|max:255', // Ensure notification type is also sent
        ]);

        // Retrieve all users except admins
        $users = User::where('role', '!=', 'admin')->get(); 

        // Loop through each user and create a notification entry for them
        foreach ($users as $user) {
            Notification::create([
                'userID'           => $user->userID, 
                'description'      => $request->message, 
                'notificationType' => $request->type, 
                'created_at'       => now(),
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Notification sent successfully!');
    }

    // Fetch all notifications for the authenticated user
    public function getNotifications(Request $request)
    {
        $notifications = Notification::where('userID', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }
}
