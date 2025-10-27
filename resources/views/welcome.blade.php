<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('logo/favicon.ico')}}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .share-buttons ul {
            list-style: none;
            display: flex;
            gap: 8px;
            padding: 0;
            margin: 0;
        }
    </style>

    <!-- =======================================================
    * Template Name: eNno
    * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('beranda') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">e-APIK</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('/') ? 'active' : '' }}">Home</a></li>
                    <li class="dropdown"><a href="#"><span>Perencanaan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Comming Soon</a></li>
                           
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="{{ request()->routeIs('kajian.*') ? 'active' : '' }}"><span>Riset dan Inovasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('kajian') }}" class="{{ request()->routeIs('kajian') ? 'active' : '' }}">Kajian</a></li>
                            <li><a href="{{ route('infografis') }}"  class="{{ request()->routeIs('infografis') ? 'active' : '' }}">Infografis</a></li>
                            <li><a href="#">Pengusulan Pelaksanaan dan Kerjasama Riset</a></li>
                            <li class="dropdown"><a href="#"><span>Klinik Inovasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Daftar Inovasi Daerah Kota Pasuruan</a></li>
                                    <li><a href="#">Inovasi Unggulan Kota Pasuruan</a></li>
                                    <li><a href="#">Highlight RKC</a></li>
                                    <li><a href="{{ route('rkc') }}">Reka Karsa Cipta</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#"><span>Klinik KHI</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Tata Cara Pengajuan HKI</a></li>
                                    <li><a href="#">Pengajuan HKI</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="index.html#about">Info</a>

        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer">

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">e-APIK</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jalan Sultan Agung No. 32</p>
                        <p>Kota Pasuruan</p>
                        <p class="mt-3"><strong>Telp:</strong> <span>(0343) 426919</span></p>
                        <p><strong>Email:</strong> <span>bappelitbangda@pasuruankota.go.id</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Layanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Perencanaan Pembangunan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Riset dan Inovasi</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Kemiskinan</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>Bappelitbangda Kota Pasuruan</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-youtube"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span></span> <strong class="px-1 sitename">e-APIK Bappelitbangda Kota Pasuruan</strong></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

</body>

</html>