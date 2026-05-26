{{-- Footer Component --}}
<footer class="bg-cyber-dark border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- Brand --}}
            <div class="md:col-span-1">
                <a href="{{ route('landing') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 rounded bg-neon-cyan/10 border border-neon-cyan/30 flex items-center justify-center">
                        <i class="fa-solid fa-bolt text-neon-cyan text-xs"></i>
                    </div>
                    <span class="font-display font-bold text-sm tracking-wider text-white">
                        D<span class="text-neon-cyan">i</span>G<span class="text-neon-cyan">i</span>On
                    </span>
                </a>
                <p class="text-xs text-white/40 leading-relaxed mb-4">
                    Digital Innovation Competition 2026.<br>
                    Hosted by BINUS University Malang.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-8 h-8 rounded border border-white/10 flex items-center justify-center text-white/40 hover:text-neon-cyan hover:border-neon-cyan/30 transition-colors text-xs">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded border border-white/10 flex items-center justify-center text-white/40 hover:text-neon-cyan hover:border-neon-cyan/30 transition-colors text-xs">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded border border-white/10 flex items-center justify-center text-white/40 hover:text-neon-cyan hover:border-neon-cyan/30 transition-colors text-xs">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded border border-white/10 flex items-center justify-center text-white/40 hover:text-neon-cyan hover:border-neon-cyan/30 transition-colors text-xs">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-white/60 mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('landing') }}#about" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">About</a></li>
                    <li><a href="{{ route('landing') }}#competitions" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Competitions</a></li>
                    <li><a href="{{ route('landing') }}#timeline" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Timeline</a></li>
                    <li><a href="{{ route('landing') }}#faq" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">FAQ</a></li>
                </ul>
            </div>

            {{-- Competition --}}
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-white/60 mb-4">Competitions</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('competition.show', 'data-analytics') }}" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Data Analytics</a></li>
                    <li><a href="{{ route('competition.show', 'tech-rally') }}" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Tech Rally Games</a></li>
                    <li><a href="{{ route('register') }}" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Register</a></li>
                    <li><a href="{{ route('status') }}" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">Track Status</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-white/60 mb-4">Contact</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-neon-cyan/60 text-xs mt-1"></i>
                        <span class="text-sm text-white/40">BINUS University Malang, Jl. Araya Mansion No.8-22, Malang</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-neon-cyan/60 text-xs"></i>
                        <a href="mailto:digion@binus.ac.id" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">digion@binus.ac.id</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-neon-cyan/60 text-xs"></i>
                        <a href="https://wa.me/6281234567890" class="text-sm text-white/40 hover:text-neon-cyan transition-colors">+62 812-3456-7890</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="section-divider mt-8 mb-6"></div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-white/30">&copy; 2026 DIGIon. All rights reserved.</p>
            <p class="text-xs text-white/30">Organized by <span class="text-neon-magenta">Computer Science BINUS @Malang</span></p>
        </div>
    </div>
</footer>
