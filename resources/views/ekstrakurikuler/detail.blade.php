{{-- 
    File: detail.blade.php
    Deskripsi: Halaman detail ekstrakurikuler yang menampilkan informasi lengkap, berita, dan daftar anggota
    Author: Tim Pengembang
    Tanggal: 2024
--}}

@section('title', $ekskul->nama . ' - EkstrakurikulerKu.id')

<x-app-layout>
    {{-- Header Section - Menampilkan judul dan tombol aksi --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ekstrakurikuler {{ __($ekskul->nama) }}
            </h2>

            {{-- Tombol Aksi untuk Guru dan Admin --}}
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

    {{-- Modal Konfirmasi - Digunakan untuk konfirmasi penghapusan --}}
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

    {{-- Main Content Section --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="ekskul-detail-page">
                        <div class="ekskul-content space-y-6">
                            {{-- Informasi Ekstrakurikuler --}}
                            <div class="ekskul-info">
                                <div class="space-y-6">
                                    {{-- Informasi Guru Pembimbing --}}
                                    <div class="info-section">
                                        <div class="info-header flex items-center gap-2 mb-2">
                                            <i class="fas fa-user-tie text-gray-500"></i>
                                            <h3 class="text-lg font-semibold text-gray-800">Guru Pembimbing</h3>
                                        </div>
                                        <p class="info-text text-gray-600">{{ $ekskul->guru_pembimbing }}</p>
                                    </div>

                                    {{-- Deskripsi Ekstrakurikuler --}}
                                    <div class="info-section">
                                        <div class="info-header flex items-center gap-2 mb-2">
                                            <i class="fas fa-info-circle text-gray-500"></i>
                                            <h3 class="text-lg font-semibold text-gray-800">Deskripsi</h3>
                                        </div>
                                        <p class="info-text text-gray-600">{{ $ekskul->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Bagian Berita --}}
                            @if ($ekskul->berita->isNotEmpty())
                                <div class="ekskul-news">
                                    <div class="news-header flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-newspaper text-gray-500"></i>
                                            <h3 class="text-lg font-semibold text-gray-800">Berita Terbaru</h3>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $ekskul->berita->count() }} Berita</span>
                                    </div>
                                    <div class="news-list space-y-4">
                                        @foreach ($ekskul->berita as $berita)
                                            {{-- Card Berita --}}
                                            <div class="news-item bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                                <div class="news-content">
                                                    <h4 class="news-title text-lg font-semibold text-gray-800 mb-2">{{ $berita->judul }}</h4>
                                                    <p class="news-text text-gray-600 mb-3 line-clamp-3">{{ $berita->konten }}</p>
                                                    <div class="news-meta flex items-center gap-4 text-sm text-gray-500">
                                                        <span class="news-author flex items-center gap-1">
                                                            <i class="fas fa-user"></i>
                                                            {{ $berita->user->name }}
                                                        </span>
                                                        <span class="news-date flex items-center gap-1">
                                                            <i class="fas fa-calendar"></i>
                                                            {{ $berita->created_at->format('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- Tombol Aksi untuk Guru dan Admin --}}
                                                @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                                                    <div class="news-actions flex gap-2 mt-4">
                                                        <a href="{{ route('berita.edit', $berita) }}" 
                                                           class="btn-edit inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            <i class="fas fa-edit mr-1"></i> Edit
                                                        </a>
                                                        <button type="button" 
                                                                class="btn-delete inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                                onclick="showDeleteModal('{{ route('berita.destroy', $berita) }}', 'Apakah Anda yakin ingin menghapus berita ini?')">
                                                            <i class="fas fa-trash mr-1"></i> Hapus
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Bagian Daftar Anggota --}}
                            <div class="ekskul-members">
                                <div class="members-header flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-users text-gray-500"></i>
                                        <h3 class="text-lg font-semibold text-gray-800">Daftar Anggota</h3>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $member->count() }} Anggota</span>
                                </div>
                                <div class="members-table overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        {{-- Header Tabel --}}
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                                                @if (Auth::user()->role == 'guru')
                                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        {{-- Isi Tabel --}}
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($member as $anggota)
                                                <tr class="member-row hover:bg-gray-50 transition-colors duration-200">
                                                    {{-- Kolom Nama --}}
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="member-info flex items-center">
                                                            <div class="member-avatar flex-shrink-0 h-10 w-10">
                                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                                    <span class="text-gray-600 font-medium">{{ substr($anggota->nama, 0, 1) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="member-name text-sm font-medium text-gray-900">{{ $anggota->nama }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- Kolom Tanggal Bergabung --}}
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="join-date text-sm text-gray-500">{{ $anggota->created_at->format('d M Y') }}</div>
                                                    </td>
                                                    {{-- Kolom Aksi untuk Guru --}}
                                                    @if (Auth::user()->role == 'guru')
                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                            <button type="button" 
                                                                    class="btn-remove inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                                    onclick="showDeleteModal('{{ route('keluarkan.ekstrakurikuler', ['id' => $ekskul->id, 'uid' => $anggota->user_id]) }}', 'Apakah Anda yakin ingin mengeluarkan anggota ini?')">
                                                                <i class="fas fa-user-minus mr-1"></i> Keluarkan
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
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Modal Konfirmasi --}}
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

    {{-- Style untuk Modal --}}
    <style>
        .modal {
            z-index: 1050;
        }
        .modal-backdrop {
            z-index: 1040;
        }
    </style>
</x-app-layout>

{{-- Style untuk Layout --}}
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
}
</style>