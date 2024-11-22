<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        // Retrieve all patients
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate patient data
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'email' => 'required|email|unique:patients,email|unique:users,email',
                'phone_number' => 'required|string|max:20',
                'address' => 'required|string',
                'blood_type' => 'required|string|max:5',
                'emergency_contact' => 'required|string|max:20',
                'id_number' => 'required|string|unique:patients,id_number',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create the user
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Create the patient and set the user_id
            $patient = Patient::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'address' => $validated['address'],
                'blood_type' => $validated['blood_type'],
                'emergency_contact' => $validated['emergency_contact'],
                'id_number' => $validated['id_number'],
                'user_id' => $user->id,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Patient and user created successfully',
                'patient' => $patient,
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to create patient and user: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function show($id)
    {
        // Retrieve a single patient by ID
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        // Validate input data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:patients,email,' . $id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'blood_type' => 'required|string|max:5',
            'emergency_contact' => 'required|string|max:20',
            'id_number' => 'required|string|unique:patients,id_number,' . $id,
        ]);

        // Find and update the patient
        $patient = Patient::findOrFail($id);
        $patient->update($validated);

        return response()->json($patient);
    }

    public function destroy($id)
    {
        // Find and delete the patient
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}
