{{-- Timeline Item Component --}}
{{-- Usage: @include('components.timeline-item', ['icon' => 'fa-solid fa-pen', 'title' => 'Registration', 'date' => '1 May - 30 June 2026', 'active' => true]) --}}
@props(['icon' => 'fa-solid fa-circle', 'title' => '', 'date' => '', 'active' => false, 'complete' => false])

<div class="flex flex-col items-center text-center flex-1 min-w-0">
    <div class="w-12 h-12 rounded-full flex items-center justify-center mb-3 transition-all
        @if($complete) bg-neon-cyan/10 border border-neon-cyan/40 text-neon-cyan
        @elseif($active) bg-neon-cyan/20 border-2 border-neon-cyan text-neon-cyan shadow-neon-cyan
        @else bg-white/[0.03] border border-white/10 text-white/25
        @endif">
        <i class="{{ $icon }} text-sm"></i>
    </div>
    <p class="text-xs font-semibold mb-1 @if($active) text-neon-cyan @elseif($complete) text-white/70 @else text-white/35 @endif">
        {{ $title }}
    </p>
    <p class="text-[10px] text-white/30 leading-tight">{{ $date }}</p>
</div>
