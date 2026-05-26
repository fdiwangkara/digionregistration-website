{{-- FAQ Item Component --}}
{{-- Usage: @include('components.faq-item', ['question' => '...', 'answer' => '...']) --}}
@props(['question' => '', 'answer' => ''])

<div x-data="{ open: false }" class="border border-white/5 rounded overflow-hidden">
    <button @click="open = !open" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-white/[0.02] transition-colors">
        <span class="text-sm font-medium text-white/80 pr-4">{{ $question }}</span>
        <i class="fa-solid fa-plus text-xs text-white/30 transition-transform duration-200 shrink-0" :class="open && 'rotate-45 text-neon-cyan'"></i>
    </button>
    <div x-show="open" x-collapse>
        <div class="px-5 pb-4 text-sm text-white/45 leading-relaxed border-t border-white/5 pt-3">
            {{ $answer }}
        </div>
    </div>
</div>
