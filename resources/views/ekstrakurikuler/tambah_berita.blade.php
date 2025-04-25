@section('title', 'Tambah Berita - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Berita Ekstrakurikuler {{ __($ekstrakurikuler->nama) }}
        </h2>
    </x-slot>

    <!-- form -->
    <form action="{{ route('berita.store', $ekstrakurikuler->id) }}" method="POST">
        @csrf
        <div class="form-container">
            <!-- input judul -->
            <div class="form-group" style="width: 100%;">
                <x-input-label for="judul" :value="__('Judul Berita:')" />
                <x-text-input id="judul" class="block mt-1 w-full shadow" type="text" name="judul" :value="old('judul')" required autofocus />
                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
            </div>
            <div class="form-group" style="width: 100%;">
                <x-input-label for="konten" :value="__('Isi Berita:')" />
                <textarea class="form-control shadow-sm" id="konten" name="konten" rows="8" required>{{ old('konten') }}</textarea>
                <x-input-error :messages="$errors->get('konten')" class="mt-2" />
            </div>
        </div>

        <!-- button -->
        <div class="button-container">
            <button type="submit" class="btn btn-primary">Tambahkan</button>
            <a href="{{ route('ekstrakurikuler.detail', $ekstrakurikuler->id) }}" class="btn btn-danger">Kembali</a>
        </div>
    </form>
</x-app-layout>

<style>
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0 2rem;
        margin-top: 2rem;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .button-container {
        display: flex;
        gap: 1rem;
        padding: 0 2rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #2563EB;
        color: white;
    }

    .btn-danger {
        background-color: #DC2626;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style> 