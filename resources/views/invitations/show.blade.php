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
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Hadiah</h2>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                            @foreach ($wedding->gifts as $gift)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2">{{ $gift->bank_name }}</h3>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium">Nama Rekening:</span> {{ $gift->account_name }}
                                    </p>
                                    <p class="text-gray-600 font-mono bg-gray-100 p-2 rounded">
                                        {{ $gift->account_number }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- RSVP Form -->
                @include('invitations.partials.rsvp-form', ['wedding' => $wedding])

                <!-- Wishes List -->
                @include('invitations.partials.wishes-list', [
                    'wedding' => $wedding,
                    'wishes' => $wedding->wishes,
                ])

                <!-- Wishes Submission Form -->
                {{-- <div>
                    @include('invitations.partials.wishes-form', ['wedding' => $wedding])
                </div> --}}

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
        .scroll-hide-y {
            overflow-y: scroll;
            scrollbar-width: none;
        }

        .scroll-hide-y::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush
