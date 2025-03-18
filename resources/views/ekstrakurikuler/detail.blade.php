@section('title', $ekskul->nama . ' - SMKN 5 SKA')

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ekstrakurikuler {{ __($ekskul->nama) }}
    </h2>
  </x-slot>

    <!-- card container -->
    <div class="card-container">

      <!-- deskripsi ekstrakurikuler -->
      <div class="description-container shadow rounded">
          <b>G. Pembimbing: {{ $ekskul->guru_pembimbing }}</b>
          <p class="mt-2">{{ $ekskul->deskripsi }}</p>
      </div>

      <!-- title table -->
      <div class="title-container shadow rounded">
        <p><b>Angota Ekstrakurikuler {{ $ekskul->nama }}</b></p>
      </div>

      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">

          <div class="card carousel-item">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment 1</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>

          <div class="card carousel-item">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment 1</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>

          <div class="card carousel-item">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment 1</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- table -->
      <div class="table-container shadow rounded">
        <table class="table table-fixed table-hover">
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal bergabung</th>
            @if (Auth::user()->role == 'guru')
            <th scope="col">Interaksi</th>
            @endif
          </tr>
          @foreach ($member as $anggota)
          <tr>
              <th> {{ $anggota->nama }} </th>
              <th> {{ $anggota->created_at->format('d-m-Y') }} </th>
              @if (Auth::user()->role == 'guru')
              <th>
                @csrf
                  <button type="button" class="btn btn-danger btn-sm w-100 text-wrap">Keluarkan</button>
              </th>          
              @endif
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    
</x-app-layout>

<style>
  /* carousel */
  .carousel-inner img {
      height: 40vw;
      object-fit: cover;
      object-position: top;
  }

  /* card */
  .card-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: flex-start;
      padding-bottom: 2rem;
      margin-top: 2rem;
  }

  .description-container {
    background-color: #FFFFFF;
    width: calc(100% - 4rem);
    max-width: 100vw;
    padding: 20px;
    margin: 0rem auto 0rem auto;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    height: max-content;
}

.description-container p {
  font-size: calc(1vw + 0.7rem);
}

/* table card */
.title-container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 10px 20px;
  width: max-content;
  height: max-content;
  margin-top: 1rem;
  margin-left: 2rem;
  background-color: #FFFFFF;
  font-size: calc(1vw + 0.7rem);
  font-weight: bold;
}

.table-container {
  background-color: #FFFFFF;
  width: calc(100% - 4rem);
  max-width: 100vw;
  padding: 20px;
  padding-bottom: 5px;
  margin: 0rem auto 0rem auto;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  height: max-content;
}

.table-container th {
  font-size: calc(1vw + 0.5rem);;
}
</style>