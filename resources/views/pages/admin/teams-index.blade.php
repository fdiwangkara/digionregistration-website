@extends('layouts.admin')

@section('title', 'Teams — DIGIon Admin')
@section('page-title', 'Teams')

@section('content')
    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.teams.index') }}" class="bg-cyber-dark/60 border border-white/5 rounded p-4 mb-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
            <select name="competition" class="bg-white/[0.03] border border-white/10 rounded px-3 py-1.5 text-xs text-white/60 focus:border-neon-cyan/50 transition-colors">
                <option value="" class="bg-cyber-dark">All Competitions</option>
                @foreach(\App\Models\Competition::all() as $comp)
                    <option value="{{ $comp->id }}" class="bg-cyber-dark" {{ request('competition') == $comp->id ? 'selected' : '' }}>{{ $comp->name }}</option>
                @endforeach
            </select>

            <select name="status" class="bg-white/[0.03] border border-white/10 rounded px-3 py-1.5 text-xs text-white/60 focus:border-neon-cyan/50 transition-colors">
                <option value="" class="bg-cyber-dark">All Statuses</option>
                @foreach(\App\Enums\TeamStatus::cases() as $s)
                    <option value="{{ $s->value }}" class="bg-cyber-dark" {{ request('status') == $s->value ? 'selected' : '' }}>{{ $s->label() }}</option>
                @endforeach
            </select>

            <div class="relative flex-1 w-full sm:w-auto">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/15 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search teams, codes, schools..."
                       class="w-full bg-white/[0.03] border border-white/10 rounded pl-8 pr-3 py-1.5 text-xs text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors">
            </div>

            <button type="submit" class="px-4 py-1.5 text-xs rounded btn-primary shrink-0">Filter</button>
            @if(request()->hasAny(['search','status','competition']))
                <a href="{{ route('admin.teams.index') }}" class="text-xs text-white/30 hover:text-white/60 transition-colors">Clear</a>
            @endif
        </div>
    </form>

    {{-- Teams Table --}}
    <div class="bg-cyber-dark/60 border border-white/5 rounded overflow-hidden">
        <div class="table-responsive">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Code</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Team</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold hidden md:table-cell">School</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold hidden lg:table-cell">Competition</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold">Status</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold hidden sm:table-cell">Date</th>
                        <th class="px-4 py-3 text-[10px] uppercase tracking-wider text-white/30 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                    <tr class="border-b border-white/[0.03] hover:bg-white/[0.02] transition-colors">
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-neon-cyan/70">{{ $team->registration_code }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-white/70 font-medium">{{ $team->team_name }}</p>
                            <p class="text-[10px] text-white/25 md:hidden">{{ $team->school_name }}</p>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            <span class="text-xs text-white/45">{{ $team->school_name }}</span>
                        </td>
                        <td class="px-4 py-3 hidden lg:table-cell">
                            <span class="text-xs text-white/45">{{ $team->competition->name }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-medium rounded border {{ $team->status->badgeClasses() }}">
                                {{ $team->status->label() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            <span class="text-xs text-white/30">{{ $team->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.teams.show', $team->id) }}" class="w-7 h-7 rounded flex items-center justify-center text-white/30 hover:text-neon-cyan hover:bg-neon-cyan/5 transition-colors" title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                @if($team->status === \App\Enums\TeamStatus::PendingReview)
                                <form method="POST" action="{{ route('admin.teams.approve', $team->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="w-7 h-7 rounded flex items-center justify-center text-white/30 hover:text-emerald-400 hover:bg-emerald-500/5 transition-colors" title="Approve">
                                        <i class="fa-solid fa-check text-xs"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <i class="fa-solid fa-inbox text-2xl text-white/10 mb-3 block"></i>
                            <p class="text-sm text-white/30">No teams found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($teams->hasPages())
        <div class="px-4 py-3 border-t border-white/5 pagination-dark">
            {{ $teams->links() }}
        </div>
        @endif
    </div>
@endsection
