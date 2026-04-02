<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Registration;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $userId = session('user_id');

        // Get all properties user has chatted about
        $chattedProperties = Chat::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->select('property_title', 'sender_id', 'receiver_id')
            ->get()
            ->map(function ($chat) use ($userId) {
                $chat->other_user_id = $chat->sender_id == $userId ? $chat->receiver_id : $chat->sender_id;

                $otherUser = Registration::find($chat->other_user_id);
                $chat->other_user_email = $otherUser->email ?? null;
                $chat->other_user_phone = $otherUser->phone ?? null;

                $property = \App\Models\Property::where('property_title', $chat->property_title)->first();
                if ($property) {
                    $images = is_array($property->images) ? $property->images : json_decode($property->images, true);
                    $chat->property_image = $images[0] ?? null;
                } else {
                    $chat->property_image = null;
                }

                return $chat;
            })
            ->unique(function ($item) {
                return $item->property_title . '_' . $item->other_user_id;
            });

        // Get selected receiver and property
        $receiver_id = $request->receiver_id;
        $property_title = $request->property_title;
        $receiver_email = $request->receiver_email;

        // If not provided, use the first chat
        if (!$receiver_id || !$property_title) {
            $selectedChat = $chattedProperties->first();
            if ($selectedChat) {
                $receiver_id = $selectedChat->other_user_id;
                $property_title = $selectedChat->property_title;
            }
        }

        // ✅ FIXED: Load only messages for this property and user pair
        $messages = collect();
        if ($receiver_id && $property_title) {
            $messages = Chat::where(function ($query) use ($userId, $receiver_id, $property_title) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $receiver_id)
                      ->where('property_title', $property_title);
            })->orWhere(function ($query) use ($userId, $receiver_id, $property_title) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $userId)
                      ->where('property_title', $property_title);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        }

        return view('users.user-chatter', [
            'property_title' => $property_title,
            'receiver_id' => $receiver_id,
            'receiver_email' => $receiver_email,
            'messages' => $messages,
            'chattedProperties' => $chattedProperties,
        ]);
    }

    public function send(Request $request)
    {
        $senderId = session('user_id');

        $request->validate([
            'receiver_id' => 'required|exists:registrations,id',
            'property_title' => 'required|string',
            'message' => 'required|string',
        ]);

        Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $request->receiver_id,
            'property_title' => $request->property_title,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index', [
            'receiver_id' => $request->receiver_id,
            'property_title' => $request->property_title,
            'receiver_email' => $request->receiver_email,
        ])->with('success', 'Message sent successfully!');
    }
}
