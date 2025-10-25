@extends('welcome')
@section('title', 'e-APIK - Bappelitbangda Kota Pasuruan')
@section('content')
<!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h4>Kajian Daerah</h4>
        <h5><b>"{{ $kajian->nama_kajian }}"</b></h5>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{ asset('storage/' . $kajian->cover_kajian) }}" class="mx-auto d-block" width="280px" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $kajian->nama_kajian }}</h5>
                <p class="card-text mt-2">{{ $kajian->ringkasan_kajian }}</p>
                <p class="card-text">{{ $kajian->bidang->nama_bidang }}</p>
                <p class="card-text"><small class="text-body-secondary">{{ $kajian->tahun_kajian }}</small></p>
                <a href="{{ $kajian->kajian_link }}" class="btn btn-primary">Review</a>
              </div>
            </div>
          </div>
          </a>
      </div>
    </section><!-- /Starter Section Section -->
@endsection