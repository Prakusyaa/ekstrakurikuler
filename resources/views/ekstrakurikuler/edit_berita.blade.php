@section('title', 'Edit Berita - EkstrakurikulerKu.id')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Berita
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="news-edit-page">
                        <div class="edit-header mb-6">
                            <h2 class="page-title text-2xl font-bold text-gray-800">Edit Berita</h2>
                        </div>

                        <div class="edit-form-container bg-white p-6 rounded-lg shadow">
                            <form action="{{ route('berita.update', $berita) }}" method="POST" class="edit-form space-y-6">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="judul" class="form-label block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                                    <div class="input-group relative">
                                        <i class="fas fa-heading input-icon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" 
                                               name="judul" 
                                               id="judul" 
                                               value="{{ old('judul', $berita->judul) }}"
                                               class="form-input block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                               required>
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
                                                  rows="6"
                                                  class="form-textarea block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                  required>{{ old('konten', $berita->konten) }}</textarea>
                                    </div>
                                    @error('konten')
                                        <span class="error-message text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-actions flex justify-end space-x-4">
                                    <a href="{{ route('ekstrakurikuler.detail', $berita->ekstrakurikuler->id) }}" 
                                       class="btn-cancel inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-times mr-2"></i> Batal
                                    </a>
                                    <button type="submit" 
                                            class="btn-save inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
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