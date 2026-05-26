@extends('layouts.app')

@section('title', 'Track Registration — DIGIon 2026')

@section('content')
<section class="pt-28 pb-20 relative">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        {{-- Header --}}
        <div class="text-center mb-10">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-2">Status Tracking</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white">
                Track Your Registration
            </h1>
            <p class="text-sm text-white/40 mt-2">Enter your registration code to check your team's status</p>
        </div>

        {{-- Search Bar --}}
        <form method="POST" action="{{ route('status.search') }}" class="flex gap-2 mb-10">
            @csrf
            <div class="flex-1 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-white/20 text-sm"></i>
                <input type="text" name="code" value="{{ $code ?? '' }}"
                       class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-3 pl-10 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors font-mono tracking-wide"
                       placeholder="DGN-2026-XXXX" required>
            </div>
            <button type="submit" class="px-6 py-3 text-sm rounded btn-primary shrink-0">Search</button>
        </form>

        @if($errors->any())
        <div class="mb-6 p-3 rounded border border-red-500/20 bg-red-500/5 text-xs text-red-400">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        {{-- Results --}}
        @isset($searched)
            @if($team)
            {{-- Found Result --}}
            <div class="space-y-6">
                {{-- Status Header --}}
                <div class="bg-cyber-dark/60 border border-neon-cyan/15 rounded p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-white/25 mb-1">Registration Code</p>
                            <p class="font-display text-lg font-bold text-white tracking-wider">{{ $team->registration_code }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-semibold rounded border {{ $team->status->badgeClasses() }}">
                            <i class="{{ $team->status->icon() }}"></i>
                            {{ $team->status->label() }}
                        </span>
                    </div>
                </div>

                {{-- Team Info --}}
                <div class="bg-cyber-dark/60 border border-white/5 rounded p-6">
                    <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 mb-4">Team Information</h3>
                    <div class="grid sm:grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-[10px] text-white/25 mb-0.5">Team Name</p>
                            <p class="text-white/70">{{ $team->team_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-white/25 mb-0.5">School</p>
                            <p class="text-white/70">{{ $team->school_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-white/25 mb-0.5">Competition</p>
                            <p class="text-white/70">{{ $team->competition->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-white/25 mb-0.5">Members</p>
                            <p class="text-white/70">{{ $team->members->count() }} members</p>
                        </div>
                    </div>

                    <div class="section-divider my-4"></div>

                    {{-- Members --}}
                    <div class="space-y-2">
                        @foreach($team->members as $member)
                        <div class="flex items-center gap-3 p-2 rounded bg-white/[0.02]">
                            <div class="w-7 h-7 rounded-full bg-cyber-blue flex items-center justify-center text-[10px] text-white/60 font-semibold">
                                {{ $member->initials() }}
                            </div>
                            <div>
                                <p class="text-xs text-white/60">{{ $member->full_name }}</p>
                                <p class="text-[10px] text-white/25">{{ $member->is_leader ? 'Leader' : 'Member' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($team->status === \App\Enums\TeamStatus::Rejected && $team->rejection_reason)
                <div class="bg-red-500/5 border border-red-500/15 rounded p-5">
                    <h3 class="text-xs font-semibold text-red-400 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
                        Rejection Reason
                    </h3>
                    <p class="text-xs text-white/50">{{ $team->rejection_reason }}</p>
                </div>
                @endif

                @if($team->status === \App\Enums\TeamStatus::WaitingList)
                <div class="bg-purple-500/5 border border-purple-500/15 rounded p-5">
                    <h3 class="text-xs font-semibold text-purple-400 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-[10px]"></i>
                        Waiting List Position
                    </h3>
                    <p class="text-xs text-white/50">Your team is at position <span class="text-purple-400 font-semibold">#{{ $team->queue_position }}</span> in the waiting list. You will be promoted automatically when a slot opens.</p>
                </div>
                @endif

                {{-- Support --}}
                <div class="text-center">
                    <p class="text-xs text-white/30 mb-2">Having issues with your registration?</p>
                    <a href="https://wa.me/6281234567890" class="text-xs text-neon-cyan/60 hover:text-neon-cyan transition-colors inline-flex items-center gap-1.5">
                        <i class="fa-brands fa-whatsapp"></i>
                        Contact Support
                    </a>
                </div>
            </div>
            @else
            {{-- Not Found --}}
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass text-xl text-white/15"></i>
                </div>
                <p class="text-sm text-white/50 mb-1">No registration found</p>
                <p class="text-xs text-white/30">No team found with code "<span class="font-mono">{{ $code }}</span>". Check your code and try again.</p>
            </div>
            @endif
        @endisset
    </div>
</section>
@endsection
