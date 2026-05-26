@extends('layouts.app')

@section('title', $competition->name . ' — DIGIon 2026')

@section('content')
@php
$isCyan = $competition->slug === 'data-analytics';
$icon = $isCyan ? 'fa-solid fa-chart-bar' : 'fa-solid fa-flag-checkered';
$hashtag = $isCyan ? '#SmartWithData' : '#TechRallyGames';
$teamSize = $competition->min_members === $competition->max_members
    ? $competition->min_members . ' Members'
    : $competition->min_members . '–' . $competition->max_members . ' Members';
@endphp

<section class="pt-28 pb-20 relative cyber-grid">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-white/30 mb-8">
            <a href="{{ route('landing') }}" class="hover:text-neon-cyan transition-colors">Home</a>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <a href="{{ route('landing') }}#competitions" class="hover:text-neon-cyan transition-colors">Competitions</a>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <span class="text-white/50">{{ $competition->name }}</span>
        </nav>

        {{-- Header --}}
        <div class="flex items-start gap-4 mb-8">
            <div class="w-14 h-14 rounded {{ $isCyan ? 'bg-neon-cyan/10 text-neon-cyan' : 'bg-neon-pink/10 text-neon-pink' }} flex items-center justify-center shrink-0">
                <i class="{{ $icon }} text-xl"></i>
            </div>
            <div>
                <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white mb-1">{{ $competition->name }}</h1>
                <span class="text-xs {{ $isCyan ? 'text-neon-cyan' : 'text-neon-pink' }} font-medium">{{ $hashtag }}</span>
            </div>
        </div>

        {{-- Quick Info Bar --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-10">
            <div class="p-3 rounded border border-white/5 bg-white/[0.02] text-center">
                <i class="fa-solid fa-users text-xs {{ $isCyan ? 'text-neon-cyan/60' : 'text-neon-pink/60' }} mb-1.5 block"></i>
                <p class="text-xs text-white/40">Team Size</p>
                <p class="text-sm font-semibold text-white/80">{{ $teamSize }}</p>
            </div>
            <div class="p-3 rounded border border-white/5 bg-white/[0.02] text-center">
                <i class="fa-solid fa-calendar text-xs {{ $isCyan ? 'text-neon-cyan/60' : 'text-neon-pink/60' }} mb-1.5 block"></i>
                <p class="text-xs text-white/40">Registration</p>
                <p class="text-sm font-semibold text-white/80">May – Jun</p>
            </div>
            <div class="p-3 rounded border border-white/5 bg-white/[0.02] text-center">
                <i class="fa-solid fa-trophy text-xs {{ $isCyan ? 'text-neon-cyan/60' : 'text-neon-pink/60' }} mb-1.5 block"></i>
                <p class="text-xs text-white/40">Top Prize</p>
                <p class="text-sm font-semibold text-white/80">Rp 3 Jt</p>
            </div>
            <div class="p-3 rounded border border-white/5 bg-white/[0.02] text-center">
                <i class="fa-solid fa-ticket text-xs {{ $isCyan ? 'text-neon-cyan/60' : 'text-neon-pink/60' }} mb-1.5 block"></i>
                <p class="text-xs text-white/40">Max Teams</p>
                <p class="text-sm font-semibold text-white/80">{{ $competition->max_teams }} Teams</p>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                <div>
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 mb-4 flex items-center gap-2">
                        <span class="w-6 h-px {{ $isCyan ? 'bg-neon-cyan/40' : 'bg-neon-pink/40' }}"></span>
                        About This Competition
                    </h2>
                    <p class="text-sm text-white/50 leading-relaxed">{{ $competition->description }}</p>
                </div>

                {{-- Requirements --}}
                <div>
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 mb-4 flex items-center gap-2">
                        <span class="w-6 h-px {{ $isCyan ? 'bg-neon-cyan/40' : 'bg-neon-pink/40' }}"></span>
                        Requirements
                    </h2>
                    <ul class="space-y-2">
                        @foreach([
                            'Active high school student (SMA/SMK/MA) in Indonesia',
                            'All team members must be from the same school',
                            'Each participant can only join one team',
                            'Must complete the online registration form',
                            'Must upload valid Student Card (Kartu Pelajar)',
                            'Must upload Twibbon participation proof',
                            'Must complete QRIS payment of Rp ' . number_format($competition->registration_fee, 0, ',', '.') . ' per team',
                        ] as $req)
                        <li class="flex items-start gap-2 text-sm text-white/45">
                            <i class="fa-solid fa-check text-[10px] {{ $isCyan ? 'text-neon-cyan' : 'text-neon-pink' }} mt-1.5 shrink-0"></i>
                            <span>{{ $req }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Evaluation Criteria --}}
                <div>
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 mb-4 flex items-center gap-2">
                        <span class="w-6 h-px {{ $isCyan ? 'bg-neon-cyan/40' : 'bg-neon-pink/40' }}"></span>
                        Evaluation Criteria
                    </h2>
                    @php
                    $criteria = $isCyan
                        ? [
                            ['name' => 'Data Cleaning & Preparation', 'weight' => '20%'],
                            ['name' => 'Analysis & Methodology', 'weight' => '25%'],
                            ['name' => 'Visualization & Presentation', 'weight' => '25%'],
                            ['name' => 'Insight & Impact', 'weight' => '20%'],
                            ['name' => 'Innovation & Creativity', 'weight' => '10%'],
                        ]
                        : [
                            ['name' => 'Speed & Accuracy', 'weight' => '25%'],
                            ['name' => 'Technical Problem Solving', 'weight' => '25%'],
                            ['name' => 'Teamwork & Coordination', 'weight' => '20%'],
                            ['name' => 'Strategy & Logic', 'weight' => '20%'],
                            ['name' => 'Bonus Challenges', 'weight' => '10%'],
                        ];
                    @endphp
                    <div class="space-y-2">
                        @foreach($criteria as $c)
                        <div class="flex items-center justify-between p-3 rounded border border-white/5 bg-white/[0.02]">
                            <span class="text-sm text-white/50">{{ $c['name'] }}</span>
                            <span class="text-xs font-semibold {{ $isCyan ? 'text-neon-cyan' : 'text-neon-pink' }}">{{ $c['weight'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">
                <div class="p-5 rounded border {{ $isCyan ? 'border-neon-cyan/15' : 'border-neon-pink/15' }} bg-cyber-dark/60 sticky top-20">
                    <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 mb-4">Ready to Compete?</h3>
                    <div class="space-y-3 mb-5">
                        <div class="flex items-center gap-2 text-xs text-white/40">
                            <i class="fa-solid fa-money-bill w-4 text-center"></i>
                            <span>Fee: <span class="text-white/60">Rp {{ number_format($competition->registration_fee, 0, ',', '.') }} / team</span></span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-white/40">
                            <i class="fa-solid fa-clock w-4 text-center"></i>
                            <span>Deadline: <span class="text-white/60">30 June 2026</span></span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-white/40">
                            <i class="fa-solid fa-ticket w-4 text-center"></i>
                            <span>Slots: <span class="text-white/60">{{ $approvedCount }}/{{ $competition->max_teams }} filled</span></span>
                        </div>
                    </div>

                    {{-- Slot Progress --}}
                    <div class="mb-5">
                        <div class="flex justify-between text-[10px] text-white/30 mb-1">
                            <span>Available Slots</span>
                            <span>{{ $approvedCount }}/{{ $competition->max_teams }}</span>
                        </div>
                        <div class="h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full {{ $isCyan ? 'bg-neon-cyan' : 'bg-neon-pink' }} rounded-full transition-all"
                                 style="width: {{ $competition->max_teams > 0 ? ($approvedCount / $competition->max_teams * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    <a href="{{ route('register', ['category' => $competition->id]) }}" class="block text-center px-5 py-3 text-sm font-semibold rounded {{ $isCyan ? 'btn-primary' : 'btn-pink' }}">
                        @if($slotsRemaining > 0)
                            Register Now
                        @else
                            Join Waiting List
                        @endif
                    </a>
                </div>

                {{-- Timeline Sidebar --}}
                <div class="p-5 rounded border border-white/5 bg-cyber-dark/40">
                    <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 mb-4">Competition Timeline</h3>
                    <div class="space-y-3 relative">
                        <div class="absolute top-0 bottom-0 left-[7px] w-px bg-white/10"></div>
                        @foreach([
                            ['title' => 'Registration', 'date' => '1 May – 30 Jun', 'active' => true],
                            ['title' => 'Proposal Selection', 'date' => '1 – 15 Jul', 'active' => false],
                            ['title' => 'Development', 'date' => '16 Jul – 20 Aug', 'active' => false],
                            ['title' => 'Final & Presentation', 'date' => '29 Aug', 'active' => false],
                            ['title' => 'Announcement', 'date' => '29 Aug', 'active' => false],
                        ] as $phase)
                        <div class="flex items-start gap-3 relative">
                            <div class="w-4 h-4 rounded-full shrink-0 z-10 mt-0.5
                                @if($phase['active']) bg-neon-cyan border border-neon-cyan
                                @else bg-cyber-dark border border-white/15
                                @endif"></div>
                            <div>
                                <p class="text-xs font-medium @if($phase['active']) text-neon-cyan @else text-white/40 @endif">{{ $phase['title'] }}</p>
                                <p class="text-[10px] text-white/25">{{ $phase['date'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-5 rounded border border-white/5 bg-cyber-dark/40">
                    <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 mb-3">Questions?</h3>
                    <a href="https://wa.me/6281234567890" class="flex items-center gap-2 text-xs text-white/40 hover:text-green-400 transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                        Contact via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
