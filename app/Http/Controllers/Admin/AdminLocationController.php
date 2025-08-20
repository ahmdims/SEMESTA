<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'required|integer|min:1',
        ]);

        Location::create($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'required|integer|min:1',
        ]);

        $location->update($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}