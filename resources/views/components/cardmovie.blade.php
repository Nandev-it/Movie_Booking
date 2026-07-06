@props(['movies', 'genres', 'genre'])

@php
    $selectedGenre = $genre;
@endphp

{{-- Genre Filter --}}
@if ($genres->count() > 0)
    <div class="mb-8">
        <div class="overflow-x-auto scrollbar-hide">
            <div class="flex gap-3 pb-4 min-w-min">

                {{-- All Movies --}}
                <a href="{{ url('/movies') }}"
                    class="flex-shrink-0 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 whitespace-nowrap
               {{ !$selectedGenre ? 'bg-white/[0.07] transition-colors duration-200 text-red-600' : ' hover:text-red-500 bg-white/[0.07] transition-colors duration-200' }}">
                    All Movies
                </a>

                {{-- Genres --}}
                @foreach ($genres as $g)
                    <a href="{{ url('/movies?genre=' . urlencode($g)) }}"
                        class="flex-shrink-0 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 whitespace-nowrap
                   {{ $selectedGenre === $g ? 'bg-white/[0.07] transition-colors duration-200 text-red-600' : ' hover:text-red-500 bg-white/[0.07] transition-colors duration-200' }}">
                        {{ $g }}
                    </a>
                @endforeach

            </div>
        </div>
    </div>
@endif

        {{-- @include('components.banner') --}}

{{-- Movies Grid --}}
@if ($movies->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 xl:grid-cols-6">

        @foreach ($movies as $movie)
            <a href="{{ url('/movies/' . $movie->id) }}" class="group block rounded-2xl overflow-hidden cursor-pointer"
                data-aos="zoom-in">

                <div class="relative">
                    <img src="{{ $movie->poster ? asset($movie->poster) : 'https://static.wikia.nocookie.net/marveldatabase/images/b/b3/All-New_Venom_Vol_1_1_Lee_Virgin_Variant.jpg' }}"
                        class="w-full object-cover rounded-2xl h-[300px] group-hover:scale-110 transition-transform duration-500">
                    {{--
            <div class="absolute top-2 left-2 px-2 py-1 rounded-lg text-xs font-medium"
                 style="background: rgba(91,79,207,0.8); color:#fff;">
                {{ $movie->genre ?? 'Movie' }}
            </div> --}}
                </div>

                <div class="px-3 pt-3 pb-2 flex flex-col gap-2">
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-gray-300 text-xs">
                            {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d M Y') : 'N/A' }}
                        </p>
{{--
                        <div class="text-xs text-white px-2 py-1 rounded-lg bg-black/60">
                            {{ floor($movie->duration / 60) }}h {{ $movie->duration % 60 }}min
                        </div> --}}
                    </div>
                    <h3 class="text-white text-sm font-semibold line-clamp-1 battambang-thin">
                        {{ $movie->title }}
                    </h3>

                </div>

            </a>
        @endforeach

    </div>

    {{-- Pagination --}}
<div class="mt-8 flex justify-center">
    {{ $movies->links() }}
</div>
@else
    <div class="text-center text-gray-400 py-20">
        <p class="text-lg">No movies available for this genre.</p>
    </div>
@endif

<style>
    @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Cinzel:wght@400..900&family=Dangrek&family=Google+Sans+Code:ital,wght,MONO@0,300..800,1;1,300..800,1&family=Hanuman:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Noto+Sans+Khmer:wght@100..900&family=Noto+Serif+Khmer:wght@100..900&family=Roboto+Slab:wght@100..900&family=Suwannaphum:wght@100;300;400;700;900&display=swap');
    .battambang-thin {
        font-family: "Lato", sans-serif;
  font-weight: 500;
  font-style: normal;
}

</style>
