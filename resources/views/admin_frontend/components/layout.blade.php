<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Admin') - Movie Booking</title>

	<!-- Tailwind Play CDN (quick, no-build) -->
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		/* Small helper for reduced-motion preference */
		@media (prefers-reduced-motion: reduce) {
			.motion-safe\:transition-none { transition: none !important; }
		}
	</style>

	@stack('head')
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

<div id="app" class="flex h-screen">

	<!-- Sidebar -->
	<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out bg-gradient-to-b from-purple-700 to-purple-600 text-white shadow-xl overflow-y-auto">
		<div class="p-6">
			<div class="mb-6 flex items-center gap-3">
				<div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center text-white font-bold text-lg">F</div>
				<div>
					<h3 class="text-lg font-semibold">FinSet</h3>
					<p class="text-xs text-white/80">Admin panel</p>
				</div>
			</div>

			<nav class="space-y-1">
				<a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition duration-200 text-sm">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center text-white">🏠</span>
					<span class="truncate">Dashboard</span>
				</a>
				<a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition duration-200 text-sm">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center text-white">💳</span>
					<span class="truncate">Transactions</span>
				</a>
				<a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition duration-200 text-sm">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center text-white">🎬</span>
					<span class="truncate">Movies</span>
				</a>
				<a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition duration-200 text-sm">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center text-white">⚙️</span>
					<span class="truncate">Settings</span>
				</a>
			</nav>

			<div class="mt-8">
				<a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg hover:bg-white/10 transition duration-200">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center">❓</span>
					<span>Help</span>
				</a>
				<a href="#" class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg hover:bg-white/10 transition duration-200 mt-2">
					<span class="w-8 h-8 bg-white/10 rounded flex items-center justify-center">↩️</span>
					<span>Log out</span>
				</a>
			</div>
		</div>
	</aside>

	<!-- Main content wrapper (pushes right when sidebar visible) -->
	<div class="flex-1 flex flex-col md:pl-64 transition-all duration-300">

		<!-- Topbar -->
		<header class="w-full bg-white border-b shadow-sm">
			<div class="max-w-7xl mx-auto flex items-center justify-between gap-4 p-4">
				<div class="flex items-center gap-3">
					<button id="sidebarToggle" class="md:hidden p-2 rounded-md hover:bg-gray-100 transition duration-200">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
					</button>
					<h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1>
				</div>

				<div class="flex items-center gap-4">
					<div class="hidden sm:flex items-center gap-3 px-3 py-2 bg-gray-100 rounded-full transition duration-200">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor"><path d="M8 4a4 4 0 100 8 4 4 0 000-8z"/></svg>
						<input type="search" placeholder="Search" class="bg-transparent outline-none text-sm" />
					</div>

					<div class="flex items-center gap-3">
						<button class="p-2 rounded-full hover:bg-gray-100 transition duration-200">🔔</button>
						<div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
							<img src="https://i.pravatar.cc/300" alt="avatar" class="w-full h-full object-cover">
						</div>
					</div>

					<!-- Widget controls -->
					<div class="hidden md:flex items-center gap-3 ml-4">
						<button class="px-3 py-2 bg-white/60 text-sm rounded-full hover:bg-white transition duration-150">Manage widgets</button>
						<button class="px-3 py-2 bg-gradient-to-tr from-purple-600 to-indigo-500 text-white text-sm rounded-full shadow-md hover:opacity-95 transition duration-150">+ Add new widget</button>
					</div>
				</div>
			</div>
		</header>

		<!-- Content area -->
		<main class="flex-1 overflow-auto p-4">
			<div class="max-w-7xl mx-auto space-y-6">
				<!-- Dashboard cards -->
				<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
					<div class="bg-white p-5 rounded-2xl shadow-lg animate-onload opacity-0 transform translate-y-4 transition-all duration-500 ease-out ring-1 ring-gray-100">
						<p class="text-sm text-gray-500">Total balance</p>
						<p class="text-2xl font-bold">$15,700.00</p>
					</div>
					<div class="bg-white p-5 rounded-2xl shadow-lg animate-onload opacity-0 transform translate-y-4 transition-all duration-500 delay-75 ease-out ring-1 ring-gray-100">
						<p class="text-sm text-gray-500">Income</p>
						<p class="text-2xl font-bold">$8,500.00</p>
					</div>
					<div class="bg-white p-5 rounded-2xl shadow-lg animate-onload opacity-0 transform translate-y-4 transition-all duration-500 delay-150 ease-out ring-1 ring-gray-100">
						<p class="text-sm text-gray-500">Expense</p>
						<p class="text-2xl font-bold">$6,222.00</p>
					</div>
					<div class="bg-white p-5 rounded-2xl shadow-lg animate-onload opacity-0 transform translate-y-4 transition-all duration-500 delay-200 ease-out ring-1 ring-gray-100">
						<p class="text-sm text-gray-500">Total savings</p>
						<p class="text-2xl font-bold">$32,913.00</p>
					</div>
				</section>

				<!-- Main layout: left content + right widgets -->
				<section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
					<div class="lg:col-span-2 space-y-4">
						<div class="bg-white p-4 rounded-lg shadow-sm animate-onload opacity-0 transform translate-y-4 transition-all duration-500">
							<h2 class="font-semibold mb-2">Money flow</h2>
							<div class="w-full h-48 bg-gradient-to-r from-purple-50 to-indigo-50 rounded"></div>
						</div>

						<div class="bg-white p-4 rounded-lg shadow-sm animate-onload opacity-0 transform translate-y-4 transition-all duration-500 delay-75">
							<h2 class="font-semibold mb-2">Recent transactions</h2>
							<div class="overflow-auto">
								<table class="w-full text-sm">
									<thead class="text-left text-gray-500 text-xs uppercase">
										<tr><th>Date</th><th>Amount</th><th>Method</th><th>Category</th></tr>
									</thead>
									<tbody>
										<tr class="border-t"><td>25 Jul</td><td>-$10</td><td>VISA</td><td>Subscription</td></tr>
										<tr class="border-t"><td>26 Jul</td><td>-$150</td><td>Mastercard</td><td>Shopping</td></tr>
										<tr class="border-t"><td>27 Jul</td><td>-$80</td><td>Mastercard</td><td>Cafe</td></tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<aside class="space-y-4">
						<div class="bg-white p-4 rounded-lg shadow-sm animate-onload opacity-0 transform translate-y-4 transition-all duration-500">
							<h3 class="font-semibold">Budget</h3>
							<div class="w-full h-32 bg-gray-50 rounded mt-3"></div>
						</div>

						<div class="bg-white p-4 rounded-lg shadow-sm animate-onload opacity-0 transform translate-y-4 transition-all duration-500 delay-75">
							<h3 class="font-semibold">Saving goals</h3>
							<div class="mt-3 space-y-3">
								<div>
									<div class="flex justify-between text-xs text-gray-500"><span>MacBook Pro</span><span>$1,650</span></div>
									<div class="w-full bg-gray-200 rounded h-2 mt-1"><div class="bg-indigo-500 h-2 rounded" style="width:25%"></div></div>
								</div>
							</div>
						</div>
					</aside>
				</section>

				@yield('extra')

			</div>
		</main>

	</div>

</div>

<!-- Small JS to handle responsive sidebar and animations -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const sidebar = document.getElementById('sidebar');
		const toggle = document.getElementById('sidebarToggle');
		const appWrapper = document.getElementById('app');

		toggle && toggle.addEventListener('click', function () {
			const isHidden = sidebar.classList.contains('-translate-x-full');
			if (isHidden) {
				sidebar.classList.remove('-translate-x-full');
				sidebar.classList.add('translate-x-0');
			} else {
				sidebar.classList.add('-translate-x-full');
				sidebar.classList.remove('translate-x-0');
			}
		});

		// Animate on load / scroll into view
		const animated = document.querySelectorAll('.animate-onload');
		animated.forEach((el, i) => {
			// staggered reveal using CSS transitions already present
			setTimeout(() => {
				el.classList.remove('opacity-0','translate-y-4');
				el.classList.add('opacity-100','translate-y-0');
			}, 80 * i);
		});

		// IntersectionObserver for elements that appear later
		const io = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.remove('opacity-0','translate-y-4');
					entry.target.classList.add('opacity-100','translate-y-0');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.05 });

		document.querySelectorAll('.animate-on-scroll').forEach(el => {
			el.classList.add('opacity-0','translate-y-6');
			io.observe(el);
		});
	});
</script>

@stack('scripts')

</body>
</html>

