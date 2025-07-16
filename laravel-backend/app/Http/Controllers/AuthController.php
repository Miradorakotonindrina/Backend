<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;



class AuthController extends Controller
{
    public function register( Request $Request){
        $validated = $Request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response() ->json(['message' => 'Utilisateur créé'], 201);
    }


    public function login(Request $Request){

        $Request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $Request->email)->first();

        if (! $user || ! Hash::check($Request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Identifiants incorrects.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user,
        ]);

    }
    

    public function logout( Request $Request){
         $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);

    }
        
}
