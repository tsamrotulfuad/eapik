@extends('welcome')
@section('title', 'Kajian - Bappelitbangda Kota Pasuruan')
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

      <div class="container px-3 text-left" data-aos="fade-up">
        <div class="row g-3">
          @foreach ($kajian as $data)
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="p-3">
              <a href="{{ route('kajian.show', $data->slug) }}" class="text-decoration-none text-black">
              <div class="card h-100 w-100 border-0" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-4 col-md-4">
                    <img src="{{ asset('storage/' . $data->cover_kajian) }}" class="img-fluid rounded-start w-100 uniform-img" height="240px" alt="...">
                  </div>
                  <div class="col-8 col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><strong>{{ $data->nama_kajian }}</strong></h5>
                      <p class="card-text">{{ $data->nama_bidang }}</p>
                      <p class="card-text"><small class="text-body-secondary">{{ $data->tahun_kajian }}</small></p>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        <div class="mt-3 d-flex justify-content-center">
          {{ $kajian->links() }}
        </div>
      </div>
    </section><!-- /Starter Section Section -->
@endsection

