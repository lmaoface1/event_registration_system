@csrf

<label class="block mb-2 font-medium text-gray-700" for="title">Title</label>
<input id="title" name="title" type="text"
       value="{{ old('title', optional($event)->title) }}"
       class="w-full border border-gray-300 rounded px-3 py-2 mb-4" required>

<label class="block mb-2 font-medium text-gray-700" for="date">Date</label>
<input id="date" name="date" type="date"
       value="{{ old('date', optional($event?->date)->format('Y-m-d')) }}"
       class="w-full border border-gray-300 rounded px-3 py-2 mb-4" required>

<label class="block mb-2 font-medium text-gray-700" for="location">Location</label>
<input id="location" name="location" type="text"
       value="{{ old('location', optional($event)->location) }}"
       class="w-full border border-gray-300 rounded px-3 py-2 mb-4" required>

<label class="block mb-2 font-medium text-gray-700" for="description">Description</label>
<textarea id="description" name="description"
          class="w-full border border-gray-300 rounded px-3 py-2 mb-4" rows="4">{{ old('description', optional($event)->description) }}</textarea>
