{{-- Sponsors Section --}}
<section id="sponsors" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">Our Partners</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                Sponsors & Partners
            </h2>
        </div>

        {{-- Main Sponsor --}}
        <div class="text-center mb-10">
            <p class="text-[10px] uppercase tracking-widest text-white/25 mb-4">Hosted By</p>
            <div class="inline-flex items-center gap-3 px-6 py-4 rounded border border-white/5 bg-white/[0.02]">
                <div class="w-10 h-10 rounded bg-white/5 flex items-center justify-center">
                    <i class="fa-solid fa-building-columns text-white/30"></i>
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-white/70">BINUS University</p>
                    <p class="text-xs text-white/30">Malang Campus</p>
                </div>
            </div>
        </div>

        {{-- Sponsor Tiers --}}
        <div class="space-y-8">
            {{-- Gold Sponsors --}}
            <div>
                <p class="text-[10px] uppercase tracking-widest text-amber-400/50 text-center mb-4">Gold Sponsors</p>
                <div class="flex flex-wrap justify-center gap-4">
                    @for($i = 0; $i < 3; $i++)
                    <div class="w-36 h-16 rounded border border-amber-500/10 bg-white/[0.02] flex items-center justify-center hover:border-amber-500/25 transition-colors">
                        <p class="text-xs text-white/20 font-medium">Sponsor {{ $i + 1 }}</p>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Silver Sponsors --}}
            <div>
                <p class="text-[10px] uppercase tracking-widest text-white/25 text-center mb-4">Silver Sponsors</p>
                <div class="flex flex-wrap justify-center gap-3">
                    @for($i = 0; $i < 4; $i++)
                    <div class="w-28 h-14 rounded border border-white/5 bg-white/[0.01] flex items-center justify-center hover:border-white/15 transition-colors">
                        <p class="text-[10px] text-white/15 font-medium">Sponsor {{ $i + 4 }}</p>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Media Partners --}}
            <div>
                <p class="text-[10px] uppercase tracking-widest text-neon-cyan/30 text-center mb-4">Media Partners</p>
                <div class="flex flex-wrap justify-center gap-3">
                    @for($i = 0; $i < 5; $i++)
                    <div class="w-24 h-12 rounded border border-white/5 bg-white/[0.01] flex items-center justify-center hover:border-neon-cyan/15 transition-colors">
                        <p class="text-[10px] text-white/15 font-medium">Media {{ $i + 1 }}</p>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
