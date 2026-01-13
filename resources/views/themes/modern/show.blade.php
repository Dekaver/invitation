@extends('layouts.app')

@section('title', "{$wedding->groom_name} & {$wedding->bride_name} - Wedding Invitation")

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Hero Section -->
        <div class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-900"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

            <div class="relative z-10 text-center px-4">
                <h1 class="text-6xl md:text-7xl font-bold text-white mb-4 tracking-tight">
                    {{ $wedding->groom_name }} <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">&</span>
                    {{ $wedding->bride_name }}
                </h1>
                <p class="text-xl text-gray-400 mb-8">
                    Celebrating a new beginning
                </p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="container mx-auto px-4 py-20">
            <!-- Event Details - Minimalist -->
            <div class="grid md:grid-cols-2 gap-12 mb-20">
                @if ($wedding->akad_date)
                    <div class="group">
                        <h3 class="text-sm uppercase tracking-widest text-gray-500 mb-4">Akad Nikah</h3>
                        <p class="text-4xl font-light text-white mb-3">
                            {{ $wedding->akad_date->format('d') }}<span
                                class="text-lg text-gray-500 ml-2">{{ strtoupper($wedding->akad_date->format('M')) }}</span>
                        </p>
                        <p class="text-gray-400 mb-2">
                            {{ $wedding->akad_date->format('H:i') }}
                        </p>
                        <p class="text-gray-500">
                            {{ $wedding->akad_location }}
                        </p>
                        <div class="w-12 h-px bg-gradient-to-r from-blue-400 to-transparent mt-4"></div>
                    </div>
                @endif

                @if ($wedding->reception_date)
                    <div class="group">
                        <h3 class="text-sm uppercase tracking-widest text-gray-500 mb-4">Reception</h3>
                        <p class="text-4xl font-light text-white mb-3">
                            {{ $wedding->reception_date->format('d') }}<span
                                class="text-lg text-gray-500 ml-2">{{ strtoupper($wedding->reception_date->format('M')) }}</span>
                        </p>
                        <p class="text-gray-400 mb-2">
                            {{ $wedding->reception_date->format('H:i') }}
                        </p>
                        <p class="text-gray-500">
                            {{ $wedding->reception_location }}
                        </p>
                        <div class="w-12 h-px bg-gradient-to-r from-cyan-400 to-transparent mt-4"></div>
                    </div>
                @endif
            </div>

            <!-- RSVP Stats -->
            <div class="grid grid-cols-3 gap-6 mb-20 py-12 border-y border-gray-800">
                <div class="text-center">
                    <p class="text-3xl font-bold text-cyan-400 mb-2">
                        {{ $wedding->guests()->where('rsvp_status', 'yes')->count() }}
                    </p>
                    <p class="text-gray-500 text-sm">CONFIRMED</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-blue-400 mb-2">
                        {{ $wedding->guests()->whereNull('rsvp_status')->count() }}
                    </p>
                    <p class="text-gray-500 text-sm">PENDING</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-500 mb-2">
                        {{ $wedding->guests()->where('rsvp_status', 'no')->count() }}
                    </p>
                    <p class="text-gray-500 text-sm">DECLINED</p>
                </div>
            </div>

            <!-- Layout: Wishes & RSVP -->
            <div class="grid lg:grid-cols-3 gap-12">

                <!-- RSVP -->
                <div class="lg:col-span-1">
                    @include('invitations.partials.rsvp-form', ['wedding' => $wedding])
                </div>
            </div>

            <!-- Gift Info -->
            @if ($wedding->gifts()->exists())
                <div class="mt-20 pt-20 border-t border-gray-800">
                    <h2 class="text-2xl font-light text-white mb-12">Gift Registry</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        @foreach ($wedding->gifts() as $gift)
                            <div class="bg-gray-900 p-6 border border-gray-800">
                                <p class="text-gray-500 text-sm uppercase tracking-widest mb-2">{{ $gift->bank_name }}</p>
                                <p class="text-white font-light mb-3">{{ $gift->account_name }}</p>
                                <p class="text-cyan-400 font-mono text-sm">{{ $gift->account_number }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Modern theme overrides */
        .bg-white {
            background-color: #1a1a1a;
        }

        .rounded-lg {
            border-radius: 0;
        }
    </style>
@endsection
