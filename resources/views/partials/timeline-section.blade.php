{{-- Timeline Section --}}
<section id="timeline" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center mb-14">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-neon-cyan/60 mb-3">Event Schedule</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white heading-accent">
                Timeline
            </h2>
        </div>

        {{-- Timeline Container --}}
        <div class="max-w-4xl mx-auto">
            {{-- Desktop: Horizontal --}}
            <div class="hidden md:block relative">
                {{-- Connecting Line --}}
                <div class="absolute top-6 left-0 right-0 h-px bg-white/10"></div>

                <div class="flex justify-between">
                    @include('components.timeline-item', ['icon' => 'fa-solid fa-pen-to-square', 'title' => 'Registration', 'date' => '1 May – 30 June 2026', 'active' => true])
                    @include('components.timeline-item', ['icon' => 'fa-solid fa-file-lines', 'title' => 'Proposal Selection', 'date' => '1 – 15 July 2026'])
                    @include('components.timeline-item', ['icon' => 'fa-solid fa-code', 'title' => 'Development', 'date' => '16 July – 20 Aug 2026'])
                    @include('components.timeline-item', ['icon' => 'fa-solid fa-presentation-screen', 'title' => 'Final & Presentation', 'date' => '29 August 2026'])
                    @include('components.timeline-item', ['icon' => 'fa-solid fa-trophy', 'title' => 'Announcement', 'date' => '29 August 2026'])
                </div>
            </div>

            {{-- Mobile: Vertical --}}
            <div class="md:hidden space-y-0 relative">
                <div class="absolute top-0 bottom-0 left-6 w-px bg-white/10"></div>

                @php
                $timelineItems = [
                    ['icon' => 'fa-solid fa-pen-to-square', 'title' => 'Registration', 'date' => '1 May – 30 June 2026', 'active' => true],
                    ['icon' => 'fa-solid fa-file-lines', 'title' => 'Proposal Selection', 'date' => '1 – 15 July 2026', 'active' => false],
                    ['icon' => 'fa-solid fa-code', 'title' => 'Development', 'date' => '16 July – 20 Aug 2026', 'active' => false],
                    ['icon' => 'fa-solid fa-chalkboard-user', 'title' => 'Final & Presentation', 'date' => '29 August 2026', 'active' => false],
                    ['icon' => 'fa-solid fa-trophy', 'title' => 'Announcement', 'date' => '29 August 2026', 'active' => false],
                ];
                @endphp

                @foreach($timelineItems as $item)
                <div class="flex items-start gap-4 py-4 relative">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 z-10
                        @if($item['active']) bg-neon-cyan/20 border-2 border-neon-cyan text-neon-cyan
                        @else bg-cyber-dark border border-white/10 text-white/25
                        @endif">
                        <i class="{{ $item['icon'] }} text-sm"></i>
                    </div>
                    <div class="pt-2">
                        <p class="text-sm font-semibold @if($item['active']) text-neon-cyan @else text-white/50 @endif">{{ $item['title'] }}</p>
                        <p class="text-xs text-white/30 mt-0.5">{{ $item['date'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
