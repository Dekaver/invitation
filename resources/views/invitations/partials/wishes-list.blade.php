<!-- Wishes List -->
<div class="bg-gray-50 rounded-lg p-6">
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Blessings & Wishes</h3>

    @if ($wedding->wishes->count() > 0)
        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
            @foreach ($wishes as $wish)
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 border-l-4 border-purple-300">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">
                                {{ $wish->guest_name }}
                            </p>
                            <p class="text-gray-700 text-sm mt-2">
                                {{ $wish->message }}
                            </p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">
                        {{ $wish->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- @if ($wedding->wishes->hasMorePages())
            <div class="mt-4 text-center">
                <a href="{{ route('invitations.wishes.index', $wedding->slug) }}"
                    class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                    View all wishes →
                </a>
            </div>
        @endif --}}
    @else
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            <p class="text-gray-500">No blessings yet. Be the first to share one!</p>
        </div>
    @endif
</div>
