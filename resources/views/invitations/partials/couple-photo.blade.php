<!-- Couple Photo -->
<div class="h-full flex flex-col items-center justify-center p-8">
    <!-- Placeholder for couple photo -->
    <div
        class="w-64 h-64 bg-linear-to-br from-purple-200 to-pink-200 rounded-full flex items-center justify-center mb-8">
        <svg class="w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
            </path>
        </svg>
    </div>
    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-linear-to-r from-purple-600 to-pink-600 text-center">
        {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
    </h2>
</div>
