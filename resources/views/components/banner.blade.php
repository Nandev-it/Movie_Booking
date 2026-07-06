{{-- Movie slider banner --}}
{{-- Movie Slider Banner --}}
<section class="relative w-full overflow-hidden py-6">

    <h2 class="text-white text-xl font-bold px-6 mb-4 tracking-wide">🎬 Trending Now</h2>

    <!-- Fade edges -->
    <div class="pointer-events-none absolute left-0 top-0 h-full w-16 z-10"
        style="background: linear-gradient(to right, #09090b, transparent)"></div>
    <div class="pointer-events-none absolute right-0 top-0 h-full w-16 z-10"
        style="background: linear-gradient(to left, #09090b, transparent)"></div>

    <!-- Scroll Wrapper -->
    <div id="movieSlider"
        class="flex gap-4 overflow-x-auto scroll-smooth px-6 pb-4 cursor-grab active:cursor-grabbing"
        style="scrollbar-width: none; -ms-overflow-style: none;">

        {{-- Movie Cards --}}
        @foreach ($movies as $movie)
        <div class="group relative flex-shrink-0 w-[160px] md:w-[200px] rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 hover:z-20">
            <img src="{{ $movie->poster ? asset($movie->poster) : 'https://static.wikia.nocookie.net/marveldatabase/images/b/b3/All-New_Venom_Vol_1_1_Lee_Virgin_Variant.jpg' }}"
                class="w-full h-[240px] md:h-[280px] object-cover" alt="{{ $movie->title }}">

            <!-- Hover Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                <p class="text-white text-sm font-bold leading-tight">{{ $movie->title }}</p>
                <p class="text-zinc-400 text-xs mt-1">{{ $movie->release_year ?? '' }}</p>
                <a href="{{ url('movies.show', $movie->id) }}"
                    class="mt-2 inline-block bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors duration-200 text-center">
                    ▶ Watch Now
                </a>
            </div>
        </div>
        @endforeach

    </div>
</section>

{{-- Hide scrollbar for Chrome/Safari --}}
<style>
    #movieSlider::-webkit-scrollbar { display: none; }
</style>

{{-- Drag to scroll + Auto scroll --}}
<script>
    const slider = document.getElementById('movieSlider');

    // Drag to scroll
    let isDown = false, startX, scrollLeft;

    slider.addEventListener('mousedown', e => {
        isDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => isDown = false);
    slider.addEventListener('mouseup', () => isDown = false);
    slider.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        slider.scrollLeft = scrollLeft - (x - startX) * 1.5;
    });

    // Auto scroll
    let autoScroll = setInterval(() => {
        if (!isDown) {
            slider.scrollLeft += 1;
            // Reset to start when reaching end
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollLeft = 0;
            }
        }
    }, 20);

    // Pause auto scroll on hover
    slider.addEventListener('mouseenter', () => clearInterval(autoScroll));
    slider.addEventListener('mouseleave', () => {
        autoScroll = setInterval(() => {
            slider.scrollLeft += 1;
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollLeft = 0;
            }
        }, 20);
    });
</script>
