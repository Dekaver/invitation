@extends('layouts.app')

@section('title', "RSVP - {$wedding->groom_name} & {$wedding->bride_name}")

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-pink-50 to-purple-50 py-12">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Status Alert -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Guest Welcome Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome, {{ $guest->name }}!</h1>
                <p class="text-gray-600 mb-6">
                    You are invited to celebrate {{ $wedding->groom_name }} & {{ $wedding->bride_name }}'s wedding
                </p>

                <!-- Wedding Details -->
                <div class="grid md:grid-cols-2 gap-6 mb-8 border-t pt-6">
                    @if ($wedding->akad_date)
                        <div>
                            <h3 class="font-semibold text-purple-600 mb-2">Akad Nikah</h3>
                            <p class="text-gray-700">
                                {{ $wedding->akad_date->format('l, d F Y') }}
                            </p>
                            <p class="text-gray-600 text-sm">{{ $wedding->akad_date->format('H:i') }}</p>
                            <p class="text-gray-600 text-sm">{{ $wedding->akad_location }}</p>
                        </div>
                    @endif

                    @if ($wedding->reception_date)
                        <div>
                            <h3 class="font-semibold text-pink-600 mb-2">Reception</h3>
                            <p class="text-gray-700">
                                {{ $wedding->reception_date->format('l, d F Y') }}
                            </p>
                            <p class="text-gray-600 text-sm">{{ $wedding->reception_date->format('H:i') }}</p>
                            <p class="text-gray-600 text-sm">{{ $wedding->reception_location }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RSVP Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Confirm Your Attendance</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ route('invitations.guest.update-rsvp', ['wedding' => $wedding->slug, 'guest' => $guest->uuid]) }}"
                    class="space-y-6">
                    @csrf

                    <!-- RSVP Status Selection -->
                    <div>
                        <label class="block font-semibold text-gray-800 mb-4">
                            Will you be attending?
                        </label>

                        <div class="space-y-3">
                            <!-- Yes Option -->
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                                :class="{ 'border-green-500 bg-green-50': @if ($guest->rsvp_status === 'yes') true @else false @endif, 'border-gray-200 hover:border-gray-300': @if ($guest->rsvp_status !== 'yes') true @else false @endif }">
                                <input type="radio" name="rsvp_status" value="yes" class="mr-3"
                                    @if ($guest->rsvp_status === 'yes') checked @endif
                                    onclick="document.getElementById('guest-count').classList.remove('hidden')">
                                <span class="font-medium">
                                    ✓ Yes, I will attend!
                                </span>
                            </label>

                            <!-- Maybe Option -->
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                                :class="{ 'border-yellow-500 bg-yellow-50': @if ($guest->rsvp_status === 'maybe') true @else false @endif, 'border-gray-200 hover:border-gray-300': @if ($guest->rsvp_status !== 'maybe') true @else false @endif }">
                                <input type="radio" name="rsvp_status" value="maybe" class="mr-3"
                                    @if ($guest->rsvp_status === 'maybe') checked @endif
                                    onclick="document.getElementById('guest-count').classList.add('hidden')">
                                <span class="font-medium">
                                    ? Maybe, I'm not sure yet
                                </span>
                            </label>

                            <!-- No Option -->
                            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition"
                                :class="{ 'border-red-500 bg-red-50': @if ($guest->rsvp_status === 'no') true @else false @endif, 'border-gray-200 hover:border-gray-300': @if ($guest->rsvp_status !== 'no') true @else false @endif }">
                                <input type="radio" name="rsvp_status" value="no" class="mr-3"
                                    @if ($guest->rsvp_status === 'no') checked @endif
                                    onclick="document.getElementById('guest-count').classList.add('hidden')">
                                <span class="font-medium">
                                    ✕ No, I cannot attend
                                </span>
                            </label>
                        </div>

                        @error('rsvp_status')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Number of Guests (visible only when attending) -->
                    <div id="guest-count" class="@if ($guest->rsvp_status !== 'yes') hidden @endif">
                        <label for="total_guest" class="block font-semibold text-gray-800 mb-2">
                            How many guests will you bring?
                        </label>
                        <select id="total_guest" name="total_guest"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Select number of guests</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" @if ($guest->total_guest === $i) selected @endif>
                                    {{ $i }} {{ $i === 1 ? 'guest' : 'guests' }}
                                </option>
                            @endfor
                        </select>

                        @error('total_guest')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition">
                        Save My RSVP
                    </button>
                </form>

                <!-- Last updated info -->
                @if ($guest->updated_at->isToday())
                    <p class="text-gray-500 text-sm text-center mt-6">
                        Last updated today at {{ $guest->updated_at->format('H:i') }}
                    </p>
                @else
                    <p class="text-gray-500 text-sm text-center mt-6">
                        Last updated {{ $guest->updated_at->diffForHumans() }}
                    </p>
                @endif
            </div>

            <!-- Link to Wishes -->
            <div class="mt-8 text-center">
                <a href="{{ route('invitations.wishes.index', ['wedding' => $wedding->slug]) }}"
                    class="text-purple-600 hover:text-purple-700 font-semibold">
                    ← View Wedding Invitation & Leave Wishes
                </a>
            </div>
        </div>
    </div>

    <script>
        // Update guest count visibility based on RSVP selection
        document.querySelectorAll('input[name="rsvp_status"]').forEach(input => {
            input.addEventListener('change', function() {
                const guestCountDiv = document.getElementById('guest-count');
                if (this.value === 'yes') {
                    guestCountDiv.classList.remove('hidden');
                } else {
                    guestCountDiv.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
