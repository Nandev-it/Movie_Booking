<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_frontend.pages.dahboard');
    }

    public function users(Request $request)
    {
        $role = $request->query('role');

        $query = User::query();

        if (in_array($role, ['admin', 'staff', 'user'], true)) {
            $query->where('role', $role);
        }

        $users = $query
            ->orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
            ->latest('created_at')
            ->get();

        return view('admin_frontend.pages.users', compact('users', 'role'));
    }

    public function editUser(User $user)
    {
        if (Auth::user()?->role !== 'admin' && Auth::id() !== $user->id) {
            abort(403);
        }

        return view('admin_frontend.pages.user-edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if (Auth::user()?->role !== 'admin' && Auth::id() !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        if (Auth::user()?->role === 'admin') {
            $request->validate([
                'role' => ['nullable', 'in:admin,staff,user'],
            ]);

            if ($request->filled('role')) {
                $data['role'] = $request->input('role');
            }
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function updateUserRole(Request $request, User $user)
    {
        if (Auth::user()?->role !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'role' => ['required', 'in:admin,staff,user'],
        ]);

        $user->update($data);

        return back()->with('success', 'User role updated successfully.');
    }

    public function destroyUser(User $user)
    {
        $authUser = Auth::user();
        $isAdmin = $authUser?->role === 'admin';
        $isSelf  = $authUser?->id === $user->id;

        if (!$isAdmin && !$isSelf) {
            abort(403);
        }

        if ($isAdmin && $isSelf) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        if ($isSelf) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Your account was deleted.');
        }

        return back()->with('success', 'User deleted successfully.');
    }

    public function createUser()
    {
        if (Auth::user()?->role !== 'admin') {
            abort(403);
        }

        return view('admin_frontend.pages.user-create');
    }

    public function storeUser(Request $request)
{
    if (Auth::user()?->role !== 'admin') {
        abort(403);
    }

    $data = $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name'  => ['required', 'string', 'max:255'],
        'email'      => ['required', 'email', 'max:255', 'unique:users,email'],
        'password'   => ['required', 'string', 'min:8', 'confirmed'],
        'role'       => ['nullable', 'in:admin,staff,user'],
    ]);

    User::create([
        'uuid'       => \Illuminate\Support\Str::uuid(),
        'first_name' => $data['first_name'],
        'last_name'  => $data['last_name'],
        'email'      => $data['email'],
        'password'   => \Illuminate\Support\Facades\Hash::make($data['password']),
        'role'       => $data['role'] ?? 'user',
        'token_url'  => $this->generateUniqueTokenUrl(),
    ]);

    return redirect()->route('admin.users')->with('success', 'User created successfully.');
}

/**
 * Generate a random, guaranteed-unique token for the token_url column.
 */
private function generateUniqueTokenUrl(): string
{
    do {
        $token = \Illuminate\Support\Str::random(40);
    } while (User::where('token_url', $token)->exists());

    return $token;
}
}
