@extends('layouts.admin')

@section('title', 'Team Detail — DIGIon Admin')
@section('page-title', 'Team Detail')

@section('content')
<div x-data="{ showRejectModal: false, rejectReason: '' }">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-white/30 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-neon-cyan transition-colors">Dashboard</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('admin.teams.index') }}" class="hover:text-neon-cyan transition-colors">Teams</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-white/50">{{ $team->registration_code }}</span>
    </nav>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h2 class="text-lg font-semibold text-white">{{ $team->team_name }}</h2>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-semibold rounded border {{ $team->status->badgeClasses() }}">
                    <i class="{{ $team->status->icon() }}"></i>
                    {{ $team->status->label() }}
                </span>
            </div>
            <p class="text-xs text-white/30 font-mono">{{ $team->registration_code }}</p>
        </div>
        <div class="flex gap-2">
            @if($team->status === \App\Enums\TeamStatus::PendingReview)
            <form method="POST" action="{{ route('admin.teams.approve', $team->id) }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-xs font-semibold rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20 transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-check text-[10px]"></i> Approve
                </button>
            </form>
            <button @click="showRejectModal = true"
                    class="px-4 py-2 text-xs font-semibold rounded bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-xmark text-[10px]"></i> Reject
            </button>
            @endif
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-4">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-4">
            {{-- Team Info --}}
            <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-white/40 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-info-circle text-neon-cyan/60 text-[10px]"></i>
                    Team Information
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div><p class="text-[10px] text-white/25 mb-0.5">Team Name</p><p class="text-sm text-white/70">{{ $team->team_name }}</p></div>
                    <div><p class="text-[10px] text-white/25 mb-0.5">School</p><p class="text-sm text-white/70">{{ $team->school_name }}</p></div>
                    <div><p class="text-[10px] text-white/25 mb-0.5">Competition</p><p class="text-sm text-white/70">{{ $team->competition->name }}</p></div>
                    <div><p class="text-[10px] text-white/25 mb-0.5">Instagram</p><p class="text-sm text-white/70">{{ $team->instagram ?? '—' }}</p></div>
                    <div><p class="text-[10px] text-white/25 mb-0.5">Registered</p><p class="text-sm text-white/70">{{ $team->created_at->format('d M Y, H:i') }}</p></div>
                    <div><p class="text-[10px] text-white/25 mb-0.5">Members</p><p class="text-sm text-white/70">{{ $team->members->count() }} members</p></div>
                </div>
            </div>

            {{-- Members --}}
            <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-white/40 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-users text-neon-cyan/60 text-[10px]"></i>
                    Team Members
                </h3>
                <div class="space-y-3">
                    @foreach($team->members as $member)
                    <div class="p-4 rounded border border-white/5 bg-white/[0.01]">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-cyber-blue flex items-center justify-center text-xs text-white/60 font-semibold">
                                {{ $member->initials() }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white/70">{{ $member->full_name }}</p>
                                <span class="text-[10px] {{ $member->is_leader ? 'text-neon-cyan bg-neon-cyan/10 px-1.5 py-0.5 rounded' : 'text-white/25' }}">
                                    {{ $member->is_leader ? 'Leader' : 'Member' }}
                                </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                            <div><p class="text-white/20 mb-0.5">Place of Birth</p><p class="text-white/55">{{ $member->birth_place }}</p></div>
                            <div><p class="text-white/20 mb-0.5">Date of Birth</p><p class="text-white/55">{{ $member->birth_date->format('d M Y') }}</p></div>
                            <div><p class="text-white/20 mb-0.5">NISN</p><p class="text-white/55 font-mono">{{ $member->nisn }}</p></div>
                            <div><p class="text-white/20 mb-0.5">Phone</p><p class="text-white/55">{{ $member->phone }}</p></div>
                            <div class="col-span-2"><p class="text-white/20 mb-0.5">Email</p><p class="text-white/55">{{ $member->email }}</p></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Documents --}}
            <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-white/40 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-file-lines text-neon-cyan/60 text-[10px]"></i>
                    Uploaded Documents
                </h3>
                <div class="space-y-2">
                    @php
                    $documents = [
                        ['type' => 'student_card', 'label' => 'Student Card', 'path' => $team->student_card_path, 'icon' => 'fa-solid fa-id-card'],
                        ['type' => 'twibbon', 'label' => 'Twibbon Proof', 'path' => $team->twibbon_path, 'icon' => 'fa-solid fa-image'],
                        ['type' => 'payment_proof', 'label' => 'Payment Proof', 'path' => $team->payment_proof_path, 'icon' => 'fa-solid fa-receipt'],
                    ];
                    @endphp
                    @foreach($documents as $doc)
                    <div class="flex items-center gap-3 p-3 rounded border border-white/5 bg-white/[0.01]">
                        <div class="w-9 h-9 rounded bg-neon-cyan/10 flex items-center justify-center shrink-0">
                            <i class="{{ $doc['icon'] }} text-neon-cyan text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-white/60">{{ $doc['label'] }}</p>
                            <p class="text-[10px] text-white/25 truncate">{{ $doc['path'] ? basename($doc['path']) : 'Not uploaded' }}</p>
                        </div>
                        @if($doc['path'])
                        <a href="{{ route('admin.teams.download', [$team->id, $doc['type']]) }}"
                           class="w-7 h-7 rounded flex items-center justify-center text-white/25 hover:text-neon-cyan hover:bg-neon-cyan/5 transition-colors" title="Download">
                            <i class="fa-solid fa-download text-xs"></i>
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-4">
            @if($team->status === \App\Enums\TeamStatus::PendingReview)
            <div class="bg-cyber-dark/60 border border-amber-500/15 rounded p-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-white/40 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-gavel text-amber-400/60 text-[10px]"></i>
                    Action Required
                </h3>
                <p class="text-xs text-white/40 mb-4">Review this team's documents and decide whether to approve or reject their registration.</p>
                <div class="space-y-2">
                    <form method="POST" action="{{ route('admin.teams.approve', $team->id) }}">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2.5 text-xs font-semibold rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20 transition-colors flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-check text-[10px]"></i> Approve Team
                        </button>
                    </form>
                    <button @click="showRejectModal = true"
                            class="w-full px-4 py-2.5 text-xs font-semibold rounded bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-colors flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-xmark text-[10px]"></i> Reject Team
                    </button>
                </div>
            </div>
            @endif

            @if($team->rejection_reason)
            <div class="bg-red-500/5 border border-red-500/15 rounded p-5">
                <h3 class="text-xs font-semibold text-red-400 mb-2">Rejection Reason</h3>
                <p class="text-xs text-white/50">{{ $team->rejection_reason }}</p>
            </div>
            @endif

            {{-- Contact Info --}}
            <div class="bg-cyber-dark/60 border border-white/5 rounded p-5">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-white/40 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-neon-cyan/60 text-[10px]"></i>
                    Contact
                </h3>
                <div class="space-y-2 text-xs">
                    <div><p class="text-white/20 mb-0.5">Leader Email</p><p class="text-white/55">{{ $team->leader_email }}</p></div>
                    <div><p class="text-white/20 mb-0.5">Leader Phone</p><p class="text-white/55">{{ $team->leader_phone }}</p></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Reject Modal --}}
    <div x-show="showRejectModal" x-transition class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display:none;">
        <div class="absolute inset-0 bg-black/70" @click="showRejectModal = false"></div>
        <div class="relative bg-cyber-dark border border-red-500/20 rounded-lg w-full max-w-md p-6">
            <h3 class="text-sm font-semibold text-white mb-2 flex items-center gap-2">
                <i class="fa-solid fa-times-circle text-red-400 text-sm"></i>
                Reject Team
            </h3>
            <p class="text-xs text-white/40 mb-4">
                Rejecting <span class="text-white/70">{{ $team->team_name }}</span>. If this team was approved, the first waiting list team will be auto-promoted.
            </p>
            <form method="POST" action="{{ route('admin.teams.reject', $team->id) }}">
                @csrf
                <label class="block text-xs text-white/50 mb-1.5">Reason for rejection <span class="text-red-400">*</span></label>
                <textarea name="rejection_reason" x-model="rejectReason" rows="3" placeholder="Provide reason for rejection..." required
                          class="w-full bg-white/[0.03] border border-white/10 rounded px-3 py-2 text-xs text-white placeholder-white/15 focus:border-red-400/50 transition-colors resize-none mb-4"></textarea>
                <div class="flex gap-2 justify-end">
                    <button type="button" @click="showRejectModal = false" class="px-4 py-2 text-xs rounded border border-white/10 text-white/40 hover:text-white/60 transition-colors">Cancel</button>
                    <button type="submit" :disabled="!rejectReason.trim()" class="px-4 py-2 text-xs font-semibold rounded bg-red-500/20 text-red-400 border border-red-500/30 hover:bg-red-500/30 transition-colors disabled:opacity-30 disabled:cursor-not-allowed">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
