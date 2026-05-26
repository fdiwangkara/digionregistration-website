@extends('layouts.app')

@section('title', 'Registration Successful — DIGIon 2026')

@section('content')
<section class="pt-28 pb-20 relative cyber-grid">
    <div class="max-w-xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        {{-- Success Icon --}}
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-neon-cyan/10 border-2 border-neon-cyan flex items-center justify-center" style="animation: glow 2s ease-in-out infinite alternate;">
            <i class="fa-solid fa-check text-3xl text-neon-cyan"></i>
        </div>

        <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white mb-3">
            Registration Submitted
        </h1>
        <p class="text-sm text-white/45 mb-8 max-w-md mx-auto">
            Your team registration has been received. We will review your submission and notify you via email.
        </p>

        {{-- Registration Code Card --}}
        <div class="bg-cyber-dark/60 border border-neon-cyan/15 rounded p-6 mb-6 inline-block w-full max-w-sm">
            <p class="text-[10px] uppercase tracking-widest text-white/30 mb-2">Your Registration Code</p>
            <p class="font-display text-2xl font-bold text-neon-cyan tracking-[0.15em] mb-3">{{ $team->registration_code }}</p>

            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-semibold rounded border {{ $team->status->badgeClasses() }}">
                    <i class="{{ $team->status->icon() }}"></i>
                    {{ $team->status->label() }}
                </span>
            </div>

            <p class="text-xs text-white/30">
                Save this code — you'll need it to track your registration status.
            </p>
        </div>

        {{-- Team Summary --}}
        <div class="bg-cyber-dark/40 border border-white/5 rounded p-5 mb-8 text-left max-w-sm mx-auto">
            <h3 class="text-xs font-semibold text-white/50 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-receipt text-neon-cyan/60 text-[10px]"></i>
                Summary
            </h3>
            <div class="space-y-2 text-xs">
                <div class="flex justify-between">
                    <span class="text-white/30">Team</span>
                    <span class="text-white/60">{{ $team->team_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/30">School</span>
                    <span class="text-white/60">{{ $team->school_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/30">Category</span>
                    <span class="text-white/60">{{ $team->competition->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/30">Members</span>
                    <span class="text-white/60">{{ $team->members->count() }} members</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/30">Submitted</span>
                    <span class="text-white/60">{{ $team->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- What's Next --}}
        <div class="bg-cyber-dark/40 border border-white/5 rounded p-5 mb-8 text-left max-w-sm mx-auto">
            <h3 class="text-xs font-semibold text-white/50 mb-3">What happens next?</h3>
            <ol class="space-y-2">
                <li class="flex items-start gap-2 text-xs text-white/40">
                    <span class="w-4 h-4 rounded-full bg-neon-cyan/10 text-neon-cyan text-[10px] flex items-center justify-center shrink-0 mt-0.5 font-semibold">1</span>
                    Our team will review your submission and documents
                </li>
                <li class="flex items-start gap-2 text-xs text-white/40">
                    <span class="w-4 h-4 rounded-full bg-white/5 text-white/30 text-[10px] flex items-center justify-center shrink-0 mt-0.5 font-semibold">2</span>
                    You'll receive an email with your approval status
                </li>
                <li class="flex items-start gap-2 text-xs text-white/40">
                    <span class="w-4 h-4 rounded-full bg-white/5 text-white/30 text-[10px] flex items-center justify-center shrink-0 mt-0.5 font-semibold">3</span>
                    Once approved, further instructions will be sent
                </li>
            </ol>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('status') }}" class="px-6 py-2.5 text-sm rounded btn-primary inline-flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                Track Status
            </a>
            <a href="{{ route('landing') }}" class="px-6 py-2.5 text-sm rounded btn-outline inline-flex items-center gap-2">
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
