@extends('layouts.app')

@section('title', 'Register — DIGIon 2026')

@section('content')
<section class="pt-28 pb-20 relative" x-data="registrationForm()">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        {{-- Page Header --}}
        <div class="text-center mb-8">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-2">Registration Form</p>
            <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white">
                Register Your Team
            </h1>
            <p class="text-sm text-white/40 mt-2">Complete all steps to submit your registration</p>
        </div>

        {{-- Server-side Validation Errors --}}
        @if($errors->any())
        <div class="mb-6 p-4 rounded border border-red-500/20 bg-red-500/5">
            <h3 class="text-xs font-semibold text-red-400 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> Please fix the following errors:
            </h3>
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-xs text-red-300/70">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Step Indicator --}}
        <div class="mb-10">
            <div class="w-full">
                <div class="hidden sm:flex items-center justify-between relative">
                    <div class="absolute top-5 left-0 right-0 h-px bg-white/10"></div>
                    <div class="absolute top-5 left-0 h-px bg-neon-cyan transition-all duration-500"
                         :style="'width:' + ((step - 1) / 4 * 100) + '%'"></div>

                    <template x-for="(label, idx) in ['Team Info', 'Members', 'Documents', 'Payment', 'Review']" :key="idx">
                        <div class="relative flex flex-col items-center" style="width: 20%">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold z-10 transition-all duration-300"
                                 :class="(idx + 1) < step ? 'bg-neon-cyan text-cyber-dark' : (idx + 1) === step ? 'bg-cyber-dark border-2 border-neon-cyan text-neon-cyan shadow-neon-cyan' : 'bg-cyber-dark border border-white/15 text-white/30'">
                                <template x-if="(idx + 1) < step"><i class="fa-solid fa-check text-xs"></i></template>
                                <template x-if="(idx + 1) >= step"><span x-text="idx + 1"></span></template>
                            </div>
                            <span class="mt-2 text-xs font-medium text-center"
                                  :class="(idx + 1) === step ? 'text-neon-cyan' : (idx + 1) < step ? 'text-white/60' : 'text-white/25'"
                                  x-text="label"></span>
                        </div>
                    </template>
                </div>

                <div class="sm:hidden">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-white/40">Step <span x-text="step"></span> of 5</span>
                        <span class="text-xs font-medium text-neon-cyan" x-text="['Team Info', 'Members', 'Documents', 'Payment', 'Review'][step - 1]"></span>
                    </div>
                    <div class="h-1 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-neon-cyan rounded-full transition-all duration-500" :style="'width:' + (step / 5 * 100) + '%'"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Real Form - submits to Laravel --}}
        <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" id="registrationForm" x-ref="mainForm">
            @csrf

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STEP 1: Team Information --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div x-show="step === 1" x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-cyber-dark/60 border border-white/5 rounded p-6 sm:p-8 space-y-5">
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-users text-neon-cyan text-xs"></i>
                        Team Information
                    </h2>

                    <div>
                        <label for="team_name" class="block text-sm font-medium text-white/70 mb-1.5">
                            Team Name <span class="text-neon-pink">*</span>
                        </label>
                        <input type="text" id="team_name" name="team_name" x-model="form.team_name" required
                               value="{{ old('team_name') }}"
                               class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                               placeholder="e.g., Team Innovators">
                    </div>

                    <div>
                        <label for="school_name" class="block text-sm font-medium text-white/70 mb-1.5">
                            School Origin <span class="text-neon-pink">*</span>
                        </label>
                        <input type="text" id="school_name" name="school_name" x-model="form.school_name" required
                               value="{{ old('school_name') }}"
                               class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                               placeholder="e.g., SMAN 1 Malang">
                    </div>

                    <div>
                        <label for="competition_id" class="block text-sm font-medium text-white/70 mb-1.5">
                            Competition Category <span class="text-neon-pink">*</span>
                        </label>
                        <select id="competition_id" name="competition_id" x-model="form.competition_id" @change="onCategoryChange()" required
                                class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white focus:border-neon-cyan/50 transition-colors">
                            <option value="" class="bg-cyber-dark">Select category...</option>
                            @foreach($competitions as $comp)
                                <option value="{{ $comp->id }}" class="bg-cyber-dark"
                                        data-min="{{ $comp->min_members }}" data-max="{{ $comp->max_members }}"
                                        {{ old('competition_id', $selectedCategory) == $comp->id ? 'selected' : '' }}>
                                    {{ $comp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="instagram" class="block text-sm font-medium text-white/70 mb-1.5">
                            Instagram Account
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-white/25">@</span>
                            <input type="text" id="instagram" name="instagram" x-model="form.instagram"
                                   value="{{ old('instagram') }}"
                                   class="w-full bg-white/[0.03] border border-white/10 rounded pl-8 pr-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                   placeholder="your_instagram">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STEP 2: Member Information --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div x-show="step === 2" x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="space-y-4">
                    <div class="flex items-center justify-between bg-cyber-dark/60 border border-white/5 rounded px-4 py-3">
                        <div class="flex items-center gap-2 text-xs text-white/50">
                            <i class="fa-solid fa-info-circle text-neon-cyan/60"></i>
                            <span x-text="memberInfoText"></span>
                        </div>
                        <span class="text-xs font-medium" :class="membersValid ? 'text-neon-cyan' : 'text-white/30'"
                              x-text="form.members.length + '/' + maxMembers + ' members'"></span>
                    </div>

                    <template x-for="(member, mIdx) in form.members" :key="mIdx">
                        <div class="bg-cyber-dark/60 border border-white/5 rounded p-6 sm:p-8">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="font-display text-sm font-semibold tracking-wider text-white/80 flex items-center gap-2">
                                    <i class="fa-solid fa-user text-neon-cyan text-xs"></i>
                                    Member <span x-text="mIdx + 1"></span>
                                    <span x-show="mIdx === 0" class="text-[10px] bg-neon-cyan/10 text-neon-cyan px-1.5 py-0.5 rounded">Leader</span>
                                </h3>
                                <button type="button" x-show="mIdx >= minMembers"
                                        @click="removeMember(mIdx)"
                                        class="text-xs text-red-400/60 hover:text-red-400 transition-colors flex items-center gap-1">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i> Remove
                                </button>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">Full Name <span class="text-neon-pink">*</span></label>
                                    <input type="text" :name="'members[' + mIdx + '][full_name]'" x-model="member.full_name" required
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                           placeholder="Full legal name">
                                    <input type="hidden" :name="'members[' + mIdx + '][is_leader]'" :value="mIdx === 0 ? 1 : 0">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">Place of Birth <span class="text-neon-pink">*</span></label>
                                    <input type="text" :name="'members[' + mIdx + '][birth_place]'" x-model="member.birth_place" required
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                           placeholder="e.g., Malang">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">Date of Birth <span class="text-neon-pink">*</span></label>
                                    <input type="date" :name="'members[' + mIdx + '][birth_date]'" x-model="member.birth_date" required
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white focus:border-neon-cyan/50 transition-colors">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">NISN <span class="text-neon-pink">*</span></label>
                                    <input type="text" :name="'members[' + mIdx + '][nisn]'" x-model="member.nisn" required maxlength="10"
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                           placeholder="10-digit NISN">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">Phone / WhatsApp <span class="text-neon-pink">*</span></label>
                                    <input type="tel" :name="'members[' + mIdx + '][phone]'" x-model="member.phone" required
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                           placeholder="08xxxxxxxxxx">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-white/70 mb-1.5">Email <span class="text-neon-pink">*</span></label>
                                    <input type="email" :name="'members[' + mIdx + '][email]'" x-model="member.email" required
                                           class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white placeholder-white/20 focus:border-neon-cyan/50 transition-colors"
                                           placeholder="email@example.com">
                                </div>
                            </div>
                        </div>
                    </template>

                    <button type="button" x-show="form.members.length < maxMembers"
                            @click="addMember()"
                            class="w-full p-4 border border-dashed border-white/10 rounded text-sm text-white/30 hover:text-neon-cyan hover:border-neon-cyan/30 transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-plus text-xs"></i> Add Member
                    </button>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STEP 3: Document Upload --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div x-show="step === 3" x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-cyber-dark/60 border border-white/5 rounded p-6 sm:p-8 space-y-6">
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-file-arrow-up text-neon-cyan text-xs"></i>
                        Document Upload
                    </h2>

                    <p class="text-xs text-white/35 border-l-2 border-neon-cyan/20 pl-3">
                        Upload all required documents. PDF max 5MB, images max 5MB.
                    </p>

                    {{-- Student Card --}}
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1.5">
                            Student Card (PDF) <span class="text-neon-pink">*</span>
                        </label>
                        <input type="file" name="student_card" accept=".pdf" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white/50 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-neon-cyan/10 file:text-neon-cyan hover:file:bg-neon-cyan/20 transition-colors">
                        @error('student_card')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Twibbon --}}
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1.5">
                            Twibbon Proof (PDF) <span class="text-neon-pink">*</span>
                        </label>
                        <input type="file" name="twibbon" accept=".pdf" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white/50 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-neon-cyan/10 file:text-neon-cyan hover:file:bg-neon-cyan/20 transition-colors">
                        @error('twibbon')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Payment Proof --}}
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-1.5">
                            Payment Proof (JPG/PNG) <span class="text-neon-pink">*</span>
                        </label>
                        <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded px-4 py-2.5 text-sm text-white/50 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-neon-cyan/10 file:text-neon-cyan hover:file:bg-neon-cyan/20 transition-colors">
                        @error('payment_proof')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STEP 4: QRIS Payment --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div x-show="step === 4" x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-cyber-dark/60 border border-white/5 rounded p-6 sm:p-8">
                    <h2 class="font-display text-sm font-semibold tracking-wider text-white/80 flex items-center gap-2 mb-6">
                        <i class="fa-solid fa-qrcode text-neon-cyan text-xs"></i>
                        QRIS Payment
                    </h2>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="w-56 h-56 mx-auto bg-white rounded-lg p-4 mb-4 flex items-center justify-center">
                                <div class="w-full h-full border-2 border-dashed border-gray-300 rounded flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-qrcode text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-xs text-gray-500 font-medium">QRIS Code</p>
                                    <p class="text-[10px] text-gray-400">Scan to pay</p>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-white/80">Rp 150.000</p>
                            <p class="text-xs text-white/35 mt-1">Per team (all members)</p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-sm font-semibold text-white/70">Payment Instructions</h3>
                            <ol class="space-y-3">
                                @foreach(['Open your mobile banking or e-wallet app', 'Scan the QRIS code', 'Verify recipient: DIGIon BINUS Malang', 'Enter amount: Rp 150.000', 'Complete payment', 'Screenshot the confirmation', 'Upload in Step 3 (Documents)'] as $idx => $instruction)
                                <li class="flex items-start gap-3 text-sm text-white/45">
                                    <span class="w-5 h-5 rounded-full bg-neon-cyan/10 text-neon-cyan text-[10px] flex items-center justify-center shrink-0 font-semibold mt-0.5">{{ $idx + 1 }}</span>
                                    {{ $instruction }}
                                </li>
                                @endforeach
                            </ol>

                            <div class="p-3 rounded border border-amber-500/20 bg-amber-500/5">
                                <p class="text-xs text-amber-400/80 flex items-start gap-2">
                                    <i class="fa-solid fa-triangle-exclamation mt-0.5 shrink-0"></i>
                                    <span>Ensure the payment amount is exactly Rp 150.000.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- STEP 5: Review & Submit --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div x-show="step === 5" x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="space-y-4">
                    {{-- Team Review --}}
                    <div class="bg-cyber-dark/60 border border-white/5 rounded p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 flex items-center gap-2">
                                <i class="fa-solid fa-users text-neon-cyan text-[10px]"></i> Team Information
                            </h3>
                            <button type="button" @click="step = 1" class="text-xs text-neon-cyan/60 hover:text-neon-cyan transition-colors">
                                <i class="fa-solid fa-pen text-[10px] mr-1"></i> Edit
                            </button>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-3">
                            <div><p class="text-[10px] text-white/25 mb-0.5">Team Name</p><p class="text-sm text-white/70" x-text="form.team_name || '—'"></p></div>
                            <div><p class="text-[10px] text-white/25 mb-0.5">School</p><p class="text-sm text-white/70" x-text="form.school_name || '—'"></p></div>
                            <div><p class="text-[10px] text-white/25 mb-0.5">Category</p><p class="text-sm text-white/70" x-text="competitionLabel"></p></div>
                            <div><p class="text-[10px] text-white/25 mb-0.5">Instagram</p><p class="text-sm text-white/70">@<span x-text="form.instagram || '—'"></span></p></div>
                        </div>
                    </div>

                    {{-- Members Review --}}
                    <div class="bg-cyber-dark/60 border border-white/5 rounded p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-display text-xs font-semibold tracking-wider text-white/60 flex items-center gap-2">
                                <i class="fa-solid fa-user text-neon-cyan text-[10px]"></i> Team Members
                            </h3>
                            <button type="button" @click="step = 2" class="text-xs text-neon-cyan/60 hover:text-neon-cyan transition-colors">
                                <i class="fa-solid fa-pen text-[10px] mr-1"></i> Edit
                            </button>
                        </div>
                        <div class="space-y-3">
                            <template x-for="(member, idx) in form.members" :key="idx">
                                <div class="p-3 rounded border border-white/5 bg-white/[0.01]">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-xs font-semibold text-white/60" x-text="'Member ' + (idx + 1)"></span>
                                        <span x-show="idx === 0" class="text-[10px] bg-neon-cyan/10 text-neon-cyan px-1.5 py-0.5 rounded">Leader</span>
                                    </div>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-xs">
                                        <div><p class="text-white/20">Name</p><p class="text-white/60" x-text="member.full_name || '—'"></p></div>
                                        <div><p class="text-white/20">NISN</p><p class="text-white/60" x-text="member.nisn || '—'"></p></div>
                                        <div><p class="text-white/20">Email</p><p class="text-white/60 truncate" x-text="member.email || '—'"></p></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="bg-cyber-dark/60 border border-white/5 rounded p-6">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" x-model="form.agreed" class="mt-1 accent-[#05F3DB]">
                            <span class="text-xs text-white/45 leading-relaxed group-hover:text-white/60 transition-colors">
                                I confirm that all information provided is accurate and complete. I agree to the competition rules and terms of DIGIon 2026.
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <div class="flex items-center justify-between pt-6">
                <button type="button" x-show="step > 1" @click="step--"
                        class="px-5 py-2.5 text-sm rounded btn-outline flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Previous
                </button>
                <div x-show="step === 1"></div>

                <button type="button" x-show="step < 5" @click="nextStep()"
                        class="px-5 py-2.5 text-sm rounded btn-primary flex items-center gap-2 ml-auto">
                    Next Step <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>

                <button type="submit" x-show="step === 5" :disabled="!form.agreed || submitting"
                        class="px-6 py-2.5 text-sm rounded btn-primary flex items-center gap-2 ml-auto disabled:opacity-30 disabled:cursor-not-allowed">
                    <i class="fa-solid fa-paper-plane text-xs" x-show="!submitting"></i>
                    <i class="fa-solid fa-spinner fa-spin text-xs" x-show="submitting"></i>
                    <span x-text="submitting ? 'Submitting...' : 'Submit Registration'"></span>
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function registrationForm() {
    return {
        step: 1,
        minMembers: 2,
        maxMembers: 3,
        submitting: false,
        competitionData: {!! json_encode($competitions->mapWithKeys(fn($c) => [$c->id => ['min' => $c->min_members, 'max' => $c->max_members, 'name' => $c->name]])) !!},
        form: {
            team_name: '{{ old("team_name", "") }}',
            school_name: '{{ old("school_name", "") }}',
            competition_id: '{{ old("competition_id", $selectedCategory ?? "") }}',
            instagram: '{{ old("instagram", "") }}',
            members: [
                { full_name: '', birth_place: '', birth_date: '', nisn: '', phone: '', email: '' },
                { full_name: '', birth_place: '', birth_date: '', nisn: '', phone: '', email: '' },
            ],
            agreed: false,
        },

        get membersValid() {
            const count = this.form.members.length;
            return count >= this.minMembers && count <= this.maxMembers;
        },

        get memberInfoText() {
            const comp = this.competitionData[this.form.competition_id];
            if (!comp) return 'Select a category first';
            if (comp.min === comp.max) return comp.name + ': exactly ' + comp.min + ' members required';
            return comp.name + ': ' + comp.min + '–' + comp.max + ' members required';
        },

        get competitionLabel() {
            const comp = this.competitionData[this.form.competition_id];
            return comp ? comp.name : '—';
        },

        onCategoryChange() {
            const comp = this.competitionData[this.form.competition_id];
            if (!comp) return;
            this.minMembers = comp.min;
            this.maxMembers = comp.max;
            while (this.form.members.length < comp.min) this.addMember();
            while (this.form.members.length > comp.max) this.form.members.pop();
        },

        addMember() {
            if (this.form.members.length < this.maxMembers) {
                this.form.members.push({ full_name: '', birth_place: '', birth_date: '', nisn: '', phone: '', email: '' });
            }
        },

        removeMember(idx) {
            if (this.form.members.length > this.minMembers) {
                this.form.members.splice(idx, 1);
            }
        },

        nextStep() {
            if (this.step === 1) {
                if (!this.form.team_name || !this.form.school_name || !this.form.competition_id) {
                    alert('Please fill in all required fields.');
                    return;
                }
            }
            if (this.step === 2) {
                for (let m of this.form.members) {
                    if (!m.full_name || !m.birth_place || !m.birth_date || !m.nisn || !m.phone || !m.email) {
                        alert('Please fill in all member information.');
                        return;
                    }
                }
            }
            if (this.step < 5) this.step++;
        },

        init() {
            if (this.form.competition_id) this.onCategoryChange();
        }
    };
}
</script>
@endsection
