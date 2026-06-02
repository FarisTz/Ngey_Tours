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
	</head>
	<body class="min-h-screen bg-slate-100 text-slate-900">
		<div class="flex min-h-screen">
			<aside class="hidden w-72 flex-none flex-col bg-slate-950 text-slate-100 md:flex">
				<div class="flex h-20 items-center justify-center border-b border-slate-800 px-4 text-center">
					<a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold tracking-tight text-white">Ngey Tours Admin</a>
				</div>
				<nav class="flex flex-1 flex-col gap-1 px-4 py-6 text-sm">
					<a href="{{ route('admin.dashboard') }}" class="rounded-xl px-4 py-3 font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">Dashboard</a>
					<a href="{{ route('admin.tours') }}" class="rounded-xl px-4 py-3 font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.tours*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">Tours</a>
					<a href="{{ route('admin.packages') }}" class="rounded-xl px-4 py-3 font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.packages*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">Packages</a>
					<a href="#" class="rounded-xl px-4 py-3 font-medium text-slate-300 transition hover:bg-slate-800">Messages</a>
					<a href="{{ route('admin.contacts') }}" class="rounded-xl px-4 py-3 font-medium text-slate-300 transition hover:bg-slate-800">Contacts</a>
					<a href="#" class="rounded-xl px-4 py-3 font-medium text-slate-300 transition hover:bg-slate-800">Notifications</a>

					<div class="mt-auto">
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button type="submit" class="w-full rounded-xl px-4 py-3 text-left font-medium text-slate-300 transition hover:bg-slate-800">
								Logout
							</button>
						</form>
					</div>
				</nav>
				<div class="border-t border-slate-800 px-4 py-5 text-xs text-slate-400">

					<p class="font-semibold text-slate-200">Admin Tools</p>
					<p class="mt-2">Fast access to your content management.</p>
				</div>
			</aside>
			<div class="flex-1">
				<header class="border-b border-slate-200 bg-white px-4 py-4 shadow-sm md:px-6">
					<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
						<div>
							<h1 class="text-2xl font-semibold text-slate-900">@yield('title', 'Admin Dashboard')</h1>
							<p class="mt-1 text-sm text-slate-500">@yield('subtitle', 'Overview of tours, packages, and activity.')</p>
						</div>
						<div class="flex flex-wrap items-center gap-3">
							<button class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">Notifications <span class="rounded-full bg-rose-500 px-2 py-0.5 text-xs text-white">4</span></button>
							<button class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">Messages <span class="rounded-full bg-emerald-500 px-2 py-0.5 text-xs text-white">8</span></button>
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
