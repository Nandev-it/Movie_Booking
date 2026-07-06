@extends('layouts.app')

@section('title', 'Cineverse Legend')

@section('content')


    {{-- @include('components.cardmovie') --}}
    <x-cardmovie :movies="$movies" :genres="$genres" :genre="$genre" />
    <button id="scrollTopBtn"
        class="fixed bottom-6 right-6 z-50 hidden p-3 rounded-fullshadow-lg transition-all duration-300">

        <img src="{{ asset('assets/icons/top.png') }}" alt="Top" class="w-6 h-6 object-contain">
    </button>

    <script>
        const scrollBtn = document.getElementById("scrollTopBtn");

        // Show button when scroll down
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.remove("hidden");
            } else {
                scrollBtn.classList.add("hidden");
            }
        });

        // Scroll to top when clicked
        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
@endsection
