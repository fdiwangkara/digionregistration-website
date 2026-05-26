@extends('layouts.admin')

@section('title', 'Dashboard — DIGIon Admin')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        <div class="bg-cyber-dark/60 rounded border border-neon-cyan/15 p-5">
            <div class="w-10 h-10 rounded bg-neon-cyan/10 text-neon-cyan flex items-center justify-center mb-3">
                <i class="fa-solid fa-users text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-neon-cyan font-display tracking-wide mb-1">{{ $stats['total'] }}</p>
            <p class="text-xs text-white/40 font-medium">Total Teams</p>
        </div>

        <div class="bg-cyber-dark/60 rounded border border-emerald-500/15 p-5">
            <div class="w-10 h-10 rounded bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
                <i class="fa-solid fa-check-circle text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-emerald-400 font-display tracking-wide mb-1">{{ $stats['approved'] }}</p>
            <p class="text-xs text-white/40 font-medium">Approved Teams</p>
        </div>

        <div class="bg-cyber-dark/60 rounded border border-purple-500/15 p-5">
            <div class="w-10 h-10 rounded bg-purple-500/10 text-purple-400 flex items-center justify-center mb-3">
                <i class="fa-solid fa-clock-rotate-left text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-purple-400 font-display tracking-wide mb-1">{{ $stats['waiting'] }}</p>
            <p class="text-xs text-white/40 font-medium">Waiting List</p>
        </div>

        <div class="bg-cyber-dark/60 rounded border border-amber-500/15 p-5">
            <div class="w-10 h-10 rounded bg-amber-500/10 text-amber-400 flex items-center justify-center mb-3">
                <i class="fa-solid fa-hourglass-half text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-amber-400 font-display tracking-wide mb-1">{{ $stats['pending'] }}</p>
            <p class="text-xs text-white/40 font-medium">Pending Reviews</p>
        </div>
    </div>

    {{-- Competition Slots --}}
    @foreach($competitions as $comp)
    <div class="bg-cyber-dark/60 border border-white/5 rounded p-4 mb-4">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-medium text-white/50">{{ $comp->name }} — Approved Slots</p>
            <p class="text-xs font-semibold text-neon-cyan">{{ $comp->approved_teams_count }}/{{ $comp->max_teams }}</p>
        </div>
        <div class="h-2 bg-white/5 rounded-full overflow-hidden">
            <div class="h-full bg-linear-to-r from-neon-cyan to-emerald-400 rounded-full transition-all duration-500"
                 style="width: {{ $comp->max_teams > 0 ? ($comp->approved_teams_count / $comp->max_teams * 100) : 0 }}%"></div>
        </div>
    </div>
    @endforeach

    {{-- Recent Registrations --}}
    <div class="bg-cyber-dark/60 border border-white/5 rounded overflow-hidden">
        <div class="px-4 py-3 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-xs font-semibold text-white/50">Recent Registrations</h3>
            <a href="{{ route('admin.teams.index') }}" class="text-[10px] text-neon-cyan/60 hover:text-neon-cyan transition-colors">View All →</a>
        </div>
        <div class="table-responsive">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Code</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Team</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold hidden md:table-cell">Competition</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Status</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTeams as $team)
                    <tr class="border-b border-white/[0.03] hover:bg-white/[0.02] transition-colors">
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-neon-cyan/70">{{ $team->registration_code }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-white/70 font-medium">{{ $team->team_name }}</p>
                            <p class="text-[10px] text-white/25">{{ $team->school_name }}</p>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            <span class="text-xs text-white/45">{{ $team->competition->name }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded border {{ $team->status->badgeClasses() }}">
                                {{ $team->status->label() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.teams.show', $team->id) }}" class="w-7 h-7 rounded inline-flex items-center justify-center text-white/30 hover:text-neon-cyan hover:bg-neon-cyan/5 transition-colors">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
