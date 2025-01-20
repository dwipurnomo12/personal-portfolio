<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Personal Portfolio - Dwi Purnomo</title>
    <link rel="shortcut icon" type="image/png" href="/admin/assets/images/logo.png" />
    <link rel="stylesheet" href="/admin/assets/css/styles.min.css" />

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/" class="text-nowrap logo-img">
                        <h5>PERSONAL PORTFOLIO</h5>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    @include('admin.partials.sidebar')
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.partials.navbar')
            <!--  Header End -->
            <div class="body-wrapper-inner">
                @yield('content')

                @include('admin.partials.footer')
            </div>
        </div>
    </div>
    </div>
    <script src="/admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/assets/js/sidebarmenu.js"></script>
    <script src="/admin/assets/js/app.min.js"></script>
    <script src="/admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/admin/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="/admin/assets/js/dashboard.js"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('sweetalert::alert')
    <script>
        $(".swal-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Hapus Data Ini ?',
                text: "Anda tidak akan dapat mengembalikan data yang dihapus !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
</body>

</html>
