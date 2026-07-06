<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | NanFlex</title>

    @vite('resources/css/app.css')
</head>

<body class="h-screen w-screen bg-[#0f0f0f] flex items-center justify-center relative overflow-hidden">

    {{-- MOBILE BACKGROUND --}}
    <div class="absolute inset-0 lg:hidden">
        <img src="https://static.collectui.com/shots/3834352/movie-details-night%EF%BC%89-medium"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
    </div>

    <div class="relative w-full h-full flex">

        {{-- LEFT IMAGE (DESKTOP) --}}
        <div class="hidden lg:flex w-1/2 h-full items-center justify-center p-10">
            <div class="relative w-full h-[90%] rounded-2xl overflow-hidden shadow-2xl">

                <img src="https://static.collectui.com/shots/3834352/movie-details-night%EF%BC%89-medium"
                    class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/40"></div>

                <div class="absolute bottom-6 left-6 text-white">
                    <h1 class="text-xl font-bold">🔥 Cineverse Legend</h1>
                    <p class="text-sm text-gray-300">Your all-in-one movie platform</p>
                </div>

            </div>
        </div>

        {{-- LOGIN FORM --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 relative z-10">

            <div class="w-full max-w-md">

                <h2 class="text-3xl font-bold text-white mb-6">
                    Welcome back
                </h2>

                <form action="{{ url('/user_login') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- EMAIL --}}
                    <input type="email" name="email" placeholder="Email address"
                        class="w-full py-3 px-4 rounded-xl bg-[#1c1c1c] text-white placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-red-500">

                    {{-- PASSWORD --}}
                    <input type="password" name="password" placeholder="Password"
                        class="w-full py-3 px-4 rounded-xl bg-[#1c1c1c] text-white placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-red-500">

                    {{-- LOGIN BUTTON --}}
                    <button type="submit"
                        class="w-full py-3 bg-red-600 hover:bg-red-700 active:scale-95 rounded-full text-white font-semibold
                        transition-all duration-300 shadow-lg shadow-red-600/30">
                        Login
                    </button>

                    {{-- GOOGLE LOGIN --}}
                    <a href="{{ url('maintenance') }}" type="button"
                        class="w-full py-3 rounded-full border border-gray-600 text-white flex items-center justify-center gap-2
                        hover:bg-gray-800 transition">

                        <img src="{{ asset('assets/icons/google.png') }}" class="w-5 h-5">
                        Continue with Google
                    </a>

                    {{-- SIGN UP --}}
                    <p class="text-gray-400 text-sm text-center mt-4">
                        Don’t have an account?
                        <a href="#" class="text-red-500 hover:underline">Sign Up</a>
                    </p>

                </form>

            </div>
        </div>

    </div>

</body>
</html>
