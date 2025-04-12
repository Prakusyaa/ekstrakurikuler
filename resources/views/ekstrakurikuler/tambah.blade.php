@section('title', 'Dashboard - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Ekstrakurikuler') }}
        </h2>
    </x-slot>

    <!-- form -->
    <div class="form-container">
        <!-- input nama -->
        <div style="width: 30%;">
            <x-input-label for="name" :value="__('Nama Ekstrakurikuler:')" />
            <x-text-input id="name" class="block mt-1 w-full shadow" type="text" name="name" :value="old('name')" required autofocus autocomplete="nama ekstrakurikuler" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div style="width: 30%;">
            <x-input-label for="pembimbing" :value="__('Guru Pembimbing:')" />
            <x-text-input id="pembimbing" class="block mt-1 w-full" type="text" name="pembimbing" :value="old('pembimbing')" required autofocus autocomplete="guru pembimbing" />
            <x-input-error :messages="$errors->get('pembimbing')" class="mt-2" />
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="deskripsi" class="form-label">Deskripsi Ekstrakurikuler:</label>
            <textarea class="form-control shadow-sm" id="deskripsi" rows="8"></textarea>
        </div>
    </div>

    <!-- button -->
    <div class="button-container d-flex flex-row">
        <button type="button" class="btn btn-primary">Tambahkan</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('ekstrakurikuler') }}'">Kembali</button>
    </div>
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

    .button-container {
        padding: 0 2rem;
        margin-top: 2rem;
        gap: 1rem;
        padding-bottom: 1rem;
    }
</style>
