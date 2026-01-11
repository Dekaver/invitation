@extends('layouts.app')

@section('title', "{$wedding->groom_name} & {$wedding->bride_name} - Wedding Invitation")

@section('content')
    <div class="h-screen bg-linear-to-br from-pink-50 to-purple-50 flex">
        <!-- Left Sidebar (Fixed) - Hidden on Mobile -->
        <div class="hidden lg:block lg:w-7/12 lg:shrink-0 bg-white shadow-lg">
            <div class="sticky top-0 h-screen overflow-y-auto">
                <!-- Couple Photo -->
                @include('invitations.partials.couple-photo', ['wedding' => $wedding])
            </div>
        </div>

        <!-- Right Content (Main Content) - Full Width on Mobile -->
        <div class="lg:w-5/12 h-screen overflow-y-auto bg-white scroll-hide-y">
            <div class="">
                <!-- Couple Information -->
                @include('invitations.partials.couple-info', ['wedding' => $wedding])

                <!-- Event Details -->
                @include('invitations.partials.event-details', ['wedding' => $wedding])

                <!-- RSVP Statistics -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">RSVP Status</h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <p class="text-3xl font-bold text-green-600">
                                {{ $wedding->guests()->where('rsvp_status', 'yes')->count() }}
                            </p>
                            <p class="text-gray-600 text-sm">Attending</p>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4 text-center">
                            <p class="text-3xl font-bold text-red-600">
                                {{ $wedding->guests()->where('rsvp_status', 'no')->count() }}
                            </p>
                            <p class="text-gray-600 text-sm">Not Attending</p>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-4 text-center">
                            <p class="text-3xl font-bold text-yellow-600">
                                {{ $wedding->guests()->whereNull('rsvp_status')->count() }}
                            </p>
                            <p class="text-gray-600 text-sm">Pending</p>
                        </div>
                    </div>
                </div>

                <!-- Gift Information -->
                @if ($wedding->gifts()->exists())
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Gift Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($wedding->gifts() as $gift)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-800 mb-2">{{ $gift->bank_name }}</h3>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium">Account Name:</span> {{ $gift->account_name }}
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
                <div>
                    @include('invitations.partials.wishes-form', ['wedding' => $wedding])
                </div>
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
