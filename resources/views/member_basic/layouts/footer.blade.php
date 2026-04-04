<footer class="mt-auto py-10 px-6 bg-white/50 dark:bg-slate-900/50 backdrop-blur-xl border-t border-lime-200/30 dark:border-lime-900/30 transition-colors duration-500">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">

            <div class="flex flex-col items-center md:items-start gap-4">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-lime-500 rounded-lg flex items-center justify-center shadow-lg transform group-hover:rotate-6 transition-transform">
                        <span class="text-white font-heading text-base">Y</span>
                    </div>
                    <span class="font-heading text-lg tracking-tighter text-slate-900 dark:text-white uppercase">YOTA HUB</span>
                </a>
                <p class="text-xs font-medium text-slate-500 dark:text-lime-200/50 max-w-xs text-center md:text-left leading-relaxed">
                    Membangun peradaban berkelanjutan melalui kearifan lokal dan teknologi.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                <div class="flex flex-col items-center md:items-start gap-3">
                    <span class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest">Bantuan</span>
                    <ul class="flex md:flex-col gap-4 md:gap-2 text-xs font-bold text-slate-600 dark:text-slate-400">
                        <li><a href="#" class="hover:text-lime-500 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-lime-500 transition">Panduan</a></li>
                        <li><a href="#" class="hover:text-lime-500 transition">Kontak</a></li>
                    </ul>
                </div>
                <div class="flex flex-col items-center md:items-start gap-3">
                    <span class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest">Legal</span>
                    <ul class="flex md:flex-col gap-4 md:gap-2 text-xs font-bold text-slate-600 dark:text-slate-400">
                        <li><a href="{{ route('privacy') }}" class="hover:text-lime-500 transition">Privasi</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-lime-500 transition">Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col items-center md:items-end gap-4">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Join Community</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-lime-400 hover:text-slate-900 transition-all active:scale-90">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-lime-400 hover:text-slate-900 transition-all active:scale-90">
                        <i class="fab fa-discord text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-slate-200/50 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                © 2026 YOTA WUJUDKAN ASA FOUNDATION.
            </p>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Server Status: Normal</span>
            </div>
        </div>
    </div>
</footer>
