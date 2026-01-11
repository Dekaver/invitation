@extends('admin.layout')

@section('title', 'Daftar Keinginan - ' . $wedding->groom_name . ' & ' . $wedding->bride_name)

@section('admin-content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Daftar Keinginan</h2>
                <p class="text-gray-600 mt-1">{{ $wedding->groom_name }} & {{ $wedding->bride_name }}</p>
            </div>
            <a href="{{ route('admin.weddings.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">
                ← Kembali
            </a>
        </div>

        <!-- Statistik -->
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-gray-600 text-sm">Total Keinginan</p>
            <p class="text-3xl font-bold text-gray-900">{{ $wishes->total() }}</p>
        </div>

        <!-- Daftar Wishes -->
        <div class="space-y-4">
            @forelse ($wishes as $wish)
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">dari <strong>{{ $wish->guest_name }}</strong></p>
                            <p class="text-gray-800 mt-2 leading-relaxed">{{ $wish->message }}</p>
                            <p class="text-xs text-gray-400 mt-3">
                                {{ $wish->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                        <form action="{{ route('admin.weddings.wishes.destroy', [$wedding->id, $wish->id]) }}"
                            method="POST" class="ml-4"
                            onsubmit="return confirm('Yakin ingin menghapus keinginan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    Belum ada keinginan dari tamu.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $wishes->links() }}
        </div>
    </div>
@endsection
