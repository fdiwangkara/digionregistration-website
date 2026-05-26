<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — DIGIon 2026')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyber-darker text-white font-sans antialiased min-h-screen" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    {{-- Flash Messages --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition class="fixed top-4 right-4 z-[100] px-4 py-3 rounded border border-emerald-500/20 bg-emerald-500/10 text-emerald-400 text-sm max-w-sm">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         x-transition class="fixed top-4 right-4 z-[100] px-4 py-3 rounded border border-red-500/20 bg-red-500/10 text-red-400 text-sm max-w-sm">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- Mobile Sidebar Overlay --}}
    <div x-show="mobileSidebar" x-transition:enter="transition duration-200" x-transition:leave="transition duration-150"
         class="fixed inset-0 bg-black/60 z-40 lg:hidden" @click="mobileSidebar = false" style="display:none;"></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'w-56' : 'w-16'"
           class="fixed top-0 left-0 h-screen bg-cyber-dark border-r border-white/5 z-50 transition-all duration-200 hidden lg:block">
        {{-- Logo --}}
        <div class="h-14 flex items-center px-4 border-b border-white/5">
            <span class="font-display font-bold text-neon-cyan text-sm tracking-wider" x-show="sidebarOpen">DIGI<span class="text-neon-pink">on</span></span>
            <span class="font-display font-bold text-neon-cyan text-sm" x-show="!sidebarOpen">D</span>
        </div>

        <nav class="p-2 space-y-1 mt-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40 hover:text-white/70 hover:bg-white/5' }}">
                <i class="fa-solid fa-chart-line text-sm w-5 text-center"></i>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>
            <a href="{{ route('admin.teams.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium transition-colors {{ request()->routeIs('admin.teams.*') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40 hover:text-white/70 hover:bg-white/5' }}">
                <i class="fa-solid fa-users text-sm w-5 text-center"></i>
                <span x-show="sidebarOpen">Teams</span>
            </a>
            <a href="{{ route('admin.waiting-list') }}"
               class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium transition-colors {{ request()->routeIs('admin.waiting-list*') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40 hover:text-white/70 hover:bg-white/5' }}">
                <i class="fa-solid fa-clock-rotate-left text-sm w-5 text-center"></i>
                <span x-show="sidebarOpen">Waiting List</span>
            </a>

            <div class="section-divider my-3"></div>

            <a href="{{ route('landing') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2 rounded text-xs text-white/25 hover:text-white/50 transition-colors">
                <i class="fa-solid fa-external-link text-sm w-5 text-center"></i>
                <span x-show="sidebarOpen">View Site</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded text-xs text-white/25 hover:text-red-400 transition-colors">
                    <i class="fa-solid fa-right-from-bracket text-sm w-5 text-center"></i>
                    <span x-show="sidebarOpen">Logout</span>
                </button>
            </form>
        </nav>

        {{-- Collapse Toggle --}}
        <button @click="sidebarOpen = !sidebarOpen"
                class="absolute bottom-4 left-0 w-full flex justify-center text-white/15 hover:text-white/40 transition-colors">
            <i :class="sidebarOpen ? 'fa-solid fa-chevron-left' : 'fa-solid fa-chevron-right'" class="text-xs"></i>
        </button>
    </aside>

    {{-- Mobile Sidebar --}}
    <aside x-show="mobileSidebar" x-transition:enter="transition transform duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
           x-transition:leave="transition transform duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
           class="fixed top-0 left-0 h-screen w-56 bg-cyber-dark border-r border-white/5 z-50 lg:hidden" style="display:none;">
        <div class="h-14 flex items-center justify-between px-4 border-b border-white/5">
            <span class="font-display font-bold text-neon-cyan text-sm tracking-wider">DIGI<span class="text-neon-pink">on</span></span>
            <button @click="mobileSidebar = false" class="text-white/30 hover:text-white/60"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav class="p-2 space-y-1 mt-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40' }}">
                <i class="fa-solid fa-chart-line text-sm w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ route('admin.teams.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium {{ request()->routeIs('admin.teams.*') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40' }}">
                <i class="fa-solid fa-users text-sm w-5 text-center"></i> Teams
            </a>
            <a href="{{ route('admin.waiting-list') }}" class="flex items-center gap-3 px-3 py-2 rounded text-xs font-medium {{ request()->routeIs('admin.waiting-list*') ? 'bg-neon-cyan/10 text-neon-cyan' : 'text-white/40' }}">
                <i class="fa-solid fa-clock-rotate-left text-sm w-5 text-center"></i> Waiting List
            </a>
            <div class="section-divider my-3"></div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded text-xs text-white/25 hover:text-red-400">
                    <i class="fa-solid fa-right-from-bracket text-sm w-5 text-center"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div :class="sidebarOpen ? 'lg:ml-56' : 'lg:ml-16'" class="transition-all duration-200 min-h-screen">
        {{-- Top Bar --}}
        <header class="h-14 flex items-center justify-between px-4 sm:px-6 border-b border-white/5 bg-cyber-darker/80 backdrop-blur sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button @click="mobileSidebar = true" class="lg:hidden text-white/40 hover:text-white/70">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="font-display text-sm font-semibold tracking-wider text-white/70">@yield('page-title', 'Admin')</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-white/25 hidden sm:block">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                <div class="w-7 h-7 rounded-full bg-neon-cyan/10 border border-neon-cyan/20 flex items-center justify-center text-[10px] text-neon-cyan font-semibold">A</div>
            </div>
        </header>

        {{-- Page Content --}}
        <div class="p-4 sm:p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
