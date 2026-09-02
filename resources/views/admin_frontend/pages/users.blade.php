@extends('admin_frontend.components.layout')

@section('title', 'Users')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">User management</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">Users</h3>
                </div>
                <span class="rounded-full border border-slate-800 bg-slate-900/90 px-4 py-2 text-sm text-slate-300">
                    {{ $users->count() }} users
                </span>
            </div>

            @if (session('success'))
                <div class="mt-4 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-6 flex flex-wrap items-center gap-2">
                @php
                    $activeRole = $role ?? 'all';
                @endphp
                <a href="{{ route('admin.users') }}" class="rounded-full px-4 py-2 text-sm transition {{ $activeRole === 'all' ? 'bg-sky-500 text-slate-950' : 'border border-slate-700 bg-slate-900/80 text-slate-300 hover:bg-slate-800' }}">All</a>
                <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="rounded-full px-4 py-2 text-sm transition {{ $activeRole === 'admin' ? 'bg-sky-500 text-slate-950' : 'border border-slate-700 bg-slate-900/80 text-slate-300 hover:bg-slate-800' }}">Admins</a>
                <a href="{{ route('admin.users', ['role' => 'staff']) }}" class="rounded-full px-4 py-2 text-sm transition {{ $activeRole === 'staff' ? 'bg-sky-500 text-slate-950' : 'border border-slate-700 bg-slate-900/80 text-slate-300 hover:bg-slate-800' }}">Staff</a>
                <a href="{{ route('admin.users', ['role' => 'user']) }}" class="rounded-full px-4 py-2 text-sm transition {{ $activeRole === 'user' ? 'bg-sky-500 text-slate-950' : 'border border-slate-700 bg-slate-900/80 text-slate-300 hover:bg-slate-800' }}">Users</a>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-y-3 text-left text-sm text-slate-300">
                    <thead class="text-xs uppercase tracking-[0.24em] text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Created</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="rounded-3xl bg-slate-900/80">
                                <td class="px-4 py-4">
                                    <div class="font-medium text-white">{{ $user->name }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    @if (Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="rounded-full border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-200 focus:border-sky-500 focus:outline-none">
                                                <option value="user" @selected($user->role === 'user')>User</option>
                                                <option value="staff" @selected($user->role === 'staff')>Staff</option>
                                                <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                            </select>
                                            <button type="submit" class="rounded-full bg-sky-500 px-3 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Save</button>
                                        </form>
                                    @else
                                        <span class="rounded-full bg-slate-800 px-3 py-1 text-xs uppercase tracking-[0.24em] text-slate-300">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">{{ $user->email }}</td>
                                <td class="px-4 py-4">{{ $user->created_at ? $user->created_at->format('M d, Y') : '-' }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="#" class="rounded-full border border-slate-700 px-3 py-2 text-sm text-slate-200 transition hover:bg-slate-800">View</a>

                                        @if (Auth::user()->role === 'admin')
                                            <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full border border-slate-700 px-3 py-2 text-sm text-slate-200 transition hover:bg-slate-800">Edit</a>
                                        @else
                                            <span class="cursor-not-allowed rounded-full border border-slate-700/60 px-3 py-2 text-sm text-slate-500 opacity-70">Edit</span>
                                        @endif

                                        @if (Auth::user()->role === 'admin')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full border border-rose-500/40 px-3 py-2 text-sm text-rose-300 transition hover:bg-rose-500/10">Delete</button>
                                            </form>
                                        @else
                                            <button type="button" class="cursor-not-allowed rounded-full border border-rose-500/20 px-3 py-2 text-sm text-rose-500/60 opacity-70" disabled>Delete</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
