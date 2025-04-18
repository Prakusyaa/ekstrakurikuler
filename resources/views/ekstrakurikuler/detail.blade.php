@section('title', $ekskul->nama . ' - SMKN 5 SKA')

<x-app-layout>
  <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Ekstrakurikuler {{ __($ekskul->nama) }}
      </h2>

      @if (Auth::user()->role == 'guru')
        <div class="d-flex gap-2">
          <a href="{{ route('ekstrakurikuler.edit', $ekskul->id) }}" class="btn btn-warning">Edit</a>
          <a href="{{ route('ekstrakurikuler', $ekskul->id) }}" class="btn btn-primary">Tambah Berita</a>
        </div>
      @endif
    </div>
  </x-slot>

    <div class="content-wrapper">

      <div class="ekskul-description shadow rounded">
          <b>G. Pembimbing: {{ $ekskul->guru_pembimbing }}</b>
          <p class="mt-2">{{ $ekskul->deskripsi }}</p>
      </div>

      @if ($ekskul->berita->isNotEmpty())
      <div class="section-title shadow rounded">
        <p><b>Berita Ekstrakurikuler {{ $ekskul->nama }}</b></p>
      </div>

      <div class="news-container shadow rounded">
          @foreach ($ekskul->berita as $berita)
          <div class="news-card card">
              <div class="card-body">
                  <h5><b>{{ $berita->judul }}</b></h5>
                  <p>{{ $berita->konten }}</p>
                  <small>Dibuat oleh: {{ $berita->user->name }}</small>
                  <br>
                  <small>Dibuat pada tanggal: {{ $berita->created_at->format('d-m-y') }}</small>
              </div>
          </div>
          @endforeach
      </div>
      @endif

      <div class="section-title shadow rounded">
        <p><b>Anggota Ekstrakurikuler {{ $ekskul->nama }}</b></p>
      </div>

      <div class="members-table shadow rounded">
        <table class="table table-fixed table-hover">
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal Bergabung</th>
            @if (Auth::user()->role == 'guru')
            <th scope="col">Interaksi</th>
            @endif
          </tr>
          @foreach ($member as $anggota)
              <tr>
                  <th>{{ $anggota->nama }}</th>
                  <th>{{ $anggota->created_at->format('d-m-Y') }}</th>
                  @if (Auth::user()->role == 'guru')
                      <th>
                        <form action="{{ route('keluarkan.ekstrakurikuler', ['id' => $ekskul->id, 'uid' => $anggota->user_id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm w-100 text-wrap">Keluarkan</button>
                        </form> 
                      </th>
                  @endif
              </tr>
          @endforeach
        </table>
      </div>
    </div>
    
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