<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of clinics.
     */
    public function index()
    {
        $clinics = Clinic::orderBy('created_at', 'desc')->get();
        return view('admin.clinics.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new clinic.
     */
    public function create()
    {
        return view('admin.clinics.create');
    }

    /**
     * Store a newly created clinic in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'distance' => 'required|string|max:50',
            'hours' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:50',
        ]);

        Clinic::create([
            'name' => $request->name,
            'address' => $request->address,
            'distance' => $request->distance,
            'hours' => $request->hours,
            'is_open' => $request->has('is_open'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.clinics.index')->with('success', 'Klinik offline berhasil ditambahkan ke database!');
    }

    /**
     * Show the form for editing the specified clinic.
     */
    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('admin.clinics.edit', compact('clinic'));
    }

    /**
     * Update the specified clinic in storage.
     */
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'distance' => 'required|string|max:50',
            'hours' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:50',
        ]);

        $clinic->update([
            'name' => $request->name,
            'address' => $request->address,
            'distance' => $request->distance,
            'hours' => $request->hours,
            'is_open' => $request->has('is_open'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.clinics.index')->with('success', 'Detail klinik offline berhasil diperbarui!');
    }

    /**
     * Remove the specified clinic from storage.
     */
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('admin.clinics.index')->with('success', 'Klinik offline berhasil dihapus dari database!');
    }
}
