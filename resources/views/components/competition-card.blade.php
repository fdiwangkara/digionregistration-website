{{-- Competition Card Component --}}
{{-- Usage: @include('components.competition-card', ['competition' => $comp]) --}}
@props(['competition' => null])

@php
$comp = $competition ?? (object)[
    'slug' => 'data-analytics',
    'title' => 'Data Analytics Competition',
    'icon' => 'fa-solid fa-chart-bar',
    'description' => 'Analyze real-world datasets, discover insights, and present data-driven solutions.',
    'team_size' => '2–3 Members',
    'timeline' => 'May – August 2026',
    'color' => 'cyan',
    'hashtag' => '#SmartWithData',
];
$borderColor = $comp->color === 'pink' ? 'border-neon-pink/20 hover:border-neon-pink/50' : 'border-neon-cyan/20 hover:border-neon-cyan/50';
$iconBg = $comp->color === 'pink' ? 'bg-neon-pink/10 text-neon-pink' : 'bg-neon-cyan/10 text-neon-cyan';
$accentText = $comp->color === 'pink' ? 'text-neon-pink' : 'text-neon-cyan';
$btnClass = $comp->color === 'pink' ? 'btn-pink' : 'btn-primary';
@endphp

<div class="group bg-cyber-dark/60 rounded border {{ $borderColor }} transition-all duration-300 hover:shadow-neon-cyan p-6 flex flex-col">
    {{-- Header --}}
    <div class="flex items-start gap-4 mb-4">
        <div class="w-12 h-12 rounded {{ $iconBg }} flex items-center justify-center shrink-0">
            <i class="{{ $comp->icon }} text-lg"></i>
        </div>
        <div>
            <h3 class="font-display text-base font-semibold tracking-wide text-white mb-1">{{ $comp->title }}</h3>
            <span class="text-xs {{ $accentText }} font-medium">{{ $comp->hashtag }}</span>
        </div>
    </div>

    {{-- Description --}}
    <p class="text-sm text-white/50 leading-relaxed mb-5 flex-1">{{ $comp->description }}</p>

    {{-- Meta --}}
    <div class="space-y-2 mb-5">
        <div class="flex items-center gap-2 text-xs text-white/40">
            <i class="fa-solid fa-users w-4 text-center {{ $accentText }}/60"></i>
            <span>Team Size: <span class="text-white/60">{{ $comp->team_size }}</span></span>
        </div>
        <div class="flex items-center gap-2 text-xs text-white/40">
            <i class="fa-solid fa-calendar w-4 text-center {{ $accentText }}/60"></i>
            <span>Timeline: <span class="text-white/60">{{ $comp->timeline }}</span></span>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex gap-2">
        <a href="{{ route('register', ['category' => $comp->slug]) }}" class="flex-1 text-center px-4 py-2.5 text-sm rounded {{ $btnClass }}">
            Register
        </a>
        <a href="{{ route('competition.show', $comp->slug) }}" class="px-4 py-2.5 text-sm rounded btn-outline">
            Details
        </a>
    </div>
</div>
