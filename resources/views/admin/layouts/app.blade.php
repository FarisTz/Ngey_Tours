<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title', config('app.name', 'Laravel'))</title>

		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		<style>
			:root {
				--brand-orange: #F96D00;
				--brand-orange-light: #ffa740;
				--brand-orange-dark: #d45a00;
			}
			.btn-brand { background-color: var(--brand-orange); color: white; }
			.btn-brand:hover { background-color: var(--brand-orange-dark); }
			.text-brand { color: var(--brand-orange); }
			.border-brand { border-color: var(--brand-orange); }
			.bg-brand-light { background-color: rgba(249, 109, 0, 0.1); }
			.hover\:text-brand:hover { color: var(--brand-orange); }
			.hover\:bg-brand-light:hover { background-color: rgba(249, 109, 0, 0.1); }
			.hover\:border-brand:hover { border-color: var(--brand-orange); }
		</style>
	</head>
	<body class="min-h-screen bg-gray-50 text-gray-900">
		<div class="flex min-h-screen">
			<aside class="hidden w-72 flex-none flex-col bg-gray-900 text-gray-100 md:flex">
				<div class="flex h-20 items-center justify-center border-b px-4 text-center" style="border-color: rgba(249, 109, 0, 0.3);">
					<a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold tracking-tight text-white inline-flex items-center gap-2 transition" style="color: white;" onmouseover="this.style.color = 'var(--brand-orange)'" onmouseout="this.style.color = 'white'">
						<img src="{{ asset('logo.png') }}" alt="Ngey Tours" width="36" class="rounded-full">
						<span>Ngey Tours Admin</span>
					</a>
				</div>
				<nav class="flex flex-1 flex-col gap-1 px-4 py-6 text-sm">
					<a href="{{ route('admin.dashboard') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Dashboard</a>
					<a href="{{ route('admin.tours') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.tours*') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.tours*') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Tours</a>
					<a href="{{ route('admin.packages') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.packages*') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.packages*') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Packages</a>
					<a href="{{ route('admin.taxi.routes') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.taxi.routes*') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.taxi.routes*') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Taxi Routes</a>
					<a href="{{ route('admin.taxi.vehicles') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.taxi.vehicles*') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.taxi.vehicles*') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Taxi Vehicles</a>
					<a href="#" class="rounded-xl px-4 py-3 font-medium text-gray-300 transition border-l-4 border-transparent" onmouseover="this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00';" onmouseout="this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)';">Messages</a>
					<a href="{{ route('admin.contacts') }}" class="rounded-xl px-4 py-3 font-medium text-gray-300 transition border-l-4 border-transparent" onmouseover="this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00';" onmouseout="this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)';">Contacts</a>
                    <a href="{{ route('admin.users.index') }}" class="rounded-xl px-4 py-3 font-medium text-gray-300 transition border-l-4 border-transparent" onmouseover="this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00';" onmouseout="this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)';">Users</a>
					<a href="{{ route('admin.gallery.index') }}" class="rounded-xl px-4 py-3 font-medium transition {{ request()->routeIs('admin.gallery*') ? 'text-white' : 'text-gray-300' }}" style="{{ request()->routeIs('admin.gallery*') ? 'background-color: rgba(249, 109, 0, 0.2); border-left: 4px solid #F96D00; color: #F96D00;' : 'border-left: 4px solid transparent;' }}" onmouseover="if(!this.style.borderLeftColor.includes('249')) { this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00'; }" onmouseout="if(!this.classList.contains('active')) { this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)'; }">Gallery</a>
					<a href="#" class="rounded-xl px-4 py-3 font-medium text-gray-300 transition border-l-4 border-transparent" onmouseover="this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00';" onmouseout="this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)';">Notifications</a>

				<div class="mt-auto">
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="w-full rounded-xl px-4 py-3 text-left font-medium text-gray-300 transition border-l-4 border-transparent" onmouseover="this.style.backgroundColor = 'rgba(249, 109, 0, 0.2)'; this.style.color = '#F96D00';" onmouseout="this.style.backgroundColor = ''; this.style.color = 'rgb(209, 213, 219)';">
							Logout
						</button>
					</form>
				</div>
			</nav>
			<div class="border-t px-4 py-5 text-xs text-gray-400" style="border-color: rgba(249, 109, 0, 0.3);">

				<p class="font-semibold text-gray-200">Admin Tools</p>
				<p class="mt-2">Fast access to your content management.</p>
			</div>
			</aside>
			<div class="flex-1">
				<header class="border-b bg-white px-4 py-4 shadow-sm md:px-6" style="border-color: rgba(249, 109, 0, 0.3);">
					<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
						<div>
							<h1 class="text-2xl font-semibold text-gray-900">@yield('title', 'Admin Dashboard')</h1>
							<p class="mt-1 text-sm text-gray-500">@yield('subtitle', 'Overview of tours, packages, and activity.')</p>
						</div>
						<div class="flex flex-wrap items-center gap-3">
							<button class="inline-flex items-center gap-2 rounded-full border bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition" style="border-color: rgba(249, 109, 0, 0.3);" onmouseover="this.style.borderColor = '#F96D00'; this.style.backgroundColor = 'rgba(249, 109, 0, 0.05)';" onmouseout="this.style.borderColor = 'rgba(249, 109, 0, 0.3)'; this.style.backgroundColor = 'white';">Notifications <span class="rounded-full px-2 py-0.5 text-xs text-white" style="background-color: #F96D00;">4</span></button>
							<button class="inline-flex items-center gap-2 rounded-full border bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition" style="border-color: rgba(249, 109, 0, 0.3);" onmouseover="this.style.borderColor = '#F96D00'; this.style.backgroundColor = 'rgba(249, 109, 0, 0.05)';" onmouseout="this.style.borderColor = 'rgba(249, 109, 0, 0.3)'; this.style.backgroundColor = 'white';">Messages <span class="rounded-full px-2 py-0.5 text-xs text-white" style="background-color: #F96D00;">8</span></button>
						</div>
					</div>
				</header>
				<main class="px-4 py-6 md:px-6">
					@yield('content')
				</main>
			</div>
		</div>
		@yield('scripts')
	</body>
</html>
