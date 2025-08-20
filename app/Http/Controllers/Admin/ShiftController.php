<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\Location;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::with('location')->latest()->paginate(10);
        return view('admin.shifts.index', compact('shifts'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();
        return view('admin.shifts.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Shift::create($validated);

        return redirect()->route('admin.shifts.index')
            ->with('success', 'Shift created successfully.');
    }

    public function edit(Shift $shift)
    {
        $locations = Location::orderBy('name')->get();
        return view('admin.shifts.edit', compact('shift', 'locations'));
    }

    public function update(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $shift->update($validated);

        return redirect()->route('admin.shifts.index')
            ->with('success', 'Shift updated successfully.');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('admin.shifts.index')
            ->with('success', 'Shift deleted successfully.');
    }
}