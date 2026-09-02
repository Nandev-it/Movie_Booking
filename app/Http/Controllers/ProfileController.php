<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin_frontend.pages.profile', [
            'user' => Auth::user(),
        ]);
    }

 public function update(Request $request)
{
    $user = Auth::user();

    $data = $request->validate([
        'first_name'        => ['required', 'string', 'max:255'],
        'last_name'         => ['required', 'string', 'max:255'],
        'email'             => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'avatar'            => ['nullable', 'image', 'max:10240'],
        'remove_avatar'     => ['nullable', 'boolean'],
        'current_password'  => ['nullable', 'required_with:password', 'current_password'],
        'password'          => ['nullable', 'confirmed', Password::min(8)],
    ]);

    if ($request->boolean('remove_avatar')) {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $data['avatar'] = null;
    } elseif ($request->hasFile('avatar')) {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $user->first_name = $data['first_name'];
    $user->last_name  = $data['last_name'];
    $user->email      = $data['email'];
    $user->avatar     = $data['avatar'] ?? $user->avatar;

    if ($request->filled('password')) {
        $user->password = Hash::make($data['password']);
    }

    $user->save();

    return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
}

    public function editEmail()
    {
        return view('admin_frontend.pages.account-email', [
            'user' => Auth::user(),
        ]);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update(['email' => $data['email']]);

        return redirect()->route('admin.profile.edit')->with('success', 'Email updated successfully.');
    }

    public function editPassword()
    {
        return view('admin_frontend.pages.account-password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'          => ['required', 'confirmed', Password::min(8)],
        ]);

        Auth::user()->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.profile.edit')->with('success', 'Password updated successfully.');
    }
}
