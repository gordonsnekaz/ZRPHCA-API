<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::with('city')->get();
        return response()->json($pharmacies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $pharmacy = Pharmacy::create($request->all());
        return response()->json($pharmacy, 201);
    }

    public function show(Pharmacy $pharmacy)
    {
        $pharmacy->load('city');
        return response()->json($pharmacy);
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);

        $pharmacy->update($request->all());
        return response()->json($pharmacy);
    }

    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return response()->json(null, 204);
    }
}
