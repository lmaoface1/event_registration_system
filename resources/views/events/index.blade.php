<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                Events
            </h2>
            <button
                onclick="document.documentElement.classList.toggle('dark')"
                class="px-3 py-1 text-sm rounded bg-gray-200 dark:bg-gray-700 dark:text-gray-200 text-gray-800 hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                aria-label="Toggle Dark Mode"
                title="Toggle Dark Mode"
            >
                🌙
            </button>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Create Event Button (only for authorized users) --}}
        @can('create', App\Models\Event::class)
            <div class="mb-6 text-right">
                <a href="{{ route('events.create') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                    + Create Event
                </a>
            </div>
        @endcan

        {{-- Events List --}}
        <div class="space-y-6">
            @forelse ($events as $event)
                <div
                    class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition duration-300"
                >
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold text-indigo-700 dark:text-indigo-400">
                                <a href="{{ route('events.show', $event) }}">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }} - {{ $event->location }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mt-3 line-clamp-3">
                                {{ $event->description }}
                            </p>
                            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 font-semibold">
                                Registered: {{ $event->registrations->count() }}{{ $event->capacity ? ' / ' . $event->capacity : '' }}
                            </p>
                        </div>

                        {{-- Edit/Delete buttons --}}
                        <div class="flex flex-col space-y-2 ml-4">
                            @can('update', $event)
                                <a href="{{ route('events.edit', $event) }}"
                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                                    ✏️ Edit
                                </a>
                            @endcan

                            @can('delete', $event)
                                <form method="POST" action="{{ route('events.destroy', $event) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition">
                                        🗑️ Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No events found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
