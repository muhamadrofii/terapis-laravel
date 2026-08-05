<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Get chat message history for a booking or live chat session.
     */
    public function getMessages(Request $request)
    {
        $bookingId = $request->query('booking_id');
        
        $query = Message::query();
        if ($bookingId && $bookingId !== 'default' && $bookingId !== 'undefined' && $bookingId !== 'null') {
            $query->where('booking_id', $bookingId);
        }

        $messages = $query->orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'current_user_id' => (string) (Auth::id() ?? ''),
            'current_user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'data' => $messages
        ]);
    }

    /**
     * Send a new live chat message.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $bookingId = $request->input('booking_id');
        if (!$bookingId || $bookingId === 'undefined' || $bookingId === 'null') {
            $bookingId = 'default';
        }

        $msg = Message::create([
            'booking_id' => $bookingId,
            'sender_id' => (string) (Auth::id() ?? 'guest'),
            'sender_name' => Auth::check() ? Auth::user()->name : 'User',
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $msg
        ]);
    }
}
