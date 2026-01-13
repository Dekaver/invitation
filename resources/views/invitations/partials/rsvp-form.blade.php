{{-- RSVP Section --}}
<div class="relative py-24 bg-purple-50">

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

{{-- Tampilkan pesan pesan --}}

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
