<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AuthController extends Controller
{
    // Register Method
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Ensures password confirmation
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing password
        ]);

        return response()->json([
            'message' => 'Registration successful. Please log in to get your token.',
        ]);
    }

    // Login Method
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'], 
                401);
        }

        $token = $user->createToken('YourAppName')->plainTextToken;

        $tokenData = [
            'id' => $user->id,
            'email' => $user->email,
        ];

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user_data' => $tokenData,
        ], 200);
    }
    // Logout Method
    public function logout(Request $request)
    {
        $request->user()->tokens->delete(); // Revoke all tokens

        return response()->json(['message' => 'Logged out successfully']);
    }
}
