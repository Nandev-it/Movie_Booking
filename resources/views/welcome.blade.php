@extends('layouts.app')

@section('title', 'Cineverse Legend')

@section('content')

{{-- Movie Hero Carousel --}}
<div id="movie-carousel"
    class="relative w-full mb-10 overflow-hidden rounded-2xl"
    data-carousel="slide"
    data-carousel-interval="5000">

    {{-- Carousel Wrapper --}}
    <div class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">

        {{-- Slide 1 --}}
        <div class="hidden duration-[1500ms] ease-in-out"
            data-carousel-item="active">

            <img src="https://i.pinimg.com/1200x/ee/20/1c/ee201cd81e0670bbe2a082d02e539551.jpg"
                class="absolute inset-0 w-full h-full object-cover
                       transition-transform duration-[5000ms] ease-out
                       scale-105"
                alt="Movie Banner 1">

            {{-- Dark Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t
                        from-black via-black/30 to-transparent"></div>
        </div>


        {{-- Slide 2 --}}
        <div class="hidden duration-[1500ms] ease-in-out"
            data-carousel-item>

            <img src="https://i.pinimg.com/1200x/ed/61/2e/ed612eee74d3e88bed85e06e3180fac5.jpg"
                class="absolute inset-0 w-full h-full object-cover
                       transition-transform duration-[5000ms] ease-out
                       scale-105"
                alt="Movie Banner 2">

            <div class="absolute inset-0 bg-gradient-to-t
                        from-black via-black/30 to-transparent"></div>
        </div>


        {{-- Slide 3 --}}
        <div class="hidden duration-[1500ms] ease-in-out"
            data-carousel-item>

            <img src="https://i.pinimg.com/736x/77/29/eb/7729eb84d8702733554a4ad9c3df9c21.jpg"
                class="absolute inset-0 w-full h-full object-cover
                       transition-transform duration-[5000ms] ease-out
                       scale-105"
                alt="Movie Banner 3">

            <div class="absolute inset-0 bg-gradient-to-t
                        from-black via-black/30 to-transparent"></div>
        </div>


        {{-- Slide 4 --}}
        <div class="hidden duration-[1500ms] ease-in-out"
            data-carousel-item>

            <img src="https://i.pinimg.com/736x/0e/e9/68/0ee968d13927d9e677827ed7ba64cc38.jpg"
                class="absolute inset-0 w-full h-full object-cover
                       transition-transform duration-[5000ms] ease-out
                       scale-105"
                alt="Movie Banner 4">

            <div class="absolute inset-0 bg-gradient-to-t
                        from-black via-black/30 to-transparent"></div>
        </div>


        {{-- Slide 5 --}}
        <div class="hidden duration-[1500ms] ease-in-out"
            data-carousel-item>

            <img src="https://i.pinimg.com/736x/bf/ed/f6/bfedf6c5b7e9e8aa2e5e83ddc62a6a29.jpg"
                class="absolute inset-0 w-full h-full object-cover
                       transition-transform duration-[5000ms] ease-out
                       scale-105"
                alt="Movie Banner 5">

            <div class="absolute inset-0 bg-gradient-to-t
                        from-black via-black/30 to-transparent"></div>
        </div>

    </div>


    {{-- Indicators --}}
    <div class="absolute z-30 flex -translate-x-1/2 bottom-6 left-1/2 space-x-2">

        <button type="button"
            class="w-8 h-1.5 rounded-full bg-white transition-all duration-500"
            aria-current="true"
            aria-label="Slide 1"
            data-carousel-slide-to="0">
        </button>

        <button type="button"
            class="w-3 h-1.5 rounded-full bg-white/40 hover:bg-white transition-all duration-500"
            aria-current="false"
            aria-label="Slide 2"
            data-carousel-slide-to="1">
        </button>

        <button type="button"
            class="w-3 h-1.5 rounded-full bg-white/40 hover:bg-white transition-all duration-500"
            aria-current="false"
            aria-label="Slide 3"
            data-carousel-slide-to="2">
        </button>

        <button type="button"
            class="w-3 h-1.5 rounded-full bg-white/40 hover:bg-white transition-all duration-500"
            aria-current="false"
            aria-label="Slide 4"
            data-carousel-slide-to="3">
        </button>

        <button type="button"
            class="w-3 h-1.5 rounded-full bg-white/40 hover:bg-white transition-all duration-500"
            aria-current="false"
            aria-label="Slide 5"
            data-carousel-slide-to="4">
        </button>

    </div>


    {{-- Previous Button --}}
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center
               h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>

        <span class="inline-flex items-center justify-center
                     w-11 h-11 rounded-full
                     bg-black/30 backdrop-blur-md
                     group-hover:bg-purple-600/80
                     group-hover:scale-110
                     transition-all duration-300">

            <svg class="w-5 h-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24">

                <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m15 19-7-7 7-7" />

            </svg>

            <span class="sr-only">Previous</span>
        </span>
    </button>


    {{-- Next Button --}}
    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center
               h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>

        <span class="inline-flex items-center justify-center
                     w-11 h-11 rounded-full
                     bg-black/30 backdrop-blur-md
                     group-hover:bg-purple-600/80
                     group-hover:scale-110
                     transition-all duration-300">

            <svg class="w-5 h-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24">

                <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m9 5 7 7-7 7" />

            </svg>

            <span class="sr-only">Next</span>
        </span>
    </button>

</div>


    {{-- Movie Cards --}}
    <x-cardmovie
        :movies="$movies"
        :genres="$genres"
        :genre="$genre"
    />


    {{-- Scroll To Top Button --}}
    <button id="scrollTopBtn"
        class="fixed bottom-6 right-6 z-50 hidden p-3 rounded-full shadow-lg transition-all duration-300 bg-purple-600 hover:bg-purple-700">

        <img src="{{ asset('assets/icons/top.png') }}"
            alt="Top"
            class="w-6 h-6 object-contain">

    </button>


    {{-- Scroll To Top Script --}}
    <script>
        const scrollBtn = document.getElementById("scrollTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.remove("hidden");
            } else {
                scrollBtn.classList.add("hidden");
            }
        });

        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

@endsection
