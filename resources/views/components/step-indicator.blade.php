{{-- Step Indicator Component --}}
{{-- Usage: @include('components.step-indicator', ['currentStep' => 2, 'steps' => ['Team Info', 'Members', 'Documents', 'Payment', 'Review']]) --}}
@props(['currentStep' => 1, 'steps' => ['Team Info', 'Members', 'Documents', 'Payment', 'Review']])

<div class="w-full">
    {{-- Desktop Step Bar --}}
    <div class="hidden sm:flex items-center justify-between relative">
        {{-- Progress Line --}}
        <div class="absolute top-5 left-0 right-0 h-px bg-white/10"></div>
        <div class="absolute top-5 left-0 h-px bg-neon-cyan transition-all duration-500"
             style="width: {{ ($currentStep - 1) / (count($steps) - 1) * 100 }}%"></div>

        @foreach($steps as $index => $step)
            @php
                $stepNum = $index + 1;
                $isActive = $stepNum === $currentStep;
                $isComplete = $stepNum < $currentStep;
            @endphp
            <div class="relative flex flex-col items-center" style="width: {{ 100 / count($steps) }}%">
                {{-- Circle --}}
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold z-10 transition-all duration-300
                    @if($isComplete) bg-neon-cyan text-cyber-dark
                    @elseif($isActive) bg-cyber-dark border-2 border-neon-cyan text-neon-cyan shadow-neon-cyan
                    @else bg-cyber-dark border border-white/15 text-white/30
                    @endif">
                    @if($isComplete)
                        <i class="fa-solid fa-check text-xs"></i>
                    @else
                        {{ $stepNum }}
                    @endif
                </div>
                {{-- Label --}}
                <span class="mt-2 text-xs font-medium text-center
                    @if($isActive) text-neon-cyan
                    @elseif($isComplete) text-white/60
                    @else text-white/25
                    @endif">
                    {{ $step }}
                </span>
            </div>
        @endforeach
    </div>

    {{-- Mobile Step Bar (Compact) --}}
    <div class="sm:hidden">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs text-white/40">Step {{ $currentStep }} of {{ count($steps) }}</span>
            <span class="text-xs font-medium text-neon-cyan">{{ $steps[$currentStep - 1] }}</span>
        </div>
        <div class="h-1 bg-white/5 rounded-full overflow-hidden">
            <div class="h-full bg-neon-cyan rounded-full transition-all duration-500"
                 style="width: {{ $currentStep / count($steps) * 100 }}%"></div>
        </div>
    </div>
</div>
