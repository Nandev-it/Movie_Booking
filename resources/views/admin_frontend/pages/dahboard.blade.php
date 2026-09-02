@extends('admin_frontend.components.layout')

@section('title', 'Dashboard')

@section('content')
    @php
        $totalUsers = \App\Models\User::count();
        $totalMovies = \App\Models\Movie::count();
    @endphp

    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <section>
            <div
                class="rounded-[2rem] border border-slate-800 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.18),_transparent_45%),_radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_35%),_linear-gradient(180deg,_#020617_0%,_#0f172a_100%)] p-6 shadow-2xl shadow-slate-950/30 transition-all duration-300 ease-out hover:-translate-y-1 hover:scale-[1.01] hover:shadow-[0_25px_60px_-20px_rgba(14,165,233,0.35)] sm:p-8 lg:p-10">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-3xl">
                        <p class="text-sm uppercase tracking-[0.35em] text-sky-300/80">New releases</p>
                        <h3 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">Cinema dashboard built for your movie bookings</h3>
                        <p class="mt-4 text-sm leading-6 text-slate-300">Manage movies, showtimes, and bookings with a modern responsive admin experience inspired by the new releases dashboard layout.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="#"
                            class="inline-flex items-center justify-center rounded-full bg-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-sky-500/20 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:bg-sky-400">View schedule</a>
                        <a href="#"
                            class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/80 px-5 py-3 text-sm text-slate-200 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:border-slate-600 hover:bg-slate-800">Manage movies</a>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-sky-400/40 hover:bg-slate-800/90 hover:shadow-lg hover:shadow-sky-500/10">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Total shows</p>
                        <p class="mt-4 text-3xl font-semibold text-white">128</p>
                        <p class="mt-2 text-sm text-slate-400">Scheduled this week</p>
                    </div>
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-sky-400/40 hover:bg-slate-800/90 hover:shadow-lg hover:shadow-sky-500/10">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Total users</p>
                        <p class="mt-4 text-3xl font-semibold text-white">{{ $totalUsers }}</p>
                        <p class="mt-2 text-sm text-slate-400">Registered accounts</p>
                    </div>
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-sky-400/40 hover:bg-slate-800/90 hover:shadow-lg hover:shadow-sky-500/10">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Total movies</p>
                        <p class="mt-4 text-3xl font-semibold text-white">{{ $totalMovies }}</p>
                        <p class="mt-2 text-sm text-slate-400">In the catalog</p>
                    </div>
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5 transition-all duration-300 ease-out hover:-translate-y-1 hover:border-sky-400/40 hover:bg-slate-800/90 hover:shadow-lg hover:shadow-sky-500/10">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Conversion</p>
                        <p class="mt-4 text-3xl font-semibold text-white">12.4%</p>
                        <p class="mt-2 text-sm text-slate-400">Ticket sales</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-4 mt-3">
            <div class="flex flex-wrap items-center gap-3">
                <span
                    class="rounded-full bg-slate-900/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">All</span>
                <span
                    class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Action</span>
                <span
                    class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Comedy</span>
                <span
                    class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Drama</span>
                <span
                    class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Horror</span>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div
                    class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
                    <div class="h-44 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950"></div>
                    <div class="p-5">
                        <p class="text-sm text-slate-400">Interstellar</p>
                        <p class="mt-3 font-semibold text-white">Sci-fi Classic</p>
                        <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                            <span>2014</span>
                            <button
                                class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
                        </div>
                    </div>
                </div>
                <div
                    class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
                    <div class="h-44 bg-gradient-to-br from-slate-800 via-violet-900 to-slate-950"></div>
                    <div class="p-5">
                        <p class="text-sm text-slate-400">Deadpool & Wolverine</p>
                        <p class="mt-3 font-semibold text-white">Marvel Action</p>
                        <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                            <span>2024</span>
                            <button
                                class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
                        </div>
                    </div>
                </div>
                <div
                    class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
                    <div class="h-44 bg-gradient-to-br from-slate-700 via-teal-900 to-slate-950"></div>
                    <div class="p-5">
                        <p class="text-sm text-slate-400">Inception</p>
                        <p class="mt-3 font-semibold text-white">Mind-bending</p>
                        <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                            <span>2010</span>
                            <button
                                class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
                        </div>
                    </div>
                </div>
                <div
                    class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
                    <div class="h-44 bg-gradient-to-br from-slate-900 via-rose-900 to-slate-950"></div>
                    <div class="p-5">
                        <p class="text-sm text-slate-400">Dune</p>
                        <p class="mt-3 font-semibold text-white">Epic Drama</p>
                        <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                            <span>2024</span>
                            <button
                                class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Recent activity</p>
                        <h3 class="mt-2 text-2xl font-semibold text-white">Latest bookings</h3>
                    </div>
                    <button
                        class="rounded-full border border-slate-800 bg-slate-900/90 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-900">View
                        all</button>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full border-separate border-spacing-y-3 text-left text-sm text-slate-300">
                        <thead class="text-slate-500 text-xs uppercase tracking-[0.24em]">
                            <tr>
                                <th class="px-4 py-3">Movie</th>
                                <th class="px-4 py-3">Showtime</th>
                                <th class="px-4 py-3">Seats</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-slate-900/80 rounded-3xl">
                                <td class="px-4 py-4">Pacific Rim</td>
                                <td class="px-4 py-4">Sat 7:30 PM</td>
                                <td class="px-4 py-4">48</td>
                                <td class="px-4 py-4 text-emerald-300">Confirmed</td>
                            </tr>
                            <tr class="bg-slate-900/80 rounded-3xl">
                                <td class="px-4 py-4">Interstellar</td>
                                <td class="px-4 py-4">Sun 4:00 PM</td>
                                <td class="px-4 py-4">32</td>
                                <td class="px-4 py-4 text-sky-300">Pending</td>
                            </tr>
                            <tr class="bg-slate-900/80 rounded-3xl">
                                <td class="px-4 py-4">Spider-Man</td>
                                <td class="px-4 py-4">Mon 8:00 PM</td>
                                <td class="px-4 py-4">24</td>
                                <td class="px-4 py-4 text-amber-300">Review</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Quick stats</p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
                            <p class="text-sm text-slate-400">Available seats</p>
                            <p class="mt-2 text-2xl font-semibold text-white">1,256</p>
                        </div>
                        <div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
                            <p class="text-sm text-slate-400">Revenue today</p>
                            <p class="mt-2 text-2xl font-semibold text-white">$9,840</p>
                        </div>
                        <div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
                            <p class="text-sm text-slate-400">Live viewers</p>
                            <p class="mt-2 text-2xl font-semibold text-white">3,412</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-2xl shadow-slate-950/20">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Today</p>
                    <div class="mt-6 grid gap-4">
                        <button
                            class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">Add
                            new release</button>
                        <button
                            class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">Publish
                            schedule</button>
                        <button
                            class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">View
                            analytics</button>
                    </div>
                </div>
            </aside>
        </section>

        @yield('extra')
    </div>
@endsection
