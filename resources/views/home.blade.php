@extends('welcome')
@section('title', 'e-APIK - Bapperida Kota Pasuruan')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <h1>e-APIK</h1>
                    <p>Sistem Informasi Terpadu Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah Kota Pasuruan</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Mulai</a>
                        <a href="#" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

        <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">

            <h2>Layanan Kami</h2>
            <p>Berikut Beberapa Layanan yang ada di e-APIK Bapperida Kota Pasuruan</p>
        </div><!-- End Section Title -->

        <div class="container">
            
            <div class="row gy-4 mb-3">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <a href="/perencanaan" class="stretched-link">
                            <h3>Perencanaan Pembangunan</h3>
                        </a>
                        <p>Data Perencanaan Pembangunan Kota Pasuruan</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-activity"></i>
                        </div>
                        <a href="/kemiskinan" class="stretched-link">
                            <h3>Kemiskinan</h3>
                        </a>
                        <p>Data Kemiskinan Kota Pasuruan</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-broadcast"></i>
                        </div>
                        <a href="/kajian" class="stretched-link">
                            <h3>BRIDA</h3>
                        </a>
                        <p>Daftar Inovasi dan Kajian Kota Pasuruan</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

            <div class="row text-center mb-3 ">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <a href="/rekakarsacipta" class="stretched-link">
                            <h3>Reka Karsa Cipta</h3>
                        </a>
                        <p>Lomba Inovasi Daerah Kota Pasuruan</p>
                    </div>
                </div><!-- End Service Item -->
            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/portfolio/product-3.jpg" class="img-fluid" alt="">
                    <a href="#" class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Melalui e-APIK :</h3>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Memetakan kondisi kemiskinan.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Menyusun perencanaan program.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Memonitor capaian kinerja dan inovasi.</span></li>
                    </ul>
                    <p>
                        Dengan pendekatan digital dan analisis berbasis data, e-APIK hadir sebagai solusi inovatif dalam mewujudkan perencanaan yang lebih akurat, transparan, dan berkeadilan untuk Pasuruan yang lebih sejahtera.
                    </p>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Dokumen</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Perencanaan</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="129" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Inovasi</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="39" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Pegawai</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Konsultasi Perencanaan ? atau Riset dan Inovasi ?</h3>
                        <p></p>
                        <a class="cta-btn" href="#">Kontak Kami</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Konsultasi Perihal <b><i>Perencanaan Pembangunan Perangkat Daerah</i></b> atau <b><i>Perihal Riset dan Inovasi Daerah</i></b> silahkan kontak kami dibawah ini</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-5">

                    <div class="info-wrap">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>Jalan Sultan Agung No. 32 Kota Pasuruan</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Hubungi Kami</h3>
                                <p>(0343) 426919</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Kami</h3>
                                <p>bappelitbangda@pasuruankota.go.id</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.192284913654!2d112.90022087594546!3d-7.6624650758291395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7cf5582d7bc5b%3A0xfcadb12f9b666463!2sBAPPEDA%20Kota%20Pasuruan!5e0!3m2!1sen!2sid!4v1759211045734!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div><!-- End Info Item -->
                    </div>
                </div>

                <div class="col-lg-7">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <label for="name-field" class="pb-2">Your Name</label>
                                <input type="text" name="name" id="name-field" class="form-control" required="">
                            </div>

                            <div class="col-md-6">
                                <label for="email-field" class="pb-2">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email-field" required="">
                            </div>

                            <div class="col-md-12">
                                <label for="subject-field" class="pb-2">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject-field" required="">
                            </div>

                            <div class="col-md-12">
                                <label for="message-field" class="pb-2">Message</label>
                                <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection