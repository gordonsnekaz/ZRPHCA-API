<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::with('city')->get();
        return response()->json($hospitals, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $hospital = Hospital::create($request->all());
        return response()->json($hospital, 201);
    }

    public function show(Hospital $hospital)
    {
        $hospital->load('city');
        return response()->json($hospital);
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $hospital->update($request->all());
        return response()->json($hospital);
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return response()->json(null, 204);
    }
}
