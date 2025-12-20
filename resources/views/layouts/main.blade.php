<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="{{ config('app.google_verification') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="/admin/assets/images/logo.png" />

    <title>Dwi Purnomo - Personal Portfolio</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/unicons.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="/assets/css/tooplate-style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Swipper Js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5Q4J4F3YN3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5Q4J4F3YN3');
    </script>
</head>

<body>

    <!-- MENU -->
    @include('partials.navbar')

    <!-- CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    @include('partials.footer')

    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/Headroom.js"></script>
    <script src="/assets/js/jQuery.headroom.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/smoothscroll.js"></script>
    <script src="/assets/js/custom.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('sweetalert::alert')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadMoreBtn = document.getElementById("load-more");
            const items = document.querySelectorAll(".portfolio .item");
            const itemsPerClick = 6; // Jumlah item yang ditampilkan setiap klik
            let visibleCount = 0; // Jumlah item yang saat ini terlihat

            // Tampilkan item pertama saat halaman dimuat
            const showItems = () => {
                let count = 0;
                items.forEach((item) => {
                    if (count < itemsPerClick && item.dataset.visible === "false") {
                        item.dataset.visible = "true";
                        count++;
                    }
                });
            };

            // Tambahkan event listener ke tombol "More"
            loadMoreBtn.addEventListener("click", function() {
                let hiddenItems = Array.from(items).filter(
                    (item) => item.dataset.visible === "false"
                );
                if (hiddenItems.length > 0) {
                    let count = 0;
                    hiddenItems.forEach((item) => {
                        if (count < itemsPerClick) {
                            item.dataset.visible = "true";
                            count++;
                        }
                    });
                } else {
                    loadMoreBtn.style.display = "none"; // Sembunyikan tombol jika semua data sudah tampil
                }
            });

            // Tampilkan item pertama
            showItems();
        });
    </script>

    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>
