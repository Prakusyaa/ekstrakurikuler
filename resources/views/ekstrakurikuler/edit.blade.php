@section('title', 'Edit Ekstrakurikuler - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ekstrakurikuler') }}
        </h2>
    </x-slot>

    <!-- form -->
    <form action="{{ route('ekstrakurikuler.update', $ekskul->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-container">
            <!-- input nama -->
            <div class="form-group" style="width: 30%;">
                <x-input-label for="nama" :value="__('Nama Ekstrakurikuler:')" />
                <x-text-input id="nama" class="block mt-1 w-full shadow" type="text" name="nama" :value="old('nama', $ekskul->nama)" required autofocus />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
            <div class="form-group" style="width: 30%;">
                <x-input-label for="pembimbing" :value="__('Guru Pembimbing:')" />
                <x-text-input id="pembimbing" class="block mt-1 w-full shadow" type="text" name="pembimbing" :value="old('pembimbing', $ekskul->guru_pembimbing)" required />
                <x-input-error :messages="$errors->get('pembimbing')" class="mt-2" />
            </div>
            <div class="form-group" style="width: 100%;">
                <x-input-label for="deskripsi" :value="__('Deskripsi Ekstrakurikuler:')" />
                <textarea class="form-control shadow-sm" id="deskripsi" name="deskripsi" rows="8" required>{{ old('deskripsi', $ekskul->deskripsi) }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>
        </div>

        <!-- button -->
        <div class="button-container">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="btn btn-danger">Kembali</a>
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