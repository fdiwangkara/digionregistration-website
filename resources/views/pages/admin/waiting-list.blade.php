@extends('layouts.admin')

@section('title', 'Waiting List — DIGIon Admin')
@section('page-title', 'Waiting List')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-white mb-1">Waiting List Queue</h2>
            <p class="text-xs text-white/35">Teams waiting for an approved slot to open up.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs text-white/30">Approved:</span>
            <span class="font-display text-sm font-bold {{ $totalApproved < 48 ? 'text-emerald-400' : 'text-red-400' }}">{{ $totalApproved }}/48</span>
        </div>
    </div>

    {{-- Competition Slots --}}
    <div class="grid sm:grid-cols-2 gap-3 mb-6">
        @foreach($competitions as $comp)
        <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-semibold text-white/50">{{ $comp->name }}</h3>
                <span class="text-xs font-semibold text-neon-cyan">{{ $comp->approved_teams_count }}/{{ $comp->max_teams }}</span>
            </div>

            {{-- Visual slot grid --}}
            <div class="grid grid-cols-12 gap-1 mb-2">
                @for($i = 1; $i <= $comp->max_teams; $i++)
                <div class="h-5 rounded-sm {{ $i <= $comp->approved_teams_count ? 'bg-neon-cyan/30 border border-neon-cyan/20' : 'bg-white/[0.03] border border-white/5' }}"></div>
                @endfor
            </div>
            <div class="flex items-center gap-4 text-[10px] text-white/25">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-neon-cyan/30 border border-neon-cyan/20 inline-block"></span> Filled</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-white/[0.03] border border-white/5 inline-block"></span> Available</span>
                <span class="ml-auto">{{ $comp->max_teams - $comp->approved_teams_count }} remaining</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.waiting-list') }}" class="flex items-center gap-3 mb-4">
        <select name="competition" onchange="this.form.submit()" class="bg-white/[0.03] border border-white/10 rounded px-3 py-1.5 text-xs text-white/60 focus:border-neon-cyan/50 transition-colors">
            <option value="" class="bg-cyber-dark">All Competitions</option>
            @foreach($competitions as $comp)
                <option value="{{ $comp->id }}" class="bg-cyber-dark" {{ request('competition') == $comp->id ? 'selected' : '' }}>{{ $comp->name }}</option>
            @endforeach
        </select>
    </form>

    {{-- Waiting List Queue --}}
    <div class="bg-cyber-dark/60 border border-white/5 rounded overflow-hidden mb-6">
        <div class="px-4 py-3 border-b border-white/5 flex items-center gap-2">
            <i class="fa-solid fa-list-ol text-purple-400/60 text-xs"></i>
            <h3 class="text-xs font-semibold text-white/50">Queue Order</h3>
            <span class="text-[10px] text-white/20 ml-auto">{{ $waitingTeams->count() }} teams in queue (FIFO)</span>
        </div>

        @forelse($waitingTeams as $team)
        <div class="px-4 py-4 border-b border-white/[0.03] hover:bg-white/[0.02] transition-colors flex items-center gap-4">
            {{-- Position --}}
            <div class="w-10 h-10 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                <span class="font-display text-sm font-bold text-purple-400">#{{ $team->queue_position }}</span>
            </div>

            {{-- Team Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-0.5">
                    <p class="text-sm font-medium text-white/70">{{ $team->team_name }}</p>
                    <span class="text-[10px] font-mono text-white/20">{{ $team->registration_code }}</span>
                </div>
                <div class="flex items-center gap-3 text-xs text-white/30">
                    <span class="flex items-center gap-1"><i class="fa-solid fa-school text-[10px]"></i> {{ $team->school_name }}</span>
                    <span class="hidden sm:flex items-center gap-1"><i class="fa-solid fa-trophy text-[10px]"></i> {{ $team->competition->name }}</span>
                    <span class="hidden sm:flex items-center gap-1"><i class="fa-solid fa-users text-[10px]"></i> {{ $team->members->count() }} members</span>
                </div>
            </div>

            {{-- Date --}}
            <div class="hidden md:block text-right shrink-0">
                <p class="text-[10px] text-white/20">Registered</p>
                <p class="text-xs text-white/40">{{ $team->created_at->format('d M Y') }}</p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-1 shrink-0">
                <a href="{{ route('admin.teams.show', $team->id) }}"
                   class="w-8 h-8 rounded flex items-center justify-center text-white/25 hover:text-neon-cyan hover:bg-neon-cyan/5 transition-colors" title="View">
                    <i class="fa-solid fa-eye text-xs"></i>
                </a>
                <form method="POST" action="{{ route('admin.waiting-list.promote', $team->id) }}">
                    @csrf
                    <button type="submit"
                            class="px-3 py-1.5 text-[10px] font-semibold rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20 transition-colors flex items-center gap-1"
                            title="Promote to pending review"
                            onclick="return confirm('Promote {{ $team->team_name }} from waiting list?')">
                        <i class="fa-solid fa-arrow-up text-[8px]"></i> Promote
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="py-12 text-center">
            <i class="fa-solid fa-check-double text-2xl text-white/10 mb-3 block"></i>
            <p class="text-sm text-white/30">No teams on the waiting list</p>
            <p class="text-xs text-white/15 mt-1">All registered teams have been processed</p>
        </div>
        @endforelse
    </div>

    {{-- Rules --}}
    <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
        <h3 class="text-xs font-semibold text-white/50 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-robot text-neon-cyan/60 text-[10px]"></i>
            Auto-Promotion Rules
        </h3>
        <ul class="space-y-2 text-xs text-white/35">
            <li class="flex items-start gap-2">
                <i class="fa-solid fa-chevron-right text-[8px] text-neon-cyan/40 mt-1.5 shrink-0"></i>
                When an approved team is <span class="text-red-400/70">rejected</span>, the first team in queue is auto-promoted to <span class="text-blue-300/70">pending review</span>
            </li>
            <li class="flex items-start gap-2">
                <i class="fa-solid fa-chevron-right text-[8px] text-neon-cyan/40 mt-1.5 shrink-0"></i>
                Promotion follows FIFO order (first registered, first promoted)
            </li>
            <li class="flex items-start gap-2">
                <i class="fa-solid fa-chevron-right text-[8px] text-neon-cyan/40 mt-1.5 shrink-0"></i>
                Admin can also manually promote teams using the "Promote" button above
            </li>
        </ul>
    </div>
@endsection
