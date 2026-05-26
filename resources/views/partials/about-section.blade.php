{{-- About DIGIon Section --}}
<section id="about" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">About The Event</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                What is DIGIon?
            </h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Text --}}
            <div>
                <p class="text-sm text-white/50 leading-relaxed mb-4">
                    DIGIon (Digital Innovation) is a national-level technology competition organized by the Computer Science department of BINUS University Malang. Designed for high school students (SMA/SMK/MA), DIGIon challenges participants to explore digital innovation, data analytics, AI, and creative problem solving.
                </p>
                <p class="text-sm text-white/50 leading-relaxed mb-6">
                    Now in its 2026 edition, DIGIon brings together the brightest young minds from across Indonesia to compete, collaborate, and create solutions that make a real-world impact.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-3 rounded border border-white/5 bg-white/[0.02]">
                        <p class="font-display text-xl font-bold text-neon-cyan">200+</p>
                        <p class="text-[10px] text-white/35 mt-1">Participants</p>
                    </div>
                    <div class="text-center p-3 rounded border border-white/5 bg-white/[0.02]">
                        <p class="font-display text-xl font-bold text-neon-pink">50+</p>
                        <p class="text-[10px] text-white/35 mt-1">Schools</p>
                    </div>
                    <div class="text-center p-3 rounded border border-white/5 bg-white/[0.02]">
                        <p class="font-display text-xl font-bold text-neon-magenta">2</p>
                        <p class="text-[10px] text-white/35 mt-1">Categories</p>
                    </div>
                </div>
            </div>

            {{-- Why Join Cards --}}
            <div class="grid grid-cols-2 gap-3">
                @php
                $benefits = [
                    ['icon' => 'fa-solid fa-graduation-cap', 'title' => 'Skill Development', 'desc' => 'Sharpen your tech skills, creativity, and problem solving.'],
                    ['icon' => 'fa-solid fa-award', 'title' => 'Recognition', 'desc' => 'Earn certificates and awards at a national level.'],
                    ['icon' => 'fa-solid fa-network-wired', 'title' => 'Networking', 'desc' => 'Connect with talented peers, mentors, and industry experts.'],
                    ['icon' => 'fa-solid fa-gift', 'title' => 'Prizes', 'desc' => 'Win millions in prizes and exclusive opportunities.'],
                    ['icon' => 'fa-solid fa-briefcase', 'title' => 'Portfolio', 'desc' => 'Build a competition project for your future portfolio.'],
                    ['icon' => 'fa-solid fa-star', 'title' => 'Experience', 'desc' => 'Gain a memorable and impactful competition experience.'],
                ];
                @endphp

                @foreach($benefits as $benefit)
                <div class="p-4 rounded border border-white/5 bg-white/[0.02] hover:border-neon-cyan/15 hover:bg-neon-cyan/[0.02] transition-all group">
                    <div class="w-8 h-8 rounded bg-neon-cyan/10 flex items-center justify-center mb-3 group-hover:bg-neon-cyan/15 transition-colors">
                        <i class="{{ $benefit['icon'] }} text-neon-cyan text-xs"></i>
                    </div>
                    <h4 class="text-xs font-semibold text-white/80 mb-1">{{ $benefit['title'] }}</h4>
                    <p class="text-[11px] text-white/35 leading-relaxed">{{ $benefit['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
