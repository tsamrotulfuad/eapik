<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Reka Karsa Cipta</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('logo/favicon.ico')}}" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('rkc/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rkc/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('rkc/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('rkc/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('rkc/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('rkc/assets/css/main.css') }}" rel="stylesheet">
    <style>
        .timer {
            font-size: 24px;
            text-align: center;
            color: #090081ff;
            padding: 15px; /* Add some padding */
            border: 2px solid #0a0099ff; /*Border color and thickness */
            border-radius: 5px; /* Rounded corners */
            background-color: rgba(255, 255, 255, 0.1); /* Slightly transparent background */
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('rkc') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Reka Karsa Cipta</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="{{ asset('rkc/assets/img/hero-bg-2.jpg') }}" alt="" class="hero-bg">

            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ asset('rkc/assets/img/hero-img.webp') }}" class="img-fluid animated" alt="">
                    </div>

                    <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                        <h1>Tunjukkan Karya Inovasimu di <span>Reka Karsa Cipta</span></h1>
                        <p>"Lomba Inovasi Daerah Kota Pasuruan"</p>
                        <div class="d-flex">
                            <a href="#lomba-rkc" class="btn-get-started">Mulai</a>
                            <!-- <a href="#" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Video</span></a> -->
                        </div>
                    </div>

                </div>
            </div>

            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3"></use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0"></use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->

        <section id="features" class="features section">

            <div class="container text-center">
                <h4>Hitung Mundur Pengisian</h4>
                <h4>REKA KARSA CIPTA 2025</h4>
            </div>

            <div class="container text-center mt-2 timer">
                <div id="countdown">
                </div>
            </div>

        </section>

        <!-- About Section -->
        <section id="lomba-rkc" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-xl-center gy-5">

                    <div class="col-xl-5 content">
                        <h2>Lomba Inovasi Daerah</h2>
                        <br>
                        <h5>"Wujudkan Kota Pasuruan yang Kreatif dan Inovatif melalui Lomba Inovasi Daerah 2025!"</h5>
                    </div>

                    <div class="col-xl-7">
                        <div class="row gy-4 icon-boxes">

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box">
                                    <a href="https://eapik.pasuruankota.go.id/rekakarsacipta/perangkatdaerah">
                                        <i class="bi bi-buildings"></i>
                                        <h3>Tata Kelola dan Pelayanan Publik </h3>
                                        <p>Perangkat Daerah (PD), Unit Pelaksana Teknis (UPT) Kesehatan, Kecamatan, Kelurahan</p>
                                    </a>
                                </div>
                            </div> <!-- End Icon Box -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <a href="https://eapik.pasuruankota.go.id/rekakarsacipta/rekakarsacipta/masyarakat">
                                        <i class="bi bi-people"></i>
                                        <h3>Masyarakat</h3>
                                        <p>Individu, Kelompok / Komunitas, Lembaga / Organisasi</p>
                                    </a>
                                </div>
                            </div> <!-- End Icon Box -->


                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <a href="https://eapik.pasuruankota.go.id/rekakarsacipta/perangkatdaerah">
                                        <i class="bi bi-people"></i>
                                        <h3>Pendidikan</h3>
                                        <p>Kelompok Satuan Pendidikan mulai dari PAUD / TK / SD dan SMP</p>
                                    </a>
                                </div>
                            </div> <!-- End Icon Box -->

                        </div>
                    </div>

                </div>
            </div>

        </section><!-- /About Section -->

        <!-- Features Section -->
        <!-- <section id="features" class="features section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="features-item">
                            <i class="bi bi-eye" style="color: #ffbb2c;"></i>
                            <h3><a href="" class="stretched-link">Lorem Ipsum</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="features-item">
                            <i class="bi bi-infinity" style="color: #5578ff;"></i>
                            <h3><a href="" class="stretched-link">Dolor Sitema</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="features-item">
                            <i class="bi bi-mortarboard" style="color: #e80368;"></i>
                            <h3><a href="" class="stretched-link">Sed perspiciatis</a></h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="features-item">
                            <i class="bi bi-nut" style="color: #e361ff;"></i>
                            <h3><a href="" class="stretched-link">Magni Dolores</a></h3>
                        </div>
                    </div>

                </div>

            </div>

        </section> -->
        <!-- /Features Section -->
    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Reka Karsa Cipta</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Sultan Agung No. 32</p>
                        <p>Kota Pasuruan, Jawa Timur, Indonesia</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>(0343) 424064</span></p>
                        <p><strong>Email:</strong> <span>litbangbappelitbangda@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-youtube"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <!-- <a href=""><i class="bi bi-linkedin"></i></a> -->
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Perencanaan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Kajian</a></li>
                        <li><a href="#">Klinik Inovasi</a></li>
                        <li><a href="#">Klinik HKI</a></li>
                    </ul>
                </div>

                <!-- <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div> -->

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span></span> <strong class="px-1 sitename">Reka Karsa Cipta |</strong><span>Bidang Riset dan Inovasi - Bappelitbangda Kota Pasuruan</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('rkc/js/counter.js')}}"></script>
    <script src="{{ asset('rkc/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('rkc/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('rkc/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('rkc/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('rkc/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('rkc/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('rkc/assets/js/main.js') }}"></script>

</body>

</html>