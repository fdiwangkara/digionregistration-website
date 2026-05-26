{{-- Contact / CTA Section --}}
<section id="contact" class="py-20 relative cyber-grid">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="bg-cyber-dark/80 border border-neon-cyan/15 rounded-lg p-8 sm:p-12 text-center">
            {{-- Accent corners --}}
            <div class="relative">
                <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-wider text-white mb-3">
                    Ready to Become the Next Digital Innovator?
                </h2>
                <p class="text-sm text-white/45 mb-8 max-w-lg mx-auto">
                    Register your team now and compete at the national stage. Limited to 24 teams per category — don't miss your chance.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-8">
                    <a href="{{ route('register') }}" class="px-8 py-3 text-sm font-semibold rounded btn-primary inline-flex items-center gap-2">
                        Register Now
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('status') }}" class="px-8 py-3 text-sm font-semibold rounded btn-outline inline-flex items-center gap-2">
                        Track Status
                    </a>
                </div>

                {{-- Contact Cards --}}
                <div class="grid sm:grid-cols-3 gap-3 max-w-xl mx-auto">
                    <a href="mailto:digion@binus.ac.id" class="flex items-center gap-2 p-3 rounded border border-white/5 hover:border-neon-cyan/15 transition-colors group">
                        <i class="fa-solid fa-envelope text-neon-cyan/60 text-sm group-hover:text-neon-cyan transition-colors"></i>
                        <span class="text-xs text-white/40 group-hover:text-white/60 transition-colors">digion@binus.ac.id</span>
                    </a>
                    <a href="https://instagram.com/digion.binus" class="flex items-center gap-2 p-3 rounded border border-white/5 hover:border-neon-pink/15 transition-colors group">
                        <i class="fa-brands fa-instagram text-neon-pink/60 text-sm group-hover:text-neon-pink transition-colors"></i>
                        <span class="text-xs text-white/40 group-hover:text-white/60 transition-colors">@digion.binus</span>
                    </a>
                    <a href="https://wa.me/6281234567890" class="flex items-center gap-2 p-3 rounded border border-white/5 hover:border-green-500/15 transition-colors group">
                        <i class="fa-brands fa-whatsapp text-green-500/60 text-sm group-hover:text-green-500 transition-colors"></i>
                        <span class="text-xs text-white/40 group-hover:text-white/60 transition-colors">WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
