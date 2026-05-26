{{-- Status Badge Component --}}
{{-- Usage: @include('components.status-badge', ['status' => 'approved']) --}}
@props(['status' => 'pending_review'])

@php
$config = [
    'pending_payment' => ['label' => 'Pending Payment', 'icon' => 'fa-solid fa-clock', 'classes' => 'bg-amber-500/10 text-amber-400 border-amber-500/20'],
    'pending_review' => ['label' => 'Pending Review', 'icon' => 'fa-solid fa-hourglass-half', 'classes' => 'bg-cyber-blue/20 text-blue-300 border-blue-400/20'],
    'approved' => ['label' => 'Approved', 'icon' => 'fa-solid fa-check-circle', 'classes' => 'bg-neon-cyan/10 text-neon-cyan border-neon-cyan/20'],
    'rejected' => ['label' => 'Rejected', 'icon' => 'fa-solid fa-times-circle', 'classes' => 'bg-red-500/10 text-red-400 border-red-500/20'],
    'waiting_list' => ['label' => 'Waiting List', 'icon' => 'fa-solid fa-list-ol', 'classes' => 'bg-neon-magenta/10 text-neon-magenta border-neon-magenta/20'],
];
$cfg = $config[$status] ?? $config['pending_review'];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded border {{ $cfg['classes'] }}">
    <i class="{{ $cfg['icon'] }} text-[10px]"></i>
    {{ $cfg['label'] }}
</span>
