<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\FollowUp;

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
            'selectUser' => 'required|string'
        ]);

        // Determine the user roles to notify based on the selection
        $roles = [];
        if ($request->selectUser === 'space_owner') {
            $roles[] = 'space_owner';
        } elseif ($request->selectUser === 'business_owner') {
            $roles[] = 'business_owner';
        } elseif ($request->selectUser === 'both') {
            $roles = ['space_owner', 'business_owner'];
        }

        // Retrieve all users with the selected roles
        $users = User::whereIn('role', $roles)->get();

        // Loop through each user and create a notification entry for them
        foreach ($users as $user) {
            Notification::create([
                'n_userID' => $user->userID,  // Ensure the n_userID references the users table
                'type' => $request->type,
                'data' => $request->message,
                'created_at' => now(),
            ]);
            Mail::to($user->email)->send(new FollowUp);
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
            ->orderBy('updated_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($notifications);
    }
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Notification deleted successfully.']);
        }
        return response()->json(['message' => 'Notification not found.'], 404);
    }

}
