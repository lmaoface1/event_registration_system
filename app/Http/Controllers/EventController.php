<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Show all events - anyone authenticated can view
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    // Show the form to create a new event - only admin
    public function create()
    {
        $this->authorize('create', Event::class);

        return view('events.create');
    }

    // Store a new event - only admin
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show a single event - anyone can view
    public function show(Event $event)
    {
        $event->load('registrations.user');
        return view('events.show', compact('event'));
    }

    // Show the form to edit an event - only admin
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    // Update an existing event - only admin
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete an event - only admin
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

        public function __construct()
    {
        $this->authorizeResource(Event::class, 'event');
    }
}
