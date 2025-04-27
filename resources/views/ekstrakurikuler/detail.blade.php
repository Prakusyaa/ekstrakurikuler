@section('title', $ekskul->nama . ' - SMKN 5 SKA')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ekstrakurikuler {{ __($ekskul->nama) }}
            </h2>

            @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                <div class="flex gap-2">
                    <a href="{{ route('ekstrakurikuler.edit', $ekskul->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('berita.create', $ekskul->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Berita
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="confirmForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Deskripsi Ekstrakurikuler -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Guru Pembimbing</h3>
                    </div>
                    <p class="text-gray-600 ml-8">{{ $ekskul->guru_pembimbing }}</p>
                    
                    <div class="mt-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Deskripsi</h3>
                        </div>
                        <p class="text-gray-600 ml-8">{{ $ekskul->deskripsi }}</p>
                    </div>
                </div>
            </div>

            <!-- Berita Ekstrakurikuler -->
            @if ($ekskul->berita->isNotEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Berita Terbaru</h3>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach ($ekskul->berita as $berita)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-lg font-medium text-gray-900">{{ $berita->judul }}</h4>
                                        @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                                            <div class="flex gap-2">
                                                <a href="{{ route('berita.edit', $berita) }}" 
                                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <button type="button" 
                                                        onclick="showDeleteModal('{{ route('berita.destroy', $berita) }}', 'Apakah Anda yakin ingin menghapus berita ini?')"
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mt-1">{{ $berita->konten }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>{{ $berita->user->name }}</span>
                                        <span class="mx-2">•</span>
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Daftar Anggota -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Anggota</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                                    @if (Auth::user()->role == 'guru')
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($member as $anggota)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span class="text-gray-500 font-medium">{{ substr($anggota->nama, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $anggota->nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $anggota->created_at->format('d M Y') }}
                                        </td>
                                        @if (Auth::user()->role == 'guru')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <button type="button" 
                                                        onclick="showDeleteModal('{{ route('keluarkan.ekstrakurikuler', ['id' => $ekskul->id, 'uid' => $anggota->user_id]) }}', 'Apakah Anda yakin ingin mengeluarkan anggota ini?')"
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Keluarkan
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(action, message) {
            const modal = document.getElementById('confirmModal');
            const modalMessage = document.getElementById('modalMessage');
            const form = document.getElementById('confirmForm');
            
            modalMessage.textContent = message;
            form.action = action;
            
            // Inisialisasi modal Bootstrap
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        }
    </script>

    <style>
        .modal {
            z-index: 1050;
        }
        .modal-backdrop {
            z-index: 1040;
        }
    </style>
</x-app-layout>

<style>
.content-wrapper {
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: flex-start;
  padding-bottom: 2rem;
  margin-top: 2rem;
}

.ekskul-description {
  background-color: white;
  width: calc(100% - 4rem);
  max-width: 100vw;
  padding: 20px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  height: max-content;
}

.ekskul-description p {
  font-size: calc(1vw + 0.7rem);
}

.section-title {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 10px 20px;
  width: max-content;
  height: max-content;
  margin-top: 1rem;
  margin-left: 2rem;
  background-color: white;
  font-size: calc(1vw + 0.7rem);
  font-weight: bold;
}

.members-table {
  background-color: white;
  width: calc(100% - 4rem);
  max-width: 100vw;
  padding: 20px;
  padding-bottom: 5px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  height: max-content;
}

.members-table th {
  font-size: calc(1vw + 0.5rem);
}

.news-container {
  margin: 0 auto;
  background-color: white;
  width: calc(100% - 4rem);
  height: 200px;
  overflow: auto;
}

.news-card {
  border-radius: 0px !important;
}
</style>