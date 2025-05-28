<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Event</h2>
    </x-slot>

    <div class="py-8 max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('events.update', $event) }}">
                @method('PUT')
                @include('events._form', ['event' => $event])

                <div class="flex justify-end mt-4">
                    <a href="{{ route('events.index') }}" class="mr-4 text-gray-600 hover:underline">Cancel</a>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
