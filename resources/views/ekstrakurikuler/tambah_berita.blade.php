@section('title', 'Tambah Berita - EkstrakurikulerKu.id')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Berita Ekstrakurikuler {{ __($ekstrakurikuler->nama) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="news-add-page">
                        <div class="add-header mb-6">
                            <h2 class="page-title text-2xl font-bold text-gray-800">Tambah Berita Ekstrakurikuler {{ __($ekstrakurikuler->nama) }}</h2>
                        </div>

                        <div class="add-form-container bg-white p-6 rounded-lg shadow">
                            <form action="{{ route('berita.store', $ekstrakurikuler->id) }}" method="POST" class="add-form space-y-6">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="judul" class="form-label block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                                    <div class="input-group relative">
                                        <i class="fas fa-heading input-icon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" 
                                               name="judul" 
                                               id="judul" 
                                               value="{{ old('judul') }}"
                                               class="form-input block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                               required autofocus>
                                    </div>
                                    @error('judul')
                                        <span class="error-message text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="konten" class="form-label block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
                                    <div class="input-group">
                                        <textarea name="konten" 
                                                  id="konten" 
                                                  rows="8"
                                                  class="form-textarea block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                  required>{{ old('konten') }}</textarea>
                                    </div>
                                    @error('konten')
                                        <span class="error-message text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-actions flex justify-end space-x-4">
                                    <a href="{{ route('ekstrakurikuler.detail', $ekstrakurikuler->id) }}" 
                                       class="btn-cancel inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i> Batal
                                    </a>
                                    <button type="submit" 
                                            class="btn-save inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-plus mr-2"></i> Tambahkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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