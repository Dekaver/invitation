<!-- Guest RSVP Form -->
<div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
    @if (request()->has('guest_uuid'))
        @php
            $guest = \App\Models\Guest::where('uuid', request('guest_uuid'))
                ->where('wedding_id', $wedding->id)
                ->first();
        @endphp

        @if ($guest)
            <form action="{{ route('invitations.guest.update-rsvp', [$wedding->slug, $guest->uuid]) }}" method="POST"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Your RSVP</label>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="rsvp_status" value="yes" class="w-4 h-4 text-green-600"
                                {{ $guest->rsvp_status === 'yes' ? 'checked' : '' }} required>
                            <span class="ml-3 text-gray-700">✓ I will attend</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="rsvp_status" value="no" class="w-4 h-4 text-red-600"
                                {{ $guest->rsvp_status === 'no' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-700">✗ I cannot attend</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="rsvp_status" value="maybe" class="w-4 h-4 text-yellow-600"
                                {{ $guest->rsvp_status === 'maybe' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-700">? I am not sure</span>
                        </label>
                    </div>
                </div>

                <div id="guest-count-group" class="hidden">
                    <label for="total_guest" class="block text-sm font-medium text-gray-700 mb-2">Number of
                        Guests</label>
                    <select name="total_guest" id="total_guest"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ $guest->total_guest == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-2 px-4 rounded-lg hover:shadow-lg transition">
                    Submit RSVP
                </button>

                @if ($guest->rsvp_status)
                    <p class="text-sm text-gray-600 bg-green-50 p-2 rounded">
                        ✓ Your response was recorded
                    </p>
                @endif
            </form>

            <script>
                const guestCountGroup = document.getElementById('guest-count-group');
                const rsvpRadios = document.querySelectorAll('input[name="rsvp_status"]');

                function updateGuestCountVisibility() {
                    const selectedRsvp = document.querySelector('input[name="rsvp_status"]:checked').value;
                    guestCountGroup.classList.toggle('hidden', selectedRsvp !== 'yes');
                }

                rsvpRadios.forEach(radio => {
                    radio.addEventListener('change', updateGuestCountVisibility);
                });

                updateGuestCountVisibility();
            </script>
        @else
            <div class="text-center py-4">
                <p class="text-gray-600 text-sm mb-3">Guest not found</p>
                <p class="text-gray-500 text-xs">Please check your invitation link</p>
            </div>
        @endif
    @else
        <div class="text-center py-4">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-600 text-sm">
                Use your unique guest link to RSVP
            </p>
        </div>
    @endif
</div>
