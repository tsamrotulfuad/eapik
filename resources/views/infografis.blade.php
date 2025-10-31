@extends('welcome')
@section('title', 'Infografis - Bappelitbangda Kota Pasuruan')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $breadcrump }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Home</a></li>
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

        <div class="container mb-4" data-aos="fade-up">
            <h6 class="mb-2 text-center">Pencarian</h6>

            <!-- Form Pencarian -->
            <div class="card-body text-center">
                <form id="searchForm" class="d-inline-block" style="max-width: 400px; width: 100%;">
                    <div class="input-group input-group-md">
                        <input type="text" id="searchInput" name="search" 
                            class="form-control form-control-md" 
                            placeholder="Ketik kata kunci...">
                        <button class="btn btn-success btn-md" type="submit">Cari</button>
                    </div>
                </form>
            </div>

            <!-- Hasil Pencarian -->
            <div id="resultContainer" class="mt-3 d-none">
                <div class="card-body" id="results"></div>
            </div>
        </div>

        <div class="container px-3 text-left" data-aos="fade-up">
            <div class="row g-2">
                @foreach ($infografis as $data)
                    <div class="col-6">
                        <div class="p-3">
                            <div class="card mb-3 h-100" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        @if (!empty($data->file_infografis))
                                            <img src="{{ asset('storage/' . $data->file_infografis[0]) }}"
                                                class="rounded-start" style="cursor: pointer;" height="240px"
                                                data-bs-toggle="modal" data-bs-target="#galleryModal-{{ $data->id }}">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="px-2">
                                                <a href="{{ route('infografis.show', $data->slug) }}"
                                                    class="text-decoration-none text-black">
                                                    <h5 class="card-title">{{ $data->nama_infografis }}</h5>
                                                    <p class="card-text">{{ $data->bidang->nama_bidang }}</p>
                                                    <p class="card-text"><small
                                                            class="text-body-secondary">{{ $data->tahun_infografis }}</small>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Modal untuk setiap Infografis --}}
                    <div class="modal fade" id="galleryModal-{{ $data->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-transparent border-0 shadow-none">
                                <div class="modal-body">

                                    {{-- 🎠 Carousel --}}
                                    <div id="carouselProduct-{{ $data->id }}" class="carousel slide"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($data->file_infografis as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image) }}"
                                                        class="d-block w-75 mx-auto rounded" alt="">
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Tombol navigasi --}}
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselProduct-{{ $data->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselProduct-{{ $data->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
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

@push('scripts')
<script>
    $(function () {
        // base url agar path storage benar
        const baseUrl = "{{ asset('') }}"; // contoh: https://domain.com/
        const storageBase = baseUrl + 'storage/';

        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            let search = $('#searchInput').val().trim();
            let resultContainer = $('#resultContainer');
            let results = $('#results');

            // hide results jika kosong & tampilkan kembali daftar asli
            if (search === '') {
                resultContainer.addClass('d-none');
                results.html('');
                $('.row.g-2').show();
                // hapus modal dinamis jika ada
                $('#dynamicModals').remove();
                return;
            }

            $.ajax({
                url: "{{ route('infografis.search') }}",
                method: 'GET',
                data: { search: search },
                beforeSend: function() {
                    results.html('<p class="text-muted text-center">🔍 Mencari...</p>');
                    resultContainer.removeClass('d-none');
                    $('.row.g-2').hide(); // sembunyikan daftar utama
                    // hapus modal dinamis lama jika ada
                    $('#dynamicModals').remove();
                },
                success: function (data) {
                    console.log('AJAX search response:', data); // debug
                    // bersihkan modal container lama
                    $('#dynamicModals').remove();

                    if (!data || data.length === 0) {
                        results.html('<p class="text-muted text-center">Tidak ada hasil ditemukan.</p>');
                        return;
                    }

                    // buat container untuk menampung modal yang akan di-inject ke body
                    const modalsWrapper = $('<div id="dynamicModals"></div>');
                    $('body').append(modalsWrapper);

                    let html = '<div class="row g-2">';

                    data.forEach(function (item, idx) {
                        // pastikan file_infografis array
                        let files = item.file_infografis || [];
                        // jika file paths tidak absolute, prefix dengan /storage/
                        let firstImage = files.length ? (files[0].startsWith('http') ? files[0] : storageBase + files[0]) : baseUrl + 'no-image.png';
                        let bidang = item.bidang && item.bidang.nama_bidang ? item.bidang.nama_bidang : '-';
                        const modalId = 'galleryModal-' + item.id + '-' + idx; // unik jika id sama muncul

                        // Card HTML (sama persis seperti card statis)
                        html += `
                            <div class="col-6">
                                <div class="p-3">
                                    <div class="card mb-3 h-100" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="${firstImage}" class="rounded-start" style="cursor:pointer;" height="240px"
                                                    data-bs-toggle="modal" data-bs-target="#${modalId}">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="px-2">
                                                        <a href="/infografis/${item.slug}" class="text-decoration-none text-black">
                                                            <h5 class="card-title">${escapeHtml(item.nama_infografis)}</h5>
                                                            <p class="card-text">${escapeHtml(bidang)}</p>
                                                            <p class="card-text"><small class="text-body-secondary">${escapeHtml(item.tahun_infografis)}</small></p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Buat modal untuk item ini (carousel jika ada banyak gambar)
                        let carouselInner = '';
                        if (files.length) {
                            files.forEach(function (f, k) {
                                let src = f.startsWith('http') ? f : storageBase + f;
                                carouselInner += `
                                    <div class="carousel-item ${k == 0 ? 'active' : ''}">
                                        <img src="${src}" class="d-block w-75 mx-auto rounded" alt="">
                                    </div>
                                `;
                            });
                        } else {
                            carouselInner = `
                                <div class="carousel-item active">
                                    <img src="${baseUrl}no-image.png" class="d-block w-75 mx-auto rounded" alt="">
                                </div>
                            `;
                        }

                        const modalHtml = `
                            <div class="modal fade" id="${modalId}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-transparent border-0 shadow-none">
                                        <div class="modal-body">
                                            <div id="carousel-${modalId}" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    ${carouselInner}
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${modalId}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-${modalId}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        modalsWrapper.append(modalHtml);
                    });

                    html += '</div>';
                    results.html(html);

                    // inisialisasi bootstrap carousel jika perlu (Bootstrap 5 auto init via data-bs-ride)
                },
                error: function (xhr, status, err) {
                    console.error('AJAX Error:', status, err, xhr.responseText);
                    results.html('<p class="text-danger text-center">Terjadi kesalahan saat mengambil data.</p>');
                }
            });
        });

        // function simple untuk escape HTML agar aman
        function escapeHtml(text) {
            if (text == null) return '';
            return $('<div>').text(text).html();
        }
    });
</script>
@endpush
