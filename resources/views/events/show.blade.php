<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Registered:</strong> {{ $event->registrations->count() }}{{ $event->capacity ? ' / ' . $event->capacity : '' }}</p>

            @auth
                @if ($event->registrations->where('user_id', auth()->id())->count())
                    <form method="POST" action="{{ route('events.unregister', $event) }}">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="bg-red-500 hover:bg-red-600">Unregister</x-primary-button>
                    </form>
                @elseif ($event->capacity && $event->registrations->count() >= $event->capacity)
                    <p class="text-red-500 font-semibold">This event is full.</p>
                @else
                    <form method="POST" action="{{ route('events.register', $event) }}">
                        @csrf
                        <x-primary-button>Register</x-primary-button>
                    </form>
                @endif
            @endauth
        </div>

        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-indigo-600 hover:underline">&larr; Back to Events</a>
        </div>
    </div>
</x-app-layout>
