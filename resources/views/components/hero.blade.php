{{-- Hero Section Component --}}
<section class="relative min-h-screen flex items-center cyber-grid overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute top-20 right-10 w-64 h-64 bg-neon-cyan/[0.03] rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-48 h-48 bg-neon-pink/[0.04] rounded-full blur-3xl"></div>

    {{-- Corner accents --}}
    <div class="absolute top-0 left-0 w-24 h-px bg-gradient-to-r from-neon-cyan/40 to-transparent"></div>
    <div class="absolute top-0 left-0 w-px h-24 bg-gradient-to-b from-neon-cyan/40 to-transparent"></div>
    <div class="absolute bottom-0 right-0 w-24 h-px bg-gradient-to-l from-neon-pink/40 to-transparent"></div>
    <div class="absolute bottom-0 right-0 w-px h-24 bg-gradient-to-t from-neon-pink/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-32 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Text Content --}}
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-neon-cyan/20 bg-neon-cyan/5 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-neon-cyan animate-pulse"></span>
                    <span class="text-xs font-medium text-neon-cyan tracking-wide">REGISTRATION OPEN</span>
                </div>

                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black tracking-wider text-white mb-4 leading-tight">
                    D<span class="text-neon-cyan">i</span>G<span class="text-neon-cyan">i</span>On
                    <span class="text-neon-pink">2026</span>
                </h1>

                <p class="text-lg sm:text-xl text-white/70 font-light mb-2">
                    Digital Innovation Competition
                </p>
                <p class="text-sm text-white/40 mb-8">
                    BINUS University Malang &mdash; A national-level technology competition for high school students
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mb-8">
                    <a href="{{ route('register') }}" class="px-7 py-3 text-sm font-semibold rounded btn-primary inline-flex items-center justify-center gap-2">
                        Register Now
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="#competitions" class="px-7 py-3 text-sm font-semibold rounded btn-outline inline-flex items-center justify-center gap-2">
                        Explore Competitions
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="flex items-center gap-3">
                    <div class="flex -space-x-2">
                        @for($i = 0; $i < 4; $i++)
                        <div class="w-8 h-8 rounded-full border-2 border-cyber-darker bg-cyber-blue flex items-center justify-center text-[10px] text-white/60 font-semibold">
                            {{ ['RK','AS','MF','DW'][$i] }}
                        </div>
                        @endfor
                        <div class="w-8 h-8 rounded-full border-2 border-cyber-darker bg-neon-cyan/20 flex items-center justify-center text-[10px] text-neon-cyan font-semibold">
                            50+
                        </div>
                    </div>
                    <span class="text-xs text-white/35">teams have registered</span>
                </div>
            </div>

            {{-- Right Side Visual --}}
            <div class="hidden lg:flex items-center justify-center relative">
                {{-- Geometric decoration --}}
                <div class="relative w-80 h-80">
                    {{-- Rotating outer ring --}}
                    <div class="absolute inset-0 border border-neon-cyan/10 rounded-full" style="animation: spin 30s linear infinite;"></div>
                    <div class="absolute inset-4 border border-neon-pink/10 rounded-full" style="animation: spin 25s linear infinite reverse;"></div>

                    {{-- Center content --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto mb-4 rounded border border-neon-cyan/20 bg-cyber-dark/80 flex items-center justify-center" style="animation: float 6s ease-in-out infinite;">
                                <i class="fa-solid fa-bolt text-3xl text-neon-cyan"></i>
                            </div>
                            <p class="font-display text-xs tracking-[0.3em] text-white/30 uppercase">Ignite &bull; Innovate &bull; Impact</p>
                        </div>
                    </div>

                    {{-- Floating nodes --}}
                    <div class="absolute top-4 right-12 w-10 h-10 rounded bg-cyber-dark/80 border border-neon-cyan/20 flex items-center justify-center" style="animation: float 5s ease-in-out 0.5s infinite;">
                        <i class="fa-solid fa-code text-neon-cyan text-xs"></i>
                    </div>
                    <div class="absolute bottom-12 left-4 w-10 h-10 rounded bg-cyber-dark/80 border border-neon-pink/20 flex items-center justify-center" style="animation: float 5s ease-in-out 1s infinite;">
                        <i class="fa-solid fa-database text-neon-pink text-xs"></i>
                    </div>
                    <div class="absolute top-1/2 right-0 w-10 h-10 rounded bg-cyber-dark/80 border border-neon-magenta/20 flex items-center justify-center" style="animation: float 5s ease-in-out 1.5s infinite;">
                        <i class="fa-solid fa-trophy text-neon-magenta text-xs"></i>
                    </div>
                    <div class="absolute bottom-4 right-16 w-10 h-10 rounded bg-cyber-dark/80 border border-neon-cyan/20 flex items-center justify-center" style="animation: float 5s ease-in-out 2s infinite;">
                        <i class="fa-solid fa-brain text-neon-cyan text-xs"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
</section>
