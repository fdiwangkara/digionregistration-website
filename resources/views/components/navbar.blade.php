{{-- Navigation Bar Component --}}
<nav x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = window.scrollY > 20"
     :class="scrolled ? 'bg-cyber-darker/95 backdrop-blur border-b border-white/5' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('landing') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded bg-neon-cyan/10 border border-neon-cyan/30 flex items-center justify-center group-hover:border-neon-cyan/60 transition-colors">
                    <i class="fa-solid fa-bolt text-neon-cyan text-sm"></i>
                </div>
                <span class="font-display font-bold text-base tracking-wider text-white">
                    D<span class="text-neon-cyan">i</span>G<span class="text-neon-cyan">i</span>On
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('landing') }}#about" class="px-3 py-2 text-sm text-white/60 hover:text-neon-cyan transition-colors">About</a>
                <a href="{{ route('landing') }}#competitions" class="px-3 py-2 text-sm text-white/60 hover:text-neon-cyan transition-colors">Competitions</a>
                <a href="{{ route('landing') }}#timeline" class="px-3 py-2 text-sm text-white/60 hover:text-neon-cyan transition-colors">Timeline</a>
                <a href="{{ route('landing') }}#faq" class="px-3 py-2 text-sm text-white/60 hover:text-neon-cyan transition-colors">FAQ</a>
                <a href="{{ route('status') }}" class="px-3 py-2 text-sm text-white/60 hover:text-neon-cyan transition-colors">Track Status</a>
                <a href="{{ route('register') }}" class="ml-3 px-5 py-2 text-sm font-semibold rounded btn-primary">
                    Register
                </a>
            </div>

            {{-- Mobile Hamburger --}}
            <button @click="open = !open" class="md:hidden text-white/70 hover:text-white" aria-label="Toggle menu">
                <i x-show="!open" class="fa-solid fa-bars text-lg"></i>
                <i x-show="open" class="fa-solid fa-xmark text-lg" style="display:none;"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition duration-200 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition duration-150 ease-in"
         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-cyber-darker/98 backdrop-blur border-b border-white/5" style="display:none;">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('landing') }}#about" @click="open = false" class="block px-3 py-2.5 text-sm text-white/60 hover:text-neon-cyan transition-colors">About</a>
            <a href="{{ route('landing') }}#competitions" @click="open = false" class="block px-3 py-2.5 text-sm text-white/60 hover:text-neon-cyan transition-colors">Competitions</a>
            <a href="{{ route('landing') }}#timeline" @click="open = false" class="block px-3 py-2.5 text-sm text-white/60 hover:text-neon-cyan transition-colors">Timeline</a>
            <a href="{{ route('landing') }}#faq" @click="open = false" class="block px-3 py-2.5 text-sm text-white/60 hover:text-neon-cyan transition-colors">FAQ</a>
            <a href="{{ route('status') }}" @click="open = false" class="block px-3 py-2.5 text-sm text-white/60 hover:text-neon-cyan transition-colors">Track Status</a>
            <div class="pt-2">
                <a href="{{ route('register') }}" class="block text-center px-5 py-2.5 text-sm font-semibold rounded btn-primary">Register</a>
            </div>
        </div>
    </div>
</nav>
