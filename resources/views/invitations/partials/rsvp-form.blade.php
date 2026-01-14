{{-- RSVP Section --}}
<div class="relative py-8 bg-purple-50">
    <div class="max-w-md mx-auto px-6">
        <div class="bg-white/80 backdrop-blur rounded-3xl p-8 shadow-sm border border-purple-200">

            <h3 class="text-xs tracking-[0.25em] uppercase text-purple-500 text-center mb-2">
                Konfirmasi Kehadiran
            </h3>

            <form action="{{ route('invitations.guest.store', $wedding->slug) }}" method="POST" class="space-y-2">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-2">
                        Nama Anda
                    </label>
                    <input id="name" type="text" name="name" required placeholder="Nama lengkap"
                        class="w-full text-black rounded-xl border border-purple-200 px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:outline-none"
                        readonly>
                </div>

                {{-- Kehadiran --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-2">
                        Kehadiran
                    </label>

                    <div class="flex justify-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="attendance" value="hadir" required class="text-purple-600">
                            <span class="text-sm text-gray-700">
                                Hadir
                            </span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="attendance" value="tidak_hadir" class="text-purple-600">
                            <span class="text-sm text-gray-700">
                                Tidak Hadir
                            </span>
                        </label>
                    </div>
                </div>

                {{-- Ucapan --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-2">
                        Ucapan & Doa
                    </label>
                    <textarea name="message" rows="4" placeholder="Tuliskan ucapan terbaik Anda…"
                        class="w-full text-black rounded-xl border border-purple-200 px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:outline-none"></textarea>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-3 rounded-full bg-linear-to-r from-purple-600 to-pink-600 text-white text-sm tracking-wide hover:shadow-lg transition">
                    Kirim
                </button>

            </form>
        </div>
    </div>
</div>

{{-- RSVP Message --}}
{{-- @dd($wedding->guests) --}}


{{-- Tampilkan pesan pesan --}}
<div class="relative py-2 bg-purple-50 flex flex-col items-center">
    @forelse ($guests as $guest)
        <div class="comment-box">
            <span class="name">{{ $guest->guest_name }}</span>
            <span class="status">{{ $guest->rsvp_status }}</span>
            <p>
                {{ $guest->message }}
            </p>
        </div>
    @empty
        <p class="text-sm text-gray-500">Belum ada pesan, Jadilah yang pertama</p>
    @endforelse
    {{-- paginator --}}
    {{ $guests->links('pagination::simple-tailwind') }}

</div>

@push('head')
    <style>
        .comment-box {
            position: relative;
            max-width: 80%;
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ekor balon */
        .comment-box::before {
            content: "";
            position: absolute;
            left: 18px;
            top: -8px;
            width: 16px;
            height: 16px;
            background: #ffffff;
            transform: rotate(45deg);
            box-shadow: -3px -3px 8px rgba(0, 0, 0, 0.04);
        }

        /* nama & status */
        .comment-box .name {
            font-weight: 600;
            font-size: 14px;
            color: #222;
        }

        .comment-box .status {
            font-size: 13px;
            color: #777;
            margin-left: 6px;
        }

        /* isi pesan */
        .comment-box p {
            margin-top: 6px;
            font-size: 15px;
            line-height: 1.5;
            color: #111;
        }
    </style>
@endpush

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            confirmButtonText: 'OK'
        });
    </script>
@endif

@push('scripts')
    <script>
        const params = new URLSearchParams(window.location.search);
        const guest = params.get("to");

        if (guest) {
            var name = document.querySelector('input[name="name"]');
            document.getElementById("name").value = decodeURIComponent(guest.replace(/\+/g, " "));
        }
    </script>
@endpush
