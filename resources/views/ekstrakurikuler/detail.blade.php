@section('title', $ekskul->nama . ' - SMKN 5 SKA')

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
    }

    .description-container-title {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 10px 20px;
        width: max-content;
        height: max-content;
        margin-top: 2rem;
        margin-left: 2rem;
        background-color: #FFFFFF;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .description-container-title p {
        font-size: calc(1vw + 1rem);
        font-weight: bold;
    }

    .description-container {
      background-color: #FFFFFF;
      width: calc(100% - 4rem);
      max-width: 100vw;
      padding: 20px;
      margin: 1rem auto 2rem auto;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      height: max-content;
  }

  .description-container p{
    font-size: calc(1vw + 0.7rem);
  }
</style>

<x-app-layout>
    <!-- carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner shadow-sm">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{ asset('carousel-test.png') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="{{ asset('carousel-test1.png') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('carousel-test.png') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- card container -->
    <div class="card-container">

      <!-- nama ekstra -->
      <div class="description-container-title shadow rounded">
          <p><b>{{ ('Ekstrakurikuler ' . $ekskul->nama) }}</b></p>
      </div>

      <!-- deskripsi ekstrakurikuler -->
      <div class="description-container shadow rounded">
          <b>G. Pembimbing: {{ $ekskul->guru_pembimbing }}</b>
          <p class="mt-2">{{ $ekskul->deskripsi }}</p>
      </div>

      <!-- anggota -->
    </div>
    
</x-app-layout>
