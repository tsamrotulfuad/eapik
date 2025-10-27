@extends('welcome')
@section('title', 'Infografis - Bappelitbangda Kota Pasuruan')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">{{ $breadcrump }}</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">{{ $breadcrump }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ $breadcrump }}</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">

        @foreach ($infografis as $data)
          <div class="mb-3 h-100 mx-3" style="max-width: 70%;">
            <div class="row g-0">
              <div class="col-md-4">
                @if (!empty($data->file_infografis))
                  <img src="{{ asset('storage/' . $data->file_infografis[0]) }}" 
                    class="img-fluid rounded-start" 
                    style=" object-fit: cover; cursor: pointer;" 
                    height="120px" 
                    data-bs-toggle="modal"  
                    data-bs-target="#galleryModal-{{ $data->id }}">
                 @endif
                <div class="mt-3">
                  <a href="{{ route('infografis.show',  $data->slug) }}" class="text-decoration-none text-black">
                     <p class="text-center">{{ $data->nama_infografis }}</p>
                  </a>
                </div>
              </div>
              {{-- Modal untuk setiap Infografis --}}
              <div class="modal fade" id="galleryModal-{{ $data->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0 shadow-none">
                        {{-- <div class="modal-header">
                            <h5 class="modal-title">Galeri {{ $data->nama_infografis }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div> --}}
                        <div class="modal-body">

                            {{-- 🎠 Carousel --}}
                            <div id="carouselProduct-{{ $data->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($data->file_infografis as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image) }}" class="d-block w-75 mx-auto rounded" alt="">
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Tombol navigasi --}}
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct-{{ $data->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct-{{ $data->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
          </div>
          
        @endforeach
      </div>
      
    </section><!-- /Starter Section Section -->
@endsection