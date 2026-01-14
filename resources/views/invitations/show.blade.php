@extends('layouts.app')

@section('title', "{$wedding->groom_name} & {$wedding->bride_name} - Wedding Invitation")

@section('content')
    <div class="h-screen bg-linear-to-br from-pink-50 to-purple-50 flex">
        <!-- Left Sidebar (Fixed) - Hidden on Mobile -->
        <div class="hidden lg:block lg:w-[63%] lg:shrink-0 bg-white shadow-lg">
            <div class="sticky top-0 h-screen overflow-y-auto">
                <!-- Couple Photo -->
                @include('invitations.partials.couple-photo', ['wedding' => $wedding])
            </div>
        </div>

        <!-- Right Content (Main Content) - Full Width on Mobile -->
        <div class="lg:w-[38%] h-screen overflow-y-auto bg-white scroll-hide-y">
            <div class="">
                <!-- Cover -->
                @include('invitations.partials.cover', ['wedding' => $wedding])

                <!-- Couple Information -->
                @include('invitations.partials.couple-info', ['wedding' => $wedding])

                <!-- Event Details -->
                @include('invitations.partials.event-details', ['wedding' => $wedding])

                <!-- Countdown Timer -->
                @include('invitations.partials.countdown', ['wedding' => $wedding])

                <!-- Map -->
                @if (!empty($wedding->map_embed_url))
                    @include('invitations.partials.map', ['wedding' => $wedding])
                @endif


                @if ($wedding->gifts()->exists())
                    <div class="bg-purple-200 shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Gifts</h2>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                            @foreach ($wedding->gifts as $gift)
                                <div class="border border-gray-200 rounded-lg p-4 pattern-circle">
                                    <h3 class="font-semibold text-gray-800 mb-2">
                                        {{ $gift->bank_name }}
                                    </h3>

                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium">Nama Rekening:</span>
                                        {{ $gift->account_name }}
                                    </p>

                                    <div class="flex items-center gap-2">
                                        <p class="text-gray-600 font-mono bg-gray-100 p-2 rounded flex-1 copy-target">
                                            {{ $gift->account_number }}
                                        </p>

                                        <button onclick="copyPrevious(this)"
                                            class="bg-purple-600 hover:bg-purple-700 text-white text-sm px-3 py-2 rounded transition">
                                            Copy
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>



                @endif

                <!-- RSVP Form -->
                @include('invitations.partials.rsvp-form', ['wedding' => $wedding, 'guests' => $guests])


                <!-- Thanks -->
                @include('invitations.partials.thanksgiving', ['wedding' => $wedding])

                <!-- Play Music -->
                @include('invitations.partials.playpause')
            </div>
        </div>
    </div>
@endsection

@push('head')
    <style>
        .pattern-circle {
            background-color: #f5f3ff;
            background-image: radial-gradient(circle,
                    rgba(196, 185, 253, 0.25) 2px,
                    transparent 2px);
            background-size: 24px 24px;
        }
    </style>
    <style>
        .pattern-circle-layered {
            background-color: #f5f3ff;
            background-image:
                radial-gradient(circle, rgba(196, 185, 253, .25) 2px, transparent 2px),
                radial-gradient(circle, rgba(196, 185, 253, .15) 4px, transparent 4px);
            background-size: 24px 24px, 48px 48px;
            background-position: 0 0, 12px 12px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function copyPrevious(button) {
            const textElement = button.previousElementSibling;
            const text = textElement.innerText;

            navigator.clipboard.writeText(text).then(() => {
                button.innerText = 'Copied ✓';
                setTimeout(() => button.innerText = 'Copy', 1500);
            });
        }
    </script>
@endpush
