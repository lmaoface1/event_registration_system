<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Register user to an event
    public function store(Event $event)
    {
        $user = auth()->user();

        // Prevent duplicate registration
        if ($user->registrations()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'You are already registered for this event.');
        }

        // Check capacity if set
        if ($event->capacity && $event->registrations()->count() >= $event->capacity) {
            return back()->with('error', 'This event is full.');
        }

        $user->registrations()->create(['event_id' => $event->id]);

        return back()->with('success', 'Successfully registered for the event.');
    }

    // Unregister user from an event
    public function destroy(Event $event)
    {
        $user = auth()->user();

        $registration = $user->registrations()->where('event_id', $event->id)->first();

        if ($registration) {
            $registration->delete();
            return back()->with('success', 'You have successfully unregistered from the event.');
        }

        return back()->with('error', 'You are not registered for this event.');
    }
}
