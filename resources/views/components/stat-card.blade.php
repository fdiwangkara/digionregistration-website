{{-- Stat Card Component --}}
{{-- Usage: @include('components.stat-card', ['icon' => 'fa-solid fa-users', 'label' => 'Total Teams', 'value' => 42, 'accent' => 'cyan']) --}}
@props(['icon' => 'fa-solid fa-chart-bar', 'label' => 'Metric', 'value' => 0, 'accent' => 'cyan', 'subtitle' => ''])

@php
$accentConfig = [
    'cyan' => ['border' => 'border-neon-cyan/15', 'icon_bg' => 'bg-neon-cyan/10 text-neon-cyan', 'value' => 'text-neon-cyan'],
    'pink' => ['border' => 'border-neon-pink/15', 'icon_bg' => 'bg-neon-pink/10 text-neon-pink', 'value' => 'text-neon-pink'],
    'magenta' => ['border' => 'border-neon-magenta/15', 'icon_bg' => 'bg-neon-magenta/10 text-neon-magenta', 'value' => 'text-neon-magenta'],
    'blue' => ['border' => 'border-cyber-blue/30', 'icon_bg' => 'bg-cyber-blue/20 text-blue-300', 'value' => 'text-blue-300'],
    'amber' => ['border' => 'border-amber-500/15', 'icon_bg' => 'bg-amber-500/10 text-amber-400', 'value' => 'text-amber-400'],
];
$a = $accentConfig[$accent] ?? $accentConfig['cyan'];
@endphp

<div class="bg-cyber-dark/60 rounded border {{ $a['border'] }} p-5 hover:bg-cyber-dark/80 transition-colors">
    <div class="flex items-start justify-between mb-3">
        <div class="w-10 h-10 rounded {{ $a['icon_bg'] }} flex items-center justify-center">
            <i class="{{ $icon }} text-sm"></i>
        </div>
    </div>
    <p class="text-2xl font-bold {{ $a['value'] }} font-display tracking-wide mb-1">{{ $value }}</p>
    <p class="text-xs text-white/40 font-medium">{{ $label }}</p>
    @if($subtitle)
        <p class="text-[10px] text-white/25 mt-1">{{ $subtitle }}</p>
    @endif
</div>
