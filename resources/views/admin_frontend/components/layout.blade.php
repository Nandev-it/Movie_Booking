<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Admin') - Movie Booking</title>

	<!-- Tailwind Play CDN (quick, no-build) -->
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		body {
			background: #020617;
		}

		@media (prefers-reduced-motion: reduce) {
			.motion-safe\:transition-none { transition: none !important; }
		}

		.sidebar-glow {
			box-shadow: 0 30px 60px rgba(15, 23, 42, 0.45);
		}

		.card-glass {
			background: rgba(15, 23, 42, 0.82);
			backdrop-filter: blur(18px);
			-webkit-backdrop-filter: blur(18px);
		}
	</style>

	@stack('head')
</head>
<body class="min-h-screen text-slate-100 antialiased">

<div id="app" class="flex min-h-screen overflow-hidden">

	<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-72 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out bg-slate-950/95 border-r border-slate-800 sidebar-glow overflow-y-auto">
		<div class="px-6 py-5">
			<div class="mb-7 flex items-center gap-3">
				<div class="w-12 h-12 rounded-3xl bg-sky-500/15 border border-sky-400/20 flex items-center justify-center text-xl text-sky-300">C</div>
				<div>
					<p class="text-xs uppercase tracking-[0.35em] text-slate-400">Cinevers Legend </p>
					<h1 class="text-lg font-semibold text-white">Admin panel</h1>
				</div>
			</div>

			@auth
			@php
				$user = Auth::user();
				$avatar = $user->getAttribute('avatar') ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->getAttribute('email') ?? ''))) . '?d=mp&s=160';
				$userName = $user->getAttribute('name') ?? 'Admin';
				$userEmail = $user->getAttribute('email') ?? 'admin@example.com';
			@endphp
			<div class="mb-6 rounded-[1.5rem] border border-slate-800/80 bg-slate-900/70 p-4">
				<div class="flex items-center gap-3">
					<img src="{{ $avatar }}" alt="{{ $userName }}" class="h-12 w-12 rounded-2xl object-cover ring-2 ring-slate-700" />
					<div class="min-w-0">
						<p class="truncate text-sm font-semibold text-white">{{ $userName }}</p>
						<p class="truncate text-xs text-slate-400">{{ $userEmail }}</p>
					</div>
				</div>
				<form action="{{ route('logout') }}" method="POST" class="mt-3">
					@csrf
					<button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-700 bg-slate-800/80 px-3 py-2 text-sm text-slate-200 transition hover:bg-slate-700/80">
						<span>↪</span>
						<span>Logout</span>
					</button>
				</form>
			</div>
			@endauth

			<nav class="space-y-1">
				<a href="#" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm text-slate-200 hover:bg-slate-800/80 transition">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-sky-300">🏠</span>
					<span>Dashboard</span>
				</a>
				<a href="#" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm text-slate-200 hover:bg-slate-800/80 transition">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-amber-300">🎟️</span>
					<span>Bookings</span>
				</a>
				<a href="#" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm text-slate-200 hover:bg-slate-800/80 transition">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-cyan-300">🎬</span>
					<span>Movies</span>
				</a>
				<a href="#" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm text-slate-200 hover:bg-slate-800/80 transition">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-lime-300">🧑‍🤝‍🧑</span>
					<span>Users</span>
				</a>
				<a href="#" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm text-slate-200 hover:bg-slate-800/80 transition">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 text-violet-300">⚙️</span>
					<span>Settings</span>
				</a>
			</nav>

			<div class="mt-10 space-y-3">
				<p class="text-xs uppercase tracking-[0.25em] text-slate-500">Quick actions</p>
				<a href="#" class="flex items-center justify-between rounded-3xl border border-slate-800 bg-slate-900/80 px-4 py-3 text-sm text-slate-200 hover:border-slate-700 transition">
					<span>Upload movie</span>
					<span class="text-sky-300">+</span>
				</a>
				<a href="#" class="flex items-center justify-between rounded-3xl border border-slate-800 bg-slate-900/80 px-4 py-3 text-sm text-slate-200 hover:border-slate-700 transition">
					<span>Review requests</span>
					<span class="text-amber-300">3</span>
				</a>
			</div>
		</div>
	</aside>

	<div class="flex-1 flex flex-col md:pl-72">

		<header class="none md:fixed inset-x-0 top-0 z-40 border-b border-slate-800 bg-slate-950/95 backdrop-blur-xl md:left-72 md:right-0">
			{{-- <div class="max-w-7xl mx-auto flex flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between"> --}}
			<div class="flex flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
				<div class="flex items-center gap-3">
					<button id="sidebarToggle" class="md:hidden inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-800 bg-slate-900 text-slate-200 hover:border-slate-700 transition">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
					</button>
					<div>
						<p class="text-sm text-slate-500">Welcome back,</p>
						<h2 class="text-xl font-semibold text-white">@yield('title', 'Dashboard')</h2>
					</div>
				</div>

				<div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
					<div class="relative w-full sm:max-w-xl">
						<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" /></svg>
						</div>
						<input type="search" placeholder="Search movies, bookings, users..." class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 py-3 pl-11 pr-4 text-sm text-slate-100 outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20" />
					</div>

					<div class="hidden md:flex items-center gap-3">
						<button class="hidden md:inline-flex  h-11 items-center justify-center rounded-3xl border border-slate-800 bg-slate-900/90 px-4 text-sm text-slate-200 transition hover:bg-slate-900">
							<span class="text-slate-300"> <img src="{{ asset('assets/icons/bell.png') }}" class="h-5 w-5" alt=""></span>
						</button>
						<div class="hidden md:flex items-center gap-3 rounded-3xl border border-slate-800 bg-slate-900/90 px-3 py-2">
							<div class="h-10 w-10 overflow-hidden rounded-full bg-slate-700">
								<img src="https://i.pravatar.cc/300" alt="avatar" class="h-full w-full object-cover" />
							</div>
							<div class="hidden sm:block">
								<p class="text-sm text-slate-400">Admin</p>
								<p class="text-sm font-semibold text-white">Khem Sopheanan</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<main class="flex-1 overflow-auto bg-slate-950 pt-28 md:pt-24">
			<div class=" px-4 py-6 sm:px-6 lg:px-8">

				<section class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
					<div class="rounded-[2rem] border border-slate-800 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.18),_transparent_45%),_radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_35%),_linear-gradient(180deg,_#020617_0%,_#0f172a_100%)] p-6 shadow-2xl shadow-slate-950/30">
						<div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
							<div>
								<p class="text-sm uppercase tracking-[0.35em] text-sky-300/80">New releases</p>
								<h3 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">Cinema dashboard built for your movie bookings</h3>
								<p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300">Manage movies, showtimes, and bookings with a modern responsive admin experience inspired by the new releases dashboard layout.</p>
							</div>
							<div class="flex flex-wrap gap-3">
								<a href="#" class="inline-flex items-center justify-center rounded-full bg-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-sky-500/20 transition hover:bg-sky-400">View schedule</a>
								<a href="#" class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/80 px-5 py-3 text-sm text-slate-200 transition hover:border-slate-600">Manage movies</a>
							</div>
						</div>

						<div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
							<div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5">
								<p class="text-sm uppercase tracking-[0.3em] text-slate-500">Total shows</p>
								<p class="mt-4 text-3xl font-semibold text-white">128</p>
								<p class="mt-2 text-sm text-slate-400">Scheduled this week</p>
							</div>
							<div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5">
								<p class="text-sm uppercase tracking-[0.3em] text-slate-500">New visitors</p>
								<p class="mt-4 text-3xl font-semibold text-white">4.8k</p>
								<p class="mt-2 text-sm text-slate-400">Last 30 days</p>
							</div>
							<div class="rounded-3xl border border-slate-800 bg-slate-900/90 p-5">
								<p class="text-sm uppercase tracking-[0.3em] text-slate-500">Conversion</p>
								<p class="mt-4 text-3xl font-semibold text-white">12.4%</p>
								<p class="mt-2 text-sm text-slate-400">Ticket sales</p>
							</div>
						</div>
					</div>

					<aside class="space-y-6">
						<div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-xl shadow-slate-950/20">
							<div class="flex items-center justify-between gap-4">
								<div>
									<p class="text-sm uppercase tracking-[0.3em] text-slate-500">Popular</p>
									<h4 class="mt-2 text-xl font-semibold text-white">Featured movies</h4>
								</div>
								<span class="text-xs uppercase tracking-[0.35em] text-slate-500">Today</span>
							</div>

							<div class="mt-6 space-y-4">
								<div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
									<div class="flex items-center justify-between gap-3">
										<div>
											<p class="text-sm text-slate-400">The Batman</p>
											<p class="text-xs text-slate-500">2022 · Action</p>
										</div>
										<span class="rounded-full bg-slate-800 px-3 py-1 text-xs text-slate-300">8.5</span>
									</div>
								</div>
								<div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
									<div class="flex items-center justify-between gap-3">
										<div>
											<p class="text-sm text-slate-400">Spider-Man</p>
											<p class="text-xs text-slate-500">2023 · Adventure</p>
										</div>
										<span class="rounded-full bg-slate-800 px-3 py-1 text-xs text-slate-300">7.9</span>
									</div>
								</div>
							</div>
						</div>

						<div class="rounded-[2rem] border border-slate-800 bg-slate-950/95 p-6 shadow-xl shadow-slate-950/20">
							<p class="text-sm uppercase tracking-[0.3em] text-slate-500">Performance</p>
							<div class="mt-6 space-y-4">
								<div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
									<p class="text-sm text-slate-400">Avg. ticket price</p>
									<p class="mt-2 text-2xl font-semibold text-white">$12.40</p>
								</div>
								<div class="rounded-3xl bg-slate-900/90 p-4 border border-slate-800">
									<p class="text-sm text-slate-400">Active cinemas</p>
									<p class="mt-2 text-2xl font-semibold text-white">24</p>
								</div>
							</div>
						</div>
					</aside>
				</section>

				<section class="space-y-4">
					<div class="flex flex-wrap items-center gap-3">
						<span class="rounded-full bg-slate-900/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">All</span>
						<span class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Action</span>
						<span class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Comedy</span>
						<span class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Drama</span>
						<span class="rounded-full bg-slate-800/80 px-4 py-2 text-xs uppercase tracking-[0.25em] text-slate-400">Horror</span>
					</div>

					<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
						<div class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
							<div class="h-44 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950"></div>
							<div class="p-5">
								<p class="text-sm text-slate-400">Interstellar</p>
								<p class="mt-3 font-semibold text-white">Sci-fi Classic</p>
								<div class="mt-4 flex items-center justify-between text-sm text-slate-500">
									<span>2014</span>
									<button class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
								</div>
							</div>
						</div>
						<div class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
							<div class="h-44 bg-gradient-to-br from-slate-800 via-violet-900 to-slate-950"></div>
							<div class="p-5">
								<p class="text-sm text-slate-400">Deadpool & Wolverine</p>
								<p class="mt-3 font-semibold text-white">Marvel Action</p>
								<div class="mt-4 flex items-center justify-between text-sm text-slate-500">
									<span>2024</span>
									<button class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
								</div>
							</div>
						</div>
						<div class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
							<div class="h-44 bg-gradient-to-br from-slate-700 via-teal-900 to-slate-950"></div>
							<div class="p-5">
								<p class="text-sm text-slate-400">Inception</p>
								<p class="mt-3 font-semibold text-white">Mind-bending</p>
								<div class="mt-4 flex items-center justify-between text-sm text-slate-500">
									<span>2010</span>
									<button class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
								</div>
							</div>
						</div>
						<div class="rounded-[2rem] overflow-hidden border border-slate-800 bg-slate-950/95 shadow-xl shadow-slate-950/20">
							<div class="h-44 bg-gradient-to-br from-slate-900 via-rose-900 to-slate-950"></div>
							<div class="p-5">
								<p class="text-sm text-slate-400">Dune</p>
								<p class="mt-3 font-semibold text-white">Epic Drama</p>
								<div class="mt-4 flex items-center justify-between text-sm text-slate-500">
									<span>2024</span>
									<button class="rounded-full border border-slate-800 px-3 py-1 text-slate-300 hover:bg-slate-900">Watch</button>
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
							<button class="rounded-full border border-slate-800 bg-slate-900/90 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-900">View all</button>
						</div>

						<div class="mt-6 overflow-x-auto">
							<table class="min-w-full border-separate border-spacing-y-3 text-left text-sm text-slate-300">
								<thead class="text-slate-500 text-xs uppercase tracking-[0.24em]"><tr><th class="px-4 py-3">Movie</th><th class="px-4 py-3">Showtime</th><th class="px-4 py-3">Seats</th><th class="px-4 py-3">Status</th></tr></thead>
								<tbody>
									<tr class="bg-slate-900/80 rounded-3xl"><td class="px-4 py-4">Pacific Rim</td><td class="px-4 py-4">Sat 7:30 PM</td><td class="px-4 py-4">48</td><td class="px-4 py-4 text-emerald-300">Confirmed</td></tr>
									<tr class="bg-slate-900/80 rounded-3xl"><td class="px-4 py-4">Interstellar</td><td class="px-4 py-4">Sun 4:00 PM</td><td class="px-4 py-4">32</td><td class="px-4 py-4 text-sky-300">Pending</td></tr>
									<tr class="bg-slate-900/80 rounded-3xl"><td class="px-4 py-4">Spider-Man</td><td class="px-4 py-4">Mon 8:00 PM</td><td class="px-4 py-4">24</td><td class="px-4 py-4 text-amber-300">Review</td></tr>
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
								<button class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">Add new release</button>
								<button class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">Publish schedule</button>
								<button class="w-full rounded-3xl border border-slate-800 bg-slate-900/90 px-4 py-3 text-left text-sm text-slate-200 transition hover:bg-slate-900">View analytics</button>
							</div>
						</div>
					</aside>
				</section>

				@yield('extra')
			</div>
		</main>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const sidebar = document.getElementById('sidebar');
		const toggle = document.getElementById('sidebarToggle');

		toggle && toggle.addEventListener('click', function () {
			if (sidebar.classList.contains('-translate-x-full')) {
				sidebar.classList.remove('-translate-x-full');
				sidebar.classList.add('translate-x-0');
			} else {
				sidebar.classList.add('-translate-x-full');
				sidebar.classList.remove('translate-x-0');
			}
		});

		const animated = document.querySelectorAll('.animate-onload');
		animated.forEach((el, i) => {
			setTimeout(() => {
				el.classList.remove('opacity-0','translate-y-4');
				el.classList.add('opacity-100','translate-y-0');
			}, 80 * i);
		});
	});
</script>

@stack('scripts')
</body>
</html>

