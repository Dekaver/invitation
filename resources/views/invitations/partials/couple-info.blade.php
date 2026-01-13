<!-- Couple Information -->
<div class="bg-purple-200-50 rounded-lg">
    <!-- AR-RUM -->
    <div id="mainContent" class="relative h-[50vh] flex items-center justify-center bg-pink-50 px-6">
        <div class="max-w-3xl text-center">

            <!-- Ayat Arab -->
            <div class="font-arabic text-3xl md:text-4xl leading-loose text-stone-800 mb-6 animate-on-scroll fade-in duration-5000 delay-200 p-2"
                dir="rtl" lang="ar">
                وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا
            </div>

            <!-- Divider -->
            <div class="flex justify-center mb-6">
                <span class="w-24 h-px bg-stone-300"></span>
            </div>

            <!-- Terjemahan -->
            <p class="text-sm md:text-base text-stone-600 italic leading-relaxed mb-2">
                “Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan
                pasangan-pasangan untukmu…”
            </p>

            <!-- Sumber -->
            <small class="block text-xs tracking-widest text-stone-500 uppercase">
                QS. Ar-Rum : 21
            </small>

        </div>
    </div>


    <div class="relative py-24 bg-purple-50 overflow-hidden">

        <!-- SVG Ornament Top -->
        <svg class="absolute top-0 left-1/2 -translate-x-1/2 w-72 opacity-20" viewBox="0 0 400 120" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M20 100 C100 20, 300 20, 380 100" stroke="#9CA3AF" stroke-width="2" fill="none" />
            <circle cx="200" cy="40" r="6" fill="#9CA3AF" />
        </svg>


        <div class="relative max-w-4xl mx-auto grid md:grid-cols-2 gap-16 px-6 text-center">

            <!-- Groom -->
            <div class="flex flex-col items-center">
                <h3 class="text-sm tracking-widest uppercase text-stone-500 mb-4">
                    Mempelai Pria
                </h3>

                <p class="font-wedding text-4xl md:text-5xl text-stone-800 mb-3">
                    {{ $wedding->groom_name }}
                </p>

                <div class="w-16 h-px bg-stone-300 mb-4"></div>

                <p class="text-sm text-stone-600 leading-relaxed">
                    Putra kedua dari<br>
                    <span class="font-medium">
                        {{ $wedding->groom_father ?? '—' }}
                    </span>
                    &amp;
                    <span class="font-medium">
                        {{ $wedding->groom_mother ?? '—' }}
                    </span>
                </p>
            </div>

            <!-- Bride -->
            <div class="flex flex-col items-center">

                <h3 class="text-sm tracking-widest uppercase text-stone-500 mb-4">
                    Mempelai Wanita
                </h3>

                <p class="font-wedding text-4xl md:text-5xl text-stone-800 mb-3">
                    {{ $wedding->bride_name }}
                </p>

                <div class="w-16 h-px bg-stone-300 mb-4"></div>

                <p class="text-sm text-stone-600 leading-relaxed">
                    Putri kedua dari<br>
                    <span class="font-medium">
                        {{ $wedding->bride_father ?? '—' }}
                    </span>
                    &amp;
                    <span class="font-medium">
                        {{ $wedding->bride_mother ?? '—' }}
                    </span>
                </p>
            </div>

        </div>

        <!-- SVG Ornament Bottom -->
        <svg class="absolute bottom-0 left-1/2 -translate-x-1/2 w-72 opacity-20 rotate-180" viewBox="0 0 400 120"
            fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 100 C100 20, 300 20, 380 100" stroke="#9CA3AF" stroke-width="2" fill="none" />
            <circle cx="200" cy="40" r="6" fill="#9CA3AF" />
        </svg>

    </div>

</div>
