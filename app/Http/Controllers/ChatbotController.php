<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    // Define the conversation flow with stages
    protected $flow = [
        'greet' => 'Hi! How can I assist you today? What seems to be troubling you?',
        'ask_symptoms' => 'Can you describe your symptoms?',
        'ask_duration' => 'How long have you been experiencing these symptoms?',
        'ask_medication' => 'Have you taken any medication for this?',
        'ask_pain_details' => 'Can you describe the pain? For example, where exactly is it located, and is it sharp, dull, or something else?',
        'end' => 'Thank you for the information. I’ll analyze it and get back to you.',
    ];

    // Handle the conversation flow
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = strtolower(trim($validated['message']));

        // Retrieve or initialize the conversation state from the session
        $state = session('chat_state', 'greet');

        // Handle user response based on the current state
        switch ($state) {
            case 'greet':
                session(['chat_state' => 'ask_symptoms']);
                $response = $this->flow['ask_symptoms'];
                break;

            case 'ask_symptoms':
                session(['chat_state' => 'ask_duration']);
                $response = $this->flow['ask_duration'];
                break;

            case 'ask_duration':
                session(['chat_state' => 'ask_medication']);
                $response = $this->flow['ask_medication'];
                break;

            case 'ask_medication':
                session(['chat_state' => 'ask_pain_details']);
                $response = $this->flow['ask_pain_details'];
                break;

            case 'ask_pain_details':
                session(['chat_state' => 'end']);
                $response = $this->flow['end'];
                break;

            case 'end':
                // Reset the conversation
                session()->forget('chat_state');
                $response = 'If you have more questions, feel free to ask!';
                break;

            default:
                session(['chat_state' => 'greet']);
                $response = $this->flow['greet'];
                break;
        }

        // Return the response as JSON
        return response()->json([
            'status' => 'success',
            'message' => $response
        ]);
    }
}
