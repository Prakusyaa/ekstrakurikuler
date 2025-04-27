@section('title', 'Tambah Ekstrakurikuler - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Ekstrakurikuler') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('ekstrakurikuler.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Nama Ekstrakurikuler -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Ekstrakurikuler')" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <x-text-input id="nama" class="block mt-1 w-full pl-10" type="text" name="nama" :value="old('nama')" required autofocus />
                            </div>
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Guru Pembimbing -->
                        <div>
                            <x-input-label for="pembimbing" :value="__('Guru Pembimbing')" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <x-text-input id="pembimbing" class="block mt-1 w-full pl-10" type="text" name="pembimbing" :value="old('pembimbing')" required />
                            </div>
                            <x-input-error :messages="$errors->get('pembimbing')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi Ekstrakurikuler')" />
                            <div class="mt-1">
                                <textarea id="deskripsi" name="deskripsi" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('deskripsi') }}</textarea>
                            </div>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('ekstrakurikuler') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambahkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
