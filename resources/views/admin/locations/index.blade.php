<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Lokasi') }}
            </h2>
            <a href="{{ route('admin.locations.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Tambah Lokasi Baru
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Latitude
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Longitude</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Radius
                                        (m)</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($locations as $location)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->latitude }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->longitude }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->radius }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.locations.edit', $location) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.locations.destroy', $location) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada lokasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $locations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>