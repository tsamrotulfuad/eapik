@extends('welcome')
@section('title', 'Infografis - Bappelitbangda Kota Pasuruan')
@section('content')
<!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h4>Infografis</h4>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">
          <div class="row g-0">
            <div class="col-md-4">
                @if (!empty($infografis->file_infografis))
                  <img src="{{ asset('storage/' . $infografis->file_infografis[0]) }}" height="450px">
                @endif
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <div class="card-title display-6 fw-bold">{{ $infografis->nama_infografis }}</div>
                <p class="card-text"><small class="text-body-secondary">Tanggal Publikasi : {{ Carbon\Carbon::parse($infografis->tanggal_publikasi)->isoFormat('D MMMM YYYY') }} | {{ number_format($infografis->views) }} kali dilihat</small></p>
                <p class="card-text">{{ $infografis->deskripsi_infografis }}</p>
                <p class="card-text"><small class="text-body-secondary">Kategori : {{ $infografis->kategori }}, Tags : #{!! implode('#', $infografis->tag) !!}</small></p>
                <p class="card-text"><small class="text-body-secondary">Sumber data Kajian : <a href="{{ route('kajian.show',  $infografis->kajian->slug ) }}"> {{ $infografis->kajian->nama_kajian }} </a></small></p>
                <a href="{{ $infografis->kajian->kajian_link }}" class="btn btn-primary">Unduh Kajian</a>
                <a href="{{ $infografis->kajian->kajian_link }}" class="btn btn-primary">Unduh Infografis</a>
                <div class="mt-4">Bagikan dengan :</div>
                <div class="share-buttons fa-2x"> 
                    {{-- langsung render tombol dari package --}}
                    {!! Share::page(
                            route('infografis.show', $infografis->slug),
                            $infografis->nama_infografis
                        )
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->whatsapp() !!}
                </div>
                <div id="disqus_thread"></div>
                <script>
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://eapik.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
              </div>
            </div>
          </div>
          </a>
      </div>
    </section><!-- /Starter Section Section -->
@endsection
