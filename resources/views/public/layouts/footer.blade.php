<footer class="bg-slate-900 dark:bg-[#021510] text-slate-300 pt-20 pb-10 px-4 relative overflow-hidden transition-colors duration-500">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-lime-500 via-yellow-400 to-lime-500"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-lime-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
        <div class="glass-card bg-white/5 border-white/10 dark:border-lime-900/30 rounded-[2.5rem] p-8 md:p-12 mb-20 flex flex-col lg:flex-row items-center justify-between gap-8 transition-all">
            <div class="max-w-md text-center lg:text-left">
                <h3 class="font-heading text-2xl text-white mb-2 uppercase tracking-tight">Impact Update</h3>
                <p class="text-sm font-medium text-slate-400">Join the journey of spreading benefits. Get our monthly action transparency reports directly to your inbox.</p>
            </div>

            <form class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <input type="email" placeholder="Your Email Address"
                    class="bg-slate-800/50 dark:bg-black/20 border-2 border-slate-700 dark:border-lime-900/50 rounded-2xl px-6 py-4 text-sm font-bold text-white focus:border-lime-500 focus:ring-0 transition w-full lg:w-80">
                <button type="submit" class="btn-lemon px-8 py-4 rounded-2xl font-heading text-sm uppercase tracking-widest shadow-lg shadow-lime-500/20 active:scale-95 transition-transform">
                    Subscribe
                </button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-20">
            <div class="col-span-2 lg:col-span-2 pr-0 lg:pr-20">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-lime-500 rounded-xl flex items-center justify-center shadow-lg transform rotate-12">
                        <span class="text-white font-heading text-xl">Y</span>
                    </div>
                    <span class="font-heading text-2xl tracking-tighter text-white">YOTA.HUB</span>
                </div>
                <p class="text-sm font-medium leading-relaxed mb-6 italic opacity-70">
                    A national non-profit social organization (NGO) dedicated to building a sustainable civilization through local wisdom and technology.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 dark:bg-lime-900/20 flex items-center justify-center hover:bg-lime-500 hover:text-slate-900 transition-all font-black text-xs">LI</a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 dark:bg-lime-900/20 flex items-center justify-center hover:bg-lime-500 hover:text-slate-900 transition-all font-black text-xs">IN</a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 dark:bg-lime-900/20 flex items-center justify-center hover:bg-lime-500 hover:text-slate-900 transition-all font-black text-xs">YO</a>
                </div>
            </div>

            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-lime-500 mb-6">Organization</h4>
                <ul class="space-y-4 text-sm font-bold">
                    <li><a href="#" class="hover:text-lime-400 transition-colors">Foundation Profile</a></li>
                    <li><a href="#" class="text-lime-400 hover:text-lime-300 transition italic underline decoration-2 underline-offset-4">Legality (AHU)</a></li>
                    <li><a href="#" class="hover:text-lime-400 transition-colors">Career & Volunteer</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-lime-500 mb-6">Our Focus</h4>
                <ul class="space-y-4 text-sm font-bold">
                    <li><a href="#" class="hover:text-lime-400 transition-colors">STEAM Empowerment</a></li>
                    <li><a href="#" class="hover:text-lime-400 transition-colors">Disaster Mitigation</a></li>
                    <li><a href="#" class="hover:text-lime-400 transition-colors">Local Partnership</a></li>
                </ul>
            </div>

            <div class="col-span-2 md:col-span-1">
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-lime-500 mb-6">Official Contact</h4>
                <div class="space-y-4 text-xs font-bold leading-relaxed">
                    <p class="opacity-60 uppercase">HQ: JATIMEKAR RESIDENCE, BLK. C NO. 26, BANDUNG REGENCY 40375</p>
                    <a href="mailto:yotaadiwidyacenter@gmail.com" class="block text-white hover:text-lime-400 transition-colors">yotaadiwidyacenter@gmail.com</a>
                    <p class="text-white tracking-widest">+62 851-1771-3303</p>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-800 dark:border-lime-900/30 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-[10px] font-bold uppercase tracking-widest opacity-40">
                © 2026 YOTA WUJUDKAN ASA FOUNDATION. ALL RIGHTS RESERVED.
            </p>
            <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest">
                <a href="{{ route('privacy') }}" class="hover:text-lime-400 transition-colors">Privacy</a>
                <a href="{{ route('terms') }}" class="hover:text-lime-400 transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>
