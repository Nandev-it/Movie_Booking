<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function user() {
        $users = User::all();
        return response()->json([
            'message' => 'Success',
            'data' => $users
        ]);
    }

    public function authDashboard(Request $request)
    {
        $tab = $request->query('tab', 'auth/dashboard');
        return view('admin_frontend.auth.login', compact('tab'));
    }
    public function authSignIn(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            // If API request
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // If Web request
            return back()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }

        // Login session
        Auth::login($user);

        // Create token (API)
        $token = $user->createToken('api-token')->plainTextToken;

        // If API request
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token
            ]);
        }

        // If Web request
        return redirect('/admin/dashboard')
            ->with('success', 'Login successfully!')
            ->with('welcome_name', trim($user->first_name . ' ' . $user->last_name));
    }

    // public function register(Request $request)
    // {
    //     // 1. Validate request
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     // 2. Create user
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // 3. Return success response
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User registered successfully',
    //         'user' => $user
    //     ], 201);
    // }


    public function authSignUp(Request $request)
    {
        // 1. Validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Create user
        $user = User::create([
            'uuid' => (string) Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token_url' => Str::random(60),
        ]);

        // 3. Log the user in
        Auth::login($user);

        // 4. Redirect to auth dashboard with success message
        return redirect('/auth/dashboard/')->with('success', 'Registration successful! Welcome!');
    }


    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'message' => 'API is working',
            'users' => $users
        ]);
    }
}
