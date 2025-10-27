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
        <div class="row g-2">
          @foreach ($kajian as $data)
          <div class="col-6">
            <div class="p-3">
              <div class="card mb-3 h-100" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset('storage/' . $data->cover_kajian) }}" class="rounded-start" height="240px" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><strong>{{ $data->nama_kajian }}</strong></h5>
                      <p class="card-text">{{ $data->nama_bidang }}</p>
                      <p class="card-text"><small class="text-body-secondary">{{ $data->tahun_kajian }}</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- /Starter Section Section -->
@endsection

