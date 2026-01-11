@extends('layouts.app')

@section('title', "{$wedding->groom_name} & {$wedding->bride_name} - Wedding Invitation")

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-amber-50 via-white to-amber-50">
        <div class="container mx-auto px-4 py-12">
            <!-- Decorative Header -->
            <div class="text-center mb-12">
                <div class="flex justify-center mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-px bg-gradient-to-r from-transparent to-amber-700"></div>
                        <span class="text-3xl text-amber-700">✿</span>
                        <div class="w-12 h-px bg-gradient-to-l from-transparent to-amber-700"></div>
                    </div>
                </div>

                <h1 class="text-5xl md:text-6xl font-serif text-gray-800 mb-2">
                    {{ $wedding->groom_name }} & {{ $wedding->bride_name }}
                </h1>

                <p class="text-lg text-amber-700 font-serif italic">
                    Together with their parents invite you to celebrate
                </p>

                <div class="flex justify-center mt-6 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-px bg-gradient-to-r from-transparent to-amber-700"></div>
                        <span class="text-3xl text-amber-700">✿</span>
                        <div class="w-12 h-px bg-gradient-to-l from-transparent to-amber-700"></div>
                    </div>
                </div>
            </div>

            <!-- Couple & Parents Information -->
            <div class="bg-white border-2 border-amber-700 rounded-lg shadow-lg p-12 mb-12 max-w-2xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="text-center border-r border-amber-200">
                        <p class="text-sm uppercase tracking-widest text-amber-600 mb-3">The Groom's Family</p>
                        <p class="text-2xl font-serif text-gray-800 mb-3">{{ $wedding->groom_name }}</p>
                        <p class="text-sm text-gray-600">
                            Son of<br>
                            <span class="font-serif">{{ $wedding->groom_father ?? 'N/A' }}</span><br>
                            and<br>
                            <span class="font-serif">{{ $wedding->groom_mother ?? 'N/A' }}</span>
                        </p>
                    </div>

                    <div class="text-center">
                        <p class="text-sm uppercase tracking-widest text-amber-600 mb-3">The Bride's Family</p>
                        <p class="text-2xl font-serif text-gray-800 mb-3">{{ $wedding->bride_name }}</p>
                        <p class="text-sm text-gray-600">
                            Daughter of<br>
                            <span class="font-serif">{{ $wedding->bride_father ?? 'N/A' }}</span><br>
                            and<br>
                            <span class="font-serif">{{ $wedding->bride_mother ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                @if ($wedding->akad_date)
                    <div class="bg-white border-2 border-amber-700 rounded-lg shadow-lg p-8 text-center">
                        <p class="text-sm uppercase tracking-widest text-amber-600 mb-4">Akad Nikah</p>
                        <p class="text-3xl font-serif text-gray-800 mb-3">
                            {{ $wedding->akad_date->format('d F Y') }}
                        </p>
                        <p class="text-lg text-amber-700 font-serif mb-2">
                            {{ $wedding->akad_date->format('H:i') }}
                        </p>
                        <p class="text-gray-700">
                            {{ $wedding->akad_location }}
                        </p>
                    </div>
                @endif

                @if ($wedding->reception_date)
                    <div class="bg-white border-2 border-amber-700 rounded-lg shadow-lg p-8 text-center">
                        <p class="text-sm uppercase tracking-widest text-amber-600 mb-4">Reception</p>
                        <p class="text-3xl font-serif text-gray-800 mb-3">
                            {{ $wedding->reception_date->format('d F Y') }}
                        </p>
                        <p class="text-lg text-amber-700 font-serif mb-2">
                            {{ $wedding->reception_date->format('H:i') }}
                        </p>
                        <p class="text-gray-700">
                            {{ $wedding->reception_location }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- RSVP & Wishes Layout -->
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    @include('invitations.partials.rsvp-form', ['wedding' => $wedding])
                </div>

                <div class="lg:col-span-2">
                    @include('invitations.partials.wishes-list', [
                        'wedding' => $wedding,
                        'wishes' => $wishes,
                    ])
                </div>
            </div>

            <!-- Wishes Form -->
            <div class="mt-12 max-w-2xl mx-auto">
                @include('invitations.partials.wishes-form', ['wedding' => $wedding])
            </div>

            <!-- Gift Information -->
            @if ($wedding->gifts()->exists())
                <div class="mt-12 bg-white border-2 border-amber-700 rounded-lg shadow-lg p-8">
                    <h2 class="text-center text-2xl font-serif text-amber-700 mb-8">Gift Registry</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach ($wedding->gifts() as $gift)
                            <div class="text-center border-t border-amber-200 pt-4">
                                <p class="text-sm uppercase tracking-widest text-amber-600 mb-2">{{ $gift->bank_name }}</p>
                                <p class="font-serif text-gray-800 mb-3">{{ $gift->account_name }}</p>
                                <p class="font-mono text-amber-700 text-lg">{{ $gift->account_number }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Closing -->
            <div class="text-center mt-16 pt-8">
                <div class="flex justify-center mb-4">
                    <span class="text-4xl text-amber-700">❖</span>
                </div>
                <p class="text-gray-600 font-serif italic">
                    Together we celebrate love, family, and new beginnings
                </p>
            </div>
        </div>
    </div>
@endsection
