<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Shifts') }}
            </h2>
            <a href="{{ route('admin.shifts.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Add New Shift
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start
                                        Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Time
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($shifts as $shift)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $shift->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $shift->location->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $shift->start_time }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $shift->end_time }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.shifts.qrcode', $shift) }}"
                                                class="text-green-600 hover:text-green-900 mr-3">Generate QR</a>
                                            <a href="{{ route('admin.shifts.edit', $shift) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.shifts.destroy', $shift) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this shift?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No shifts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $shifts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>