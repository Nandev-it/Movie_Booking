<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register | Cineverse Legend</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-slate-950 text-white bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.18),_transparent_45%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_35%)]">
    <div class="min-h-screen flex items-center justify-center px-4 py-8 lg:px-10">
        <div class="w-full max-w-6xl grid gap-8 lg:grid-cols-[1.05fr_1fr] items-center">

            {{-- Hero / image panel --}}
            <div class="hidden lg:flex h-full rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 bg-slate-950/20 backdrop-blur-xl">
                <div class="relative w-full h-full">
                    <img src="{{ asset('assets/logo/Login_poster.jpg') }}"
                        alt="Movie login background" class="w-full h-full object-cover transition duration-500 ease-out hover:scale-105" />
                    {{-- <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"></div> --}}
                    <div class="absolute inset-x-0 bottom-0 p-10 text-white">
                        <span class="inline-flex px-4 py-2 rounded-full bg-red-600/90 text-xs uppercase tracking-[0.3em] font-semibold">
                            Movie Booking</span>
                        <h1 class="mt-6 text-4xl font-bold leading-tight">Your cinema experience starts here.</h1>
                        <p class="mt-4 max-w-xl text-sm text-slate-300">
                            Securely sign in or create a new account to book seats, view showtimes, and manage your movie plans from any device.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Auth panel --}}
            <div class="w-full bg-slate-900/70 border border-white/10 backdrop-blur-2xl rounded-[2rem] shadow-2xl shadow-slate-950/40 ring-1 ring-white/10 p-6 sm:p-10 transition duration-300 ease-out">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-3 rounded-full bg-slate-800/80 p-1">
                            <button type="button" data-tab="login"
                                class="tab-btn flex-1 rounded-full px-5 py-3 text-sm font-semibold transition duration-300 ease-out">
                                Login
                            </button>
                            <button type="button" data-tab="register"
                                class="tab-btn flex-1 rounded-full px-5 py-3 text-sm font-semibold transition duration-300 ease-out">
                                Sign Up
                            </button>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Welcome to Cineverse Legend</p>
                            <h2 class="text-3xl sm:text-4xl font-bold">Sign in or create your account</h2>
                            <p class="max-w-2xl text-sm text-slate-400">
                                Fast, secure authentication with responsive layout for all screen sizes.
                            </p>
                        </div>
                    </div>

                    {{-- Login form --}}
                    <div id="login-panel" class="space-y-4">
                        @if ($errors->any() && old('form_type', request()->query('tab', 'login')) === 'login')
                            <div class="rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-200">
                                {{ $errors->first('email') ?? 'Please check your login details and try again.' }}
                            </div>
                        @endif

                        <form action="{{ url('/auth/signin') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="form_type" value="login">

                            <label class="block">
                                <span class="text-sm text-slate-300">Email address</span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-white outline-none transition duration-300 ease-out focus:border-red-500 focus:ring-2 focus:ring-red-500/40" />
                            </label>

                            <label class="block">
                                <span class="text-sm text-slate-300">Password</span>
                                <input type="password" name="password" required
                                    class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-white outline-none transition duration-300 ease-out focus:border-red-500 focus:ring-2 focus:ring-red-500/40" />
                            </label>

                            <button type="submit"
                                class="w-full rounded-3xl bg-gradient-to-r from-red-600 to-red-500 py-3 text-sm font-semibold uppercase tracking-wider text-white shadow-lg shadow-red-500/20 transition duration-300 ease-out hover:brightness-110 hover:-translate-y-0.5">
                                Login
                            </button>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <a href="{{ url('maintenance') }}"
                                    class="inline-flex items-center justify-center rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-sm text-slate-200 transition duration-300 ease-out hover:border-red-500/30 hover:text-white hover:-translate-y-0.5">
                                    Continue with Google
                                </a>
                                <a href="{{ url('maintenance') }}"
                                    class="inline-flex items-center justify-center rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-sm text-slate-200 transition duration-300 ease-out hover:border-red-500/30 hover:text-white hover:-translate-y-0.5">
                                    Continue with Apple
                                </a>
                            </div>

                            <p class="text-center text-sm text-slate-400">
                                Don’t have an account?
                                <button type="button" data-tab="register" class="font-semibold text-red-500 hover:underline">
                                    Create account
                                </button>
                            </p>
                        </form>
                    </div>

                    {{-- Register form --}}
                    <div id="register-panel" class="hidden space-y-4">
                        @if ($errors->any() && old('form_type', request()->query('tab', 'login')) === 'register')
                            <div class="rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-200">
                                Oops! Please fix the fields below.
                            </div>
                        @endif

                        <form action="{{ url('/auth/signup') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="form_type" value="register">

                            <div class="grid gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span class="text-sm text-slate-300">First name</span>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                        class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-white outline-none transition duration-300 ease-out focus:border-red-500 focus:ring-2 focus:ring-red-500/40" />
                                    @error('first_name')<span class="text-xs text-red-300">{{ $message }}</span>@enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm text-slate-300">Last name</span>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                        class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-white outline-none transition duration-300 ease-out focus:border-red-500 focus:ring-2 focus:ring-red-500/40" />
                                    @error('last_name')<span class="text-xs text-red-300">{{ $message }}</span>@enderror
                                </label>
                            </div>

                            <label class="block">
                                <span class="text-sm text-slate-300">Email address</span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-white outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-500/20" />
                                @error('email')<span class="text-xs text-red-300">{{ $message }}</span>@enderror
                            </label>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span class="text-sm text-slate-300">Password</span>
                                    <input type="password" name="password" required
                                        class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-white outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-500/20" />
                                    @error('password')<span class="text-xs text-red-300">{{ $message }}</span>@enderror
                                </label>
                                <label class="block">
                                    <span class="text-sm text-slate-300">Confirm password</span>
                                    <input type="password" name="password_confirmation" required
                                        class="mt-2 w-full rounded-3xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-white outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-500/20" />
                                    @error('password_confirmation')<span class="text-xs text-red-300">{{ $message }}</span>@enderror
                                </label>
                            </div>


                            <div class="flex items-start gap-3">
                                <input type="checkbox" name="terms" id="terms" value="1"
                                    class="mt-1 h-5 w-5 rounded-lg border border-slate-700 bg-slate-950/90 text-red-500 focus:ring-red-500" />
                                <label for="terms" class="text-sm text-slate-300 leading-relaxed">
                                    I agree to the <a href="#" class="text-red-400 hover:text-red-300">Terms of service</a> and <a href="#" class="text-red-400 hover:text-red-300">Privacy policy</a>.
                                </label>
                            </div>
                            @error('terms')<span class="text-xs text-red-300">{{ $message }}</span>@enderror

                            <button type="submit"
                                class="w-full rounded-3xl bg-gradient-to-r from-sky-500 to-indigo-500 py-3 text-sm font-semibold uppercase tracking-wider text-white shadow-lg shadow-sky-500/20 transition duration-300 ease-out hover:brightness-110 hover:-translate-y-0.5">
                                Create account
                            </button>

                            <p class="text-center text-sm text-slate-400">
                                Already have an account?
                                <button type="button" data-tab="login" class="font-semibold text-red-500 hover:underline">
                                    Sign in
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const tabButtons = document.querySelectorAll('[data-tab]');
        const loginPanel = document.getElementById('login-panel');
        const registerPanel = document.getElementById('register-panel');

        const activeTab = '{{ old('form_type', request()->query('tab', 'login')) }}';

        function setTab(tab) {
            const loginActive = tab === 'login';
            loginPanel.classList.toggle('hidden', !loginActive);
            registerPanel.classList.toggle('hidden', loginActive);

            tabButtons.forEach(button => {
                const isActive = button.dataset.tab === tab;
                button.classList.toggle('bg-slate-950 text-white shadow-lg shadow-slate-950/20', isActive);
                button.classList.toggle('bg-transparent text-slate-400 hover:text-white', !isActive);
            });
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', () => setTab(button.dataset.tab));
        });

        setTab(activeTab || 'login');
    </script>
</body>
</html>
