<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SAKU (Sistem Akutansi Unggulan)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/stylewebsite.css" rel="stylesheet">

    <style>
        .marquee-container {
            margin-left: 3%;
            width: 100%;
            height: 100%;
            /* Sesuaikan tinggi sesuai kebutuhan */
            overflow: hidden;
            white-space: nowrap;
            display: flex;
            align-items: right;
            /* Posisi vertikal tengah */
            justify-content: center;
            /* Posisi horizontal tengah */

        }

        .marquee-wrapper {
            display: flex;
            gap: 50px;
            /* Jarak antara teks */
        }

        .marquee-text {
            display: flex;
            color: white;
            font-size: 15px;
            font-weight: bold;
            animation: marquee-loop 10s linear infinite;
            min-width: max-content;
        }

        @keyframes marquee-loop {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            /* Warna biru */
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
            /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white pr-3" href="">FAQs</a>
                    <span class="text-white">|</span>
                    <a class="text-white px-3" href="">Help</a>
                    <span class="text-white">|</span>
                    <a class="text-white pl-3" href="">Support</a>
                    <div class="marquee-container">
                        <div class="marquee-wrapper">
                            <div class="marquee-text">🔥 Promo Diskon Besar-Besaran! |</div>
                            <div class="marquee-text">🎉 Selamat Datang di Website Kami! |</div>
                            <div class="marquee-text">🚀 Ikuti Kami untuk Update Terbaru! |</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-3" href="https://www.facebook.com/yanuar.a.pradana.1">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-3" href="https://maps.app.goo.gl/TUfbMeri9xuajT1a7">
                        <i class="fas fa-map-marked-alt"></i>
                    </a>
                    <a class="text-white px-3" href="https://www.instagram.com/faradisaputriulya/">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-3" href="https://www.youtube.com/@officialsmknugresik">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="website" class="navbar-brand d-none d-lg-block">
                    <!-- <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Lover</h1> -->
                    <img src="img/logoapp.png" alt="Image" width="45%">
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <!-- <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Opening Hours</h6>
                        <p class="m-0">8.00AM - 9.00PM</p>
                    </div> -->
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Email Us</h6>
                        <p class="m-0">putriulyafaradisa@gmail.com</p>
                    </div>
                    <!-- <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Call Us</h6>
                        <p class="m-0">031-3951239</p>
                    </div> -->
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <a href="site/login" class="login-button">Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <img class="w-100" src="" alt="Image">
                    <div class="carousel-caption2 d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;margin-top: 20%;">
                            <!-- <h3 class="text-white mb-3 d-none d-sm-block"></h3>
                            <h1 class="display-3 text-white mb-3"></h1>
                            <h5 class="text-white mb-3 d-none d-sm-block"></h5> -->

                            <!-- <a href="" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">TOMBOL 1</a>
                            <a href="" class="btn btn-lg btn-secondary mt-3 mt-md-4 px-4">TOMBOL 2</a> -->
                        </div>
                    </div>
                </div>
                <?php
                // foreach ($bannerberanda as $row) :
                ?>
                <!-- <div class="carousel-item">
                        <?php
                        //$imgbanner = $row->foto; // Pastikan sintaksis ini sesuai dengan struktur objek atau array yang digunakan
                        //$imgid = $row->id; // Pastikan sintaksis ini sesuai dengan struktur objek atau array yang digunakan
                        ?>
                        <img class="w-100" src="uploads/bannerberanda/<?php //echo $imgid . $imgbanner; 
                                                                        ?>" alt="Image">
                    </div> -->
                <?php
                // endforeach;
                ?>
            </div>
            <!-- panah kiri -->
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <!-- panah kanan -->
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-12 pb-5 pb-lg-0 px-3 px-lg-5">
                    <h4 class="text-secondary mb-3">Tentang Kami</h4>
                    <h1 class="display-4 mb-4"><span class="text-primary2">SAKU</span> <span class="text-secondary">APP</span></h1>
                    <!-- <h5 class="text-muted mb-3">Sejarah Singkat RSUD Ibnu Sina Kabupaten Gresik</h5> -->
                    <p class="mb-4">
                        SAKU (Sistem Akuntansi Unggul) adalah platform pembelajaran inovatif yang dirancang khusus untuk membantu siswa memahami akuntansi dengan cara yang lebih mudah, interaktif, dan menyenangkan. Dengan berbagai fitur unggulan, SAKU hadir untuk menjadi solusi terbaik dalam meningkatkan pemahaman konsep akuntansi bagi siswa di berbagai jenjang pendidikan. <br>
                        <br>
                        <b>Visi Kami</b> <br>
                        Menjadi platform pembelajaran akuntansi terbaik yang memberikan kemudahan akses bagi siswa dalam memahami materi akuntansi dengan metode yang inovatif dan berbasis teknologi.
                        <br>
                        <b>Misi Kami</b> <br>
                        ✅ Menyediakan materi akuntansi yang lengkap dan mudah dipahami. <br>
                        ✅ Menghadirkan soal-soal latihan interaktif untuk meningkatkan pemahaman siswa. <br>
                        ✅ Menyediakan buku digital sebagai referensi belajar. <br>
                        ✅ Memanfaatkan teknologi dalam proses pembelajaran agar lebih efektif dan efisien. <br>
                        <br>
                        <b>Fitur Unggulan</b> <br>
                        📚 Materi Akuntansi – Tersedia berbagai materi pembelajaran akuntansi yang disusun secara sistematis. <br>
                        📝 Soal & Latihan – Kumpulan soal latihan dan kuis interaktif untuk mengasah pemahaman siswa. <br>
                        📖 Buku Digital – Akses ke berbagai buku dan referensi yang mendukung pembelajaran. <br>
                        📊 Analisis Kemajuan – Fitur pelacakan progres belajar siswa untuk mengetahui perkembangan mereka. <br>
                        <br>
                        Dengan SAKU, belajar akuntansi menjadi lebih mudah, terstruktur, dan menyenangkan! 🌟 <br>
                        <br>
                        🚀 Mari bergabung bersama kami dan tingkatkan pemahaman akuntansi dengan SAKU! <br>
                    </p>
                </div>
                <!-- <div class="col-lg-5">
                    <div class="row px-3">
                        <div class="col-12 p-0">
                            <img class="img-fluid w-100" src="" alt="">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark2 text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-12 mb-5">
                <!-- <h1 class="mb-3 display-5 text-capitalize text-white"><span class="text-primary">Pet</span>Lover</h1> -->
                <div style="max-width: 100%; overflow: hidden;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7917.485029930853!2d112.65296428743616!3d-7.1557400475893544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd8005bcc084f1b%3A0x3d8071fa19c43b8d!2sSMK%20NU%20GRESIK!5e0!3m2!1sid!2sid!4v1738936977229!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- <p class="m-0">Ipsum amet sed vero et lorem stet eos ut, labore sed sed stet sea est ipsum ut. Volup amet ea sanct ipsum, dolore vero lorem no duo eirmod. Eirmod amet ipsum no ipsum lorem clita ut. Ut sed sit lorem ea lorem sed, amet stet sit sea ea diam tempor kasd kasd. Diam nonumy etsit tempor ut sed diam sed et ea</p> -->
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Alamat: Jl. KH. Abdul Karim No.60, Trate, Pekelingan, Kec. Gresik, Kabupaten Gresik, Jawa Timur 61114</p>
                        <p><i class="fa fa-envelope mr-2"></i>putriulyafaradisa@gmail.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.youtube.com/@officialsmknugresik"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.facebook.com/yanuar.a.pradana.1"><i class="fab fa-facebook-f"></i></a>
                            <!-- <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://play.google.com/store/apps/details?id=id.medify.ibnu_sina"><i class="fab fa-google-play"></i></a> -->
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.instagram.com/faradisaputriulya/"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <a href="website" class="navbar-brand d-none d-lg-block">
                            <!-- <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Lover</h1> -->
                            <img src="img/logoapp.png" alt="Image" width="100%">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer end -->

        <div class="container-fluid text-white py-4 px-sm-3 px-md-5" style="background: #111111;">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">
                        &copy; <a class="text-white font-weight-bold" href="#">Putri Ulya Faradisa</a>. Designed by
                        <a class="text-white font-weight-bold" href="https://www.instagram.com/pradana_1301/">PraLogic</a>
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <ul class="nav d-inline-flex">
                        <li class="nav-item">
                            <a class="nav-link text-white py-0" href="#">Privacy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white py-0" href="#">Terms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white py-0" href="#">FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white py-0" href="#">Help</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>