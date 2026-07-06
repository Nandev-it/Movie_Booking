<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Movie Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-950 via-purple-900 to-purple-950 flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-slate-900/50 backdrop-blur-xl border border-purple-500/30 rounded-3xl p-8 sm:p-12 shadow-2xl">

            <!-- Header -->
            <div class="text-center mb-10">
                <div class="w-16 h-16 mx-auto mb-5 bg-gradient-to-br from-cyan-400 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg text-3xl">
                    ✨
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-3">Welcome to Nixon+1</h1>
                <p class="text-xs sm:text-sm text-purple-300/80 leading-relaxed">
                    Credentials are only used to authenticate in ProHub. All saved data will be secured in your database.
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-3 bg-red-500/20 border border-red-500/40 rounded-lg">
                    <p class="text-sm text-red-300 font-semibold">Oops! There were some problems with your input.</p>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="/user_register" class="space-y-5">
                @csrf

                <!-- First & Last Name Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                            First Name
                        </label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            placeholder="John"
                            value="{{ old('first_name') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white placeholder-purple-300/40 focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                        >
                        @error('first_name')
                            <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                            Last Name
                        </label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            placeholder="Johnson"
                            value="{{ old('last_name') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white placeholder-purple-300/40 focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                        >
                        @error('last_name')
                            <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="emily@gmail.com"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white placeholder-purple-300/40 focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                    >
                    @error('email')
                        <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white placeholder-purple-300/40 focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                    >
                    @error('password')
                        <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white placeholder-purple-300/40 focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                    >
                    @error('password_confirmation')
                        <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block text-xs font-semibold text-purple-300/90 uppercase tracking-wider mb-2">
                        Country
                    </label>
                    <select
                        id="country"
                        name="country"
                        class="w-full px-4 py-3 bg-slate-800/50 border border-purple-500/30 rounded-xl text-white focus:outline-none focus:bg-slate-800/70 focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/30 transition-all"
                    >
                        <option value="">Select a country</option>
                        <option value="US" selected>United States</option>
                        <option value="CA">Canada</option>
                        <option value="UK">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="IN">India</option>
                        <option value="DE">Germany</option>
                        <option value="FR">France</option>
                        <option value="JP">Japan</option>
                        <option value="BR">Brazil</option>
                        <option value="MX">Mexico</option>
                    </select>
                    @error('country')
                        <span class="block text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start gap-3 pt-2">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required
                        class="w-5 h-5 mt-1 rounded cursor-pointer bg-slate-800/50 border border-purple-500/30 accent-indigo-600"
                    >
                    <label for="terms" class="text-sm text-purple-300/90 leading-relaxed cursor-pointer">
                        I agree to the <a href="#" class="text-cyan-400 hover:text-cyan-300 transition-colors" target="_blank">Terms of service</a> and <a href="#" class="text-cyan-400 hover:text-cyan-300 transition-colors" target="_blank">Privacy policies</a> of ProApp Corporation
                    </label>
                </div>
                @error('terms')
                    <span class="block text-xs text-red-400">{{ $message }}</span>
                @enderror

                <!-- Sign Up Button -->
                <button
                    type="submit"
                    class="w-full py-3 mt-6 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-semibold uppercase tracking-wider rounded-xl transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl"
                >
                    Sign Up
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-3 my-6">
                    <div class="flex-1 h-px bg-purple-500/20"></div>
                    <span class="text-xs uppercase tracking-widest text-purple-400/60">Or continue with</span>
                    <div class="flex-1 h-px bg-purple-500/20"></div>
                </div>

                <!-- Social Buttons -->
                <div class="flex justify-center gap-4">
                    <button
                        type="button"
                        class="w-12 h-12 rounded-xl bg-slate-800/50 border border-purple-500/30 hover:border-purple-500/60 hover:bg-slate-800/70 flex items-center justify-center text-xl transition-all transform hover:scale-110"
                        title="Continue with Apple"
                    >
                        🍎
                    </button>
                    <button
                        type="button"
                        class="w-12 h-12 rounded-xl bg-slate-800/50 border border-purple-500/30 hover:border-purple-500/60 hover:bg-slate-800/70 flex items-center justify-center text-xl transition-all transform hover:scale-110"
                        title="Continue with Google"
                    >
                        🔍
                    </button>
                    <button
                        type="button"
                        class="w-12 h-12 rounded-xl bg-slate-800/50 border border-purple-500/30 hover:border-purple-500/60 hover:bg-slate-800/70 flex items-center justify-center text-white font-bold transition-all transform hover:scale-110"
                        title="Continue with Facebook"
                    >
                        f
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
