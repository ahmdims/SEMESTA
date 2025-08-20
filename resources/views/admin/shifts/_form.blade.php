@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Shift Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $shift->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div>
        <label for="location_id" class="block text-sm font-medium text-gray-700">Location</label>
        <select name="location_id" id="location_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>
            <option value="">Select a location</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" @selected(old('location_id', $shift->location_id ?? '') == $location->id)>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $shift->start_time ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div>
        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $shift->end_time ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('admin.shifts.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
    <button type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        {{ isset($shift) ? 'Update Shift' : 'Create Shift' }}
    </button>
</div>