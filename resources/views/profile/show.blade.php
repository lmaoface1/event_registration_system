<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Profile</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Left: Profile Info -->
            <div class="md:col-span-2 space-y-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Profile Information</h3>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Member since:</strong> {{ $user->created_at->format('F j, Y') }}</p>
            </div>

            <!-- Right: Registered Events Count -->
            <div class="flex flex-col justify-center items-center bg-indigo-600 rounded-lg text-white p-8 shadow-lg">
                <span class="text-sm uppercase tracking-wide mb-2">Registered Events</span>
                <span class="text-7xl font-extrabold">{{ $totalEvents }}</span>
            </div>
        </div>

        @if ($totalEvents > 0)
            <div class="mt-10 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">My Registered Events</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($registrations as $registration)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <h4 class="text-xl font-semibold text-indigo-700">{{ $registration->event->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $registration->event->date->format('F j, Y') }} at {{ $registration->event->location }}
                            </p>
                            <p class="text-gray-600 mt-2">{{ $registration->event->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mt-10 p-6 bg-white shadow rounded-lg text-center text-gray-500">
                You have not registered for any events yet.
            </div>
        @endif
    </div>
</x-app-layout>
