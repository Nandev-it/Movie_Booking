@extends('admin_frontend.components.layout')

@section('title', 'Account')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-2xl rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">

        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">User profile</p>
                <h3 class="mt-2 text-2xl font-semibold text-white">Account</h3>
            </div>
            <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-900">Back</a>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-2xl border border-emerald-800 bg-emerald-950/50 px-4 py-3 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded-2xl border border-red-800 bg-red-950/50 px-4 py-3">
                <ul class="list-inside list-disc space-y-1 text-sm text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-8">
            @csrf
            @method('PUT')

            {{-- Profile picture --}}
            <div>
                <p class="mb-3 text-sm text-slate-400">Profile Picture</p>
                <div class="flex items-center gap-4">
                    <img
                        id="avatar-preview"
                        src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}"
                        alt="Profile picture"
                        class="h-14 w-14 rounded-full object-cover ring-1 ring-slate-700"
                    >

                    <label for="avatar" class="inline-flex cursor-pointer items-center gap-2 rounded-full bg-sky-500 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"></path>
                            <path d="M12 12v9"></path>
                            <path d="m16 16-4-4-4 4"></path>
                        </svg>
                        Upload Image
                    </label>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg, image/gif" class="hidden">

                    <button type="button" id="remove-avatar" class="rounded-full border border-slate-700 px-4 py-2.5 text-sm text-slate-200 transition hover:bg-slate-900">
                        Remove
                    </button>
                </div>
                <p class="mt-2 text-xs text-slate-500">We support PNGs, JPEGs and GIFs under 10MB</p>
                @error('avatar')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name --}}
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="first_name">First name</label>
                    <input id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-400" for="last_name">Last name</label>
                    <input id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                </div>
            </div>

            {{-- Email --}}
            <div>
                <label class="mb-2 block text-sm text-slate-400" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-sky-500 focus:outline-none" required>
                <p class="mt-2 text-xs text-slate-500">Used to log in to your account</p>
            </div>

            {{-- Password --}}
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5">
                <h2 class="text-sm font-semibold text-white">Change Password</h2>
                <p class="mt-1 text-xs text-slate-500">Leave these blank to keep your current password</p>

                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm text-slate-400" for="current_password">Current password</label>
                        <div class="relative">
                            <input id="current_password" name="current_password" type="password" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 pr-12 text-white focus:border-sky-500 focus:outline-none">
                            <button type="button" data-toggle-password="current_password" class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-slate-200" aria-label="Show password">
                                <svg data-eye-open="current_password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg data-eye-closed="current_password" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm text-slate-400" for="password">New password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 pr-12 text-white focus:border-sky-500 focus:outline-none">
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
                            <label class="mb-2 block text-sm text-slate-400" for="password_confirmation">Confirm new password</label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 pr-12 text-white focus:border-sky-500 focus:outline-none">
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
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.users') }}" class="rounded-full border border-slate-700 px-5 py-3 text-sm text-slate-200 transition hover:bg-slate-900">Cancel</a>
                <button type="submit" class="rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Save changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById('avatar-preview').src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('remove-avatar').addEventListener('click', function () {
        document.getElementById('avatar').value = '';
        document.getElementById('avatar-preview').src =
            "{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}";

        let removeFlag = document.getElementById('remove_avatar_flag');
        if (!removeFlag) {
            removeFlag = document.createElement('input');
            removeFlag.type = 'hidden';
            removeFlag.name = 'remove_avatar';
            removeFlag.id = 'remove_avatar_flag';
            removeFlag.value = '1';
            document.querySelector('form').appendChild(removeFlag);
        }
    });

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
