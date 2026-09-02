<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Movie Booking</title>

    <!-- Tailwind Play CDN (quick, no-build) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
        }

        #app {
            transition: transform 0.25s ease;
        }

        #sidebar {
            transition: transform 0.34s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.34s ease;
        }

        #sidebarOverlay {
            transition: opacity 0.25s ease;
        }

        .mobile-header-shell {
            transition: max-height 0.3s ease, opacity 0.25s ease, transform 0.25s ease;
        }

        .sidebar-link,
        .nav-dropdown-toggle,
        .nav-dropdown .submenu a,
        .header-action {
            transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @media (prefers-reduced-motion: reduce) {
            .motion-safe\:transition-none {
                transition: none !important;
            }
        }

        .sidebar-glow {
            box-shadow: 0 30px 70px rgba(2, 6, 23, 0.45);
        }

        .card-glass {
            background: rgba(15, 23, 42, 0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .submenu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-6px);
            transition: max-height 0.35s ease, opacity 0.3s ease, transform 0.3s ease, padding 0.3s ease;
        }

        .nav-dropdown.open .submenu {
            max-height: 32rem;
            opacity: 1;
            transform: translateY(0);
        }

        .nav-dropdown.open .chevron {
            transform: rotate(180deg);
        }

        .nav-dropdown.open .nav-dropdown-toggle {
            background: linear-gradient(90deg, rgba(30, 41, 59, 0.96), rgba(15, 23, 42, 0.92));
            border-color: rgba(125, 211, 252, 0.25);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 10px 24px rgba(14, 165, 233, 0.12);
        }

        .nav-dropdown-toggle {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .nav-dropdown .submenu a {
            position: relative;
            padding-left: 1rem;
        }

        .nav-dropdown .submenu a::before {
            content: '';
            position: absolute;
            left: 0.2rem;
            top: 50%;
            width: 0.35rem;
            height: 0.35rem;
            border-radius: 9999px;
            background: rgba(125, 211, 252, 0.7);
            transform: translateY(-50%) scale(0.6);
            transition: transform 0.2s ease;
        }

        .nav-dropdown .submenu a:hover::before {
            transform: translateY(-50%) scale(1);
        }
    </style>

    @stack('head')
</head>

<body class="min-h-screen text-slate-100 antialiased">

    <div id="sidebarOverlay" class="fixed inset-0 z-30 hidden bg-slate-950/70 backdrop-blur-sm md:hidden"></div>

    <div id="app" class="relative flex min-h-screen overflow-hidden">

        @php
            $currentUser = Auth::check() ? Auth::user() : null;
            $isUserRole = $currentUser ? strtolower($currentUser->getAttribute('role') ?? '') === 'user' : false;
        @endphp

        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-[85vw] max-w-[18rem] -translate-x-full transform overflow-y-auto border-r border-slate-800/80 bg-slate-950/95 shadow-[0_30px_80px_rgba(2,6,23,0.40)] backdrop-blur-xl md:w-72 md:translate-x-0 md:shadow-[0_35px_80px_rgba(2,6,23,0.45)]">
            <div class="px-3 py-4 sm:px-5 sm:py-5 lg:px-6 lg:py-6">
                <div
                    class="mb-7 flex items-center gap-3 rounded-[1.4rem] border border-slate-800/70 bg-slate-900/70 p-3 shadow-[0_10px_25px_rgba(2,6,23,0.18)] lg:p-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-sky-400/20 bg-sky-500/15 text-xl text-sky-300 shadow-inner shadow-sky-500/10">
                        M</div>
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.35em] text-slate-400">Movie Booking</p>
                        <h1 class="text-base font-semibold text-white">Admin Dashboard</h1>
                    </div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ $isUserRole ? 'javascript:void(0)' : url('admin/dashboard') }}"
                        class="group flex items-center gap-3 rounded-[1.2rem] border border-transparent px-4 py-3 text-sm transition-all duration-300 {{ $isUserRole ? 'text-slate-500 opacity-60' : 'text-slate-200 hover:-translate-y-0.5 hover:border-slate-700/70 hover:bg-slate-800/80' }}"
                        aria-disabled="{{ $isUserRole ? 'true' : 'false' }}"
                        {{ $isUserRole ? 'onclick="return false;"' : '' }}>
                        <span
                            class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 transition-all duration-300 shadow-inner shadow-slate-950/20 {{ $isUserRole ? '' : 'group-hover:bg-slate-700/70 group-hover:backdrop-blur-md' }}">
                            <img src="{{ asset('assets/icons/dashboard/dashboard.png') }}" alt="Dashboard"
                                class="h-6 w-6 object-contain" />
                        </span>
                        <span>Dashboard</span>
                    </a>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-cyan-300">🎞️</span>
                                <span>Movie Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Add
                                    Movie</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Edit
                                    Movie</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Delete
                                    Movie</a>
                                <a href="{{ url('admin/movies') }}"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">View
                                    Movie Details</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Upload
                                    Movie Poster</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Upload
                                    Trailer URL</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Set
                                    Genre</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Set
                                    Duration</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Set
                                    Language</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Set
                                    Age Rating</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">Set
                                    Movie Status</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-amber-300">🎭</span>
                                <span>Genre Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Add Genre</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Edit Genre</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Delete Genre</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-emerald-300">🕒</span>
                                <span>Showtime Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Add Showtime</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Edit Showtime</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Delete Showtime</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Assign Movie</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Assign Screen</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Date</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Time</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Ticket Price</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-lime-300">🏛️</span>
                                <span>Screen Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Add Screen</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Edit Screen</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Delete Screen</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Screen Name</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Capacity</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-sky-300">🪑</span>
                                <span>Seat Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Create Seat Layout</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Add Seats</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Edit Seats</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Delete Seats</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Set Seat Type</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Seat Status</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-amber-300">🎟️</span>
                                <span>Booking Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    View All Bookings</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Booking Details</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Search Booking</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Filter Booking</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Cancel Booking</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Confirm Booking</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Print Ticket</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-lime-300">🧑‍🤝‍🧑</span>
                                <span>Customer Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    View Customers</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Customer Details</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Booking History</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Search Customer</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Disable/Enable Account</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-violet-300">💳</span>
                                <span>Payment Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Payment History</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Payment Status</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Revenue Records</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Refund Management</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-fuchsia-300">📈</span>
                                <span>Report Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Daily Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Weekly Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Monthly Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Revenue Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Booking Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Popular Movies Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Seat Occupancy Report</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Export PDF</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Export Excel</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-emerald-300">👤</span>
                                <span>User Management</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="{{ url('admin/users') }}"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Manage Accounts</a>
                                <a href="{{ url('admin/users/create') }}"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Add User</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    Reset Password</a>
                                <a href="#"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">•
                                    View Login Activity</a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="nav-dropdown rounded-[1.5rem] border border-slate-800/70 bg-slate-900/50 shadow-[0_10px_30px_rgba(2,6,23,0.25)]">
                        <button type="button"
                            class="nav-dropdown-toggle flex w-full items-center justify-between rounded-[1.5rem] px-4 py-3 text-left text-sm text-slate-200 transition-all duration-300 hover:bg-slate-800/80 hover:translate-x-1"
                            aria-expanded="false">
                            <span class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-emerald-300">⚙️</span>
                                <span>System Settings</span>
                            </span>
                            <svg class="chevron h-4 w-4 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="submenu px-2 pb-2">
                            <div class="space-y-1 border-t border-slate-800/70 pt-2">
                                <a href="{{ route('admin.profile.edit') }}"
                                    class="flex items-center rounded-2xl px-3 py-2 text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">
                                    <span class="mr-2">•</span> Profile
                                </a>

                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center rounded-2xl px-3 py-2 text-left text-sm text-slate-300 transition-all duration-200 hover:bg-slate-800/70 hover:text-white">
                                        <span class="mr-2">•</span> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </nav>

                @auth
                    @php
                        $user = Auth::user();
                        $defaultAvatar = 'https://i.pinimg.com/1200x/d4/a5/82/d4a5829f2d13dac1c9c0d00e4c19e1ad.jpg';
                        $avatar = $user->getAttribute('avatar') ?: $defaultAvatar;
                        $userName = $user->getAttribute('name') ?? 'Admin';
                        $userEmail = $user->getAttribute('email') ?? 'admin@example.com';
                    @endphp
                    <div class="mt-10">
                        <p class="mb-3 text-xs uppercase tracking-[0.25em] text-slate-500">Account</p>
                        <div class="relative">
                            <button id="accountToggle" type="button"
                                class="flex w-full items-center gap-3 rounded-3xl border border-slate-800 bg-slate-900/80 px-4 py-3 text-sm text-slate-200 transition hover:border-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500/50">
                                <img src="{{ $avatar }}" alt="{{ $userName }}"
                                    class="h-11 w-11 rounded-2xl object-cover ring-1 ring-slate-700"
                                    onerror="this.onerror=null;this.src='https://i.pinimg.com/736x/6a/38/61/6a3861344558d2fcfc978f55ffd699b4.jpg';" />
                                <div class="min-w-0 text-left">
                                    <p class="truncate font-semibold text-white">{{ $userName }}</p>
                                    <p class="truncate text-xs text-slate-400">{{ $userEmail }}</p>
                                </div>
                            </button>
                        </div>
                    </div>
                @endauth
            </div>
        </aside>

        <div class="flex-1 flex flex-col md:pl-72">

            <header
                class="sticky top-0 z-40 border-b border-slate-800/70 bg-slate-950/95 backdrop-blur-2xl shadow-[0_10px_30px_rgba(2,6,23,0.18)] md:fixed md:left-72 md:right-0 md:shadow-[0_12px_32px_rgba(2,6,23,0.24)]">
                <div
                    class="mobile-header-shell flex flex-col gap-3 px-3 py-2 sm:flex-row sm:items-center sm:justify-between sm:px-4 sm:py-4 lg:px-6">
                    <div class="flex items-center justify-between gap-3 md:justify-start">
                        <div class="flex items-center gap-3">
                            <button id="sidebarToggle"
                                class="header-action inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-800 bg-slate-900/90 text-slate-200 shadow-sm shadow-slate-950/30 hover:border-slate-700 hover:bg-slate-800/90 active:scale-95"
                                aria-label="Toggle sidebar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <div class="min-w-0">
                                <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500 md:text-[11px]">Welcome
                                    back</p>
                                <h2 class="truncate text-base font-semibold text-white sm:text-lg">@yield('title', 'Cineverse Legend')
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="hidden flex-1 flex-col gap-3 sm:flex-row sm:items-center sm:justify-between md:flex">
                        <div class="relative w-full sm:max-w-xl lg:max-w-2xl">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                            </div>
                            <input type="search" placeholder="Search movies, bookings, users..."
                                class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 py-3 pl-11 pr-4 text-sm text-slate-100 shadow-[0_10px_25px_rgba(2,6,23,0.14)] outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20" />
                        </div>

                        <div class="hidden md:flex items-center gap-3">
                            <button
                                class="header-action hidden h-11 items-center justify-center rounded-3xl border border-slate-800 bg-slate-900/90 px-4 text-sm text-slate-200 shadow-sm shadow-slate-950/20 hover:bg-slate-800/90 md:inline-flex">
                                <span class="text-slate-300"> <img src="{{ asset('assets/icons/bell.png') }}"
                                        class="h-5 w-5" alt=""></span>
                            </button>
                            <div
                                class="header-action hidden items-center gap-3 rounded-3xl border border-slate-800 bg-slate-900/90 px-3 py-2 shadow-sm shadow-slate-950/20 hover:bg-slate-800/90 md:flex">
                                <div class="h-10 w-10 overflow-hidden rounded-full bg-slate-700">
                                    <img src="{{ $avatar }}" alt="{{ $userName }}"
                                        class="h-full w-full object-cover"
                                        onerror="this.onerror=null;this.src='https://i.pinimg.com/736x/6a/38/61/6a3861344558d2fcfc978f55ffd699b4.jpg';" />
                                </div>
                                <div class="hidden sm:block">
                                    <p class="text-sm text-slate-400">{{ $userRole ?? 'Admin' }}</p>
                                    <p class="text-sm font-semibold text-white">{{ $userName ?? 'Admin' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-auto bg-slate-950 pt-4 sm:pt-6 md:pt-28">
                <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
                    @yield('content')
                    @yield('extra')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('sidebarToggle');

            const setSidebarState = (open) => {
                if (!sidebar) return;

                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    if (overlay) overlay.classList.add('hidden');
                    return;
                }

                if (open) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    if (overlay) overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    if (overlay) overlay.classList.add('hidden');
                }
            };

            toggle && toggle.addEventListener('click', function() {
                const isOpen = sidebar && sidebar.classList.contains('translate-x-0');
                setSidebarState(!isOpen);
            });

            document.querySelectorAll('.mobile-header-shell .header-action').forEach((button) => {
                button.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        const isOpen = sidebar && sidebar.classList.contains('translate-x-0');
                        setSidebarState(!isOpen);
                    }
                });
            });

            overlay && overlay.addEventListener('click', function() {
                setSidebarState(false);
            });

            window.addEventListener('resize', function() {
                setSidebarState(window.innerWidth >= 768);
            });

            document.querySelectorAll('.sidebar-link, .nav-dropdown a').forEach((link) => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        setSidebarState(false);
                    }
                });
            });

            setSidebarState(window.innerWidth >= 768);

            const dropdowns = document.querySelectorAll('.nav-dropdown');
            dropdowns.forEach((dropdown) => {
                const button = dropdown.querySelector('.nav-dropdown-toggle');
                if (!button) return;

                button.addEventListener('click', () => {
                    const shouldOpen = !dropdown.classList.contains('open');

                    dropdowns.forEach((item) => {
                        item.classList.remove('open');
                        const itemButton = item.querySelector('.nav-dropdown-toggle');
                        if (itemButton) {
                            itemButton.setAttribute('aria-expanded', 'false');
                        }
                    });

                    if (shouldOpen) {
                        dropdown.classList.add('open');
                        button.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            const animated = document.querySelectorAll('.animate-onload');
            animated.forEach((el, i) => {
                setTimeout(() => {
                    el.classList.remove('opacity-0', 'translate-y-4');
                    el.classList.add('opacity-100', 'translate-y-0');
                }, 80 * i);
            });
        });
    </script>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accountToggle = document.getElementById('accountToggle');
            const accountMenu = document.getElementById('accountMenu');
            if (accountToggle && accountMenu) {
                accountToggle.addEventListener('click', function(event) {
                    event.preventDefault();
                    accountMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', function(event) {
                    if (!accountToggle.contains(event.target) && !accountMenu.contains(event.target)) {
                        accountMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>
