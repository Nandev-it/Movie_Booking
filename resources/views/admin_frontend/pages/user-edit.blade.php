@extends('admin_frontend.components.layout')

@section('title', 'Edit User')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">User profile</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">Edit user</h3>
                </div>
                <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-900">Back</a>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="mt-8 space-y-5">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="first_name">First name</label>
                        <input id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="last_name">Last name</label>
                        <input id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                </div>

                @if (Auth::user()->role === 'admin')
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="role">Role</label>
                        <select id="role" name="role" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none">
                            <option value="user" @selected($user->role === 'user')>User</option>
                            <option value="staff" @selected($user->role === 'staff')>Staff</option>
                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                        </select>
                    </div>
                @endif

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="rounded-full bg-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Save changes</button>
                    <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-5 py-3 text-sm text-slate-200 transition hover:bg-slate-900">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
