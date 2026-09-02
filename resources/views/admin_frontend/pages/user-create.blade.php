@extends('admin_frontend.components.layout')

@section('title', 'Add User')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">User profile</p>
                    <h3 class="mt-2 text-2xl font-semibold text-white">Add user</h3>
                </div>
                <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-900">Back</a>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-red-800 bg-red-950/50 px-4 py-3">
                    <ul class="list-inside list-disc space-y-1 text-sm text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST" class="mt-8 space-y-5">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="first_name">First name</label>
                        <input id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="last_name">Last name</label>
                        <input id="last_name" name="last_name" value="{{ old('last_name') }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="password">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 pr-12 text-white focus:border-sky-500 focus:outline-none" required>
                            <button type="button" data-toggle-password="password" class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-200" aria-label="Show password">
                                <svg data-eye-open="password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg data-eye-closed="password" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="password_confirmation">Confirm password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 pr-12 text-white focus:border-sky-500 focus:outline-none" required>
                            <button type="button" data-toggle-password="password_confirmation" class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-200" aria-label="Show password">
                                <svg data-eye-open="password_confirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg data-eye-closed="password_confirmation" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="role">Role</label>
                    <select id="role" name="role" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none">
                        <option value="user" @selected(old('role', 'user') === 'user')>User</option>
                        <option value="staff" @selected(old('role') === 'staff')>Staff</option>
                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    </select>
                    <p class="mt-2 text-xs text-slate-500">Defaults to "User" if left unchanged.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="rounded-full bg-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Create user</button>
                    <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-5 py-3 text-sm text-slate-200 transition hover:bg-slate-900">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
            button.addEventListener('click', function () {
                var targetId = button.getAttribute('data-toggle-password');
                var input = document.getElementById(targetId);
                var openIcon = document.querySelector('[data-eye-open="' + targetId + '"]');
                var closedIcon = document.querySelector('[data-eye-closed="' + targetId + '"]');

                var isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';

                openIcon.classList.toggle('hidden', isHidden);
                closedIcon.classList.toggle('hidden', !isHidden);

                button.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        });
    </script>
@endsection
