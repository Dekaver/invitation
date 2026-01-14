@extends('layouts.app')

@section('title', "RSVP - {$wedding->groom_name} & {$wedding->bride_name}")

@section('content')
    <div class="min-h-screen bg-linear-to-br from-purple-00 to-pink-50 flex items-center justify-center">
        <div class="bg-purple-500 rounded-3xl shadow-xl px-10 py-12 max-w-sm w-full space-y-6">
            <h1 class="text-xl font-semibold text-purple-700 text-center">
                Share Undangan
            </h1>

            <!-- Input nama -->
            <div>
                <label class="block text-sm text-gray-600 mb-2">
                    Nama Tamu
                </label>
                <input id="guestName" type="text" placeholder="Contoh: Bpk Erza"
                    class="w-full rounded-xl border-gray-300 focus:border-purple-400 focus:ring-purple-400">
            </div>

            <!-- Output link -->
            <div>
                <label class="block text-sm text-gray-600 mb-2">
                    Link Undangan
                </label>
                <input id="inviteLink" readonly class="w-full rounded-xl bg-gray-100 text-sm">
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <button onclick="generateLink()"
                    class="flex-1 bg-purple-600 text-white py-2 rounded-xl hover:bg-purple-700 transition">
                    Generate
                </button>

                <button onclick="copyLink()"
                    class="flex-1 bg-pink-500 text-white py-2 rounded-xl hover:bg-pink-600 transition">
                    Copy
                </button>
            </div>

            <p class="text-xs text-gray-400 text-center">
                Link otomatis aman untuk WhatsApp
            </p>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        const baseUrl = "{{ url('/share') }}";

        function generateLink() {
            const name = document.getElementById('guestName').value.trim();
            if (!name) return;

            const encoded = encodeURIComponent(name);
            document.getElementById('inviteLink').value =
                `${baseUrl}?to=${encoded}`;
        }

        function copyLink() {
            const input = document.getElementById('inviteLink');
            if (!input.value) return;

            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);

            alert('Link berhasil disalin 👍');
        }
    </script>
@endpush
