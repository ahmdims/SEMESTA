@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lokasi</label>
        <input type="text" name="name" id="name" value="{{ old('name', $location->name ?? '') }}"
            placeholder="Contoh: Kantor Cabang Utama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required>
    </div>

    <div>
        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $location->latitude ?? '') }}"
            placeholder="Contoh: -7.2575" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div>
        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $location->longitude ?? '') }}"
            placeholder="Contoh: 112.7521" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div>
        <label for="radius" class="block text-sm font-medium text-gray-700">Radius Toleransi (dalam meter)</label>
        <input type="number" name="radius" id="radius" value="{{ old('radius', $location->radius ?? 30) }}"
            placeholder="Contoh: 30" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        <p class="mt-1 text-xs text-gray-500">Radius dari titik pusat lokasi di mana absensi dianggap valid.</p>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('admin.locations.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
    <button type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
        {{ isset($location) ? 'Perbarui Lokasi' : 'Simpan Lokasi' }}
    </button>
</div>