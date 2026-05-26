{{-- Prize Pool Section --}}
<section id="prizes" class="py-20 relative cyber-grid">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">Rewards</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                Prize Pool
            </h2>
        </div>

        @php
        $competitions = [
            [
                'name' => 'Data Analytics Competition',
                'prizes' => [
                    ['place' => '1st Place', 'icon' => 'fa-solid fa-trophy', 'amount' => 'Rp 3.000.000', 'color' => 'from-amber-400 to-amber-600', 'border' => 'border-amber-500/30'],
                    ['place' => '2nd Place', 'icon' => 'fa-solid fa-medal', 'amount' => 'Rp 2.000.000', 'color' => 'from-gray-300 to-gray-400', 'border' => 'border-gray-400/30'],
                    ['place' => '3rd Place', 'icon' => 'fa-solid fa-award', 'amount' => 'Rp 1.000.000', 'color' => 'from-amber-600 to-amber-800', 'border' => 'border-amber-700/30'],
                ],
            ],
            [
                'name' => 'Tech Rally Games',
                'prizes' => [
                    ['place' => '1st Place', 'icon' => 'fa-solid fa-trophy', 'amount' => 'Rp 3.000.000', 'color' => 'from-amber-400 to-amber-600', 'border' => 'border-amber-500/30'],
                    ['place' => '2nd Place', 'icon' => 'fa-solid fa-medal', 'amount' => 'Rp 2.000.000', 'color' => 'from-gray-300 to-gray-400', 'border' => 'border-gray-400/30'],
                    ['place' => '3rd Place', 'icon' => 'fa-solid fa-award', 'amount' => 'Rp 1.000.000', 'color' => 'from-amber-600 to-amber-800', 'border' => 'border-amber-700/30'],
                ],
            ],
        ];
        @endphp

        <div class="space-y-10">
            @foreach($competitions as $comp)
            <div>
                <h3 class="font-display text-sm font-semibold tracking-wider text-white/60 text-center mb-6">{{ $comp['name'] }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                    @foreach($comp['prizes'] as $prize)
                    <div class="bg-cyber-dark/60 rounded border {{ $prize['border'] }} p-5 text-center hover:bg-cyber-dark/80 transition-colors">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-gradient-to-br {{ $prize['color'] }} flex items-center justify-center">
                            <i class="{{ $prize['icon'] }} text-cyber-dark text-sm"></i>
                        </div>
                        <p class="text-xs text-white/40 mb-1">{{ $prize['place'] }}</p>
                        <p class="font-display text-lg font-bold text-white tracking-wide">{{ $prize['amount'] }}</p>
                        <p class="text-[10px] text-white/25 mt-2">+ Certificate + Trophy</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <p class="text-xs text-white/30">All winners receive e-certificates, trophies, and exclusive BINUS merchandise.</p>
        </div>
    </div>
</section>
