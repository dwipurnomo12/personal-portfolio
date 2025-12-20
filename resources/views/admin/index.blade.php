@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">

        </div>

        <div class="row">
            <div class="col-lg-4">
                <a href="/admin/home-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="solar:menu-dots-square-broken" class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Home Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/admin/about-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="mdi:about-circle-outline" class="fs-6 text-primary"> </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">About Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/admin/projects-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="fluent-mdl2:new-team-project" class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Projects Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/admin/projects-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="hugeicons:computer-programming-01" class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Skills Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/admin/tools-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="tdesign:system-setting-filled" class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Tools Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/admin/experience-section">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="material-symbols:computer-sound-outline-sharp"
                                        class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Experiences Section</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                            <div>
                                <h5 class="mb-1">Traffic Overview</h5>
                                <p class="mb-0 text-muted">Last 14 days</p>
                            </div>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">Live</span>
                        </div>
                        @if (!empty($analyticsError))
                            <p class="text-muted mb-3">Analytics belum bisa dimuat: {{ $analyticsError }}</p>
                        @endif
                        <div id="analytics-line-chart" style="min-height: 320px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chartEl = document.querySelector('#analytics-line-chart');

            if (!chartEl || typeof ApexCharts === 'undefined') {
                return;
            }

            var labels = @json($labels ?? []);
            var visitorsData = @json($visitors ?? []);
            var pageViewsData = @json($pageViews ?? []);

            var options = {
                chart: {
                    type: 'line',
                    height: 320,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        top: 6,
                        left: 0,
                        blur: 10,
                        opacity: 0.15
                    }
                },
                series: [{
                    name: 'Visitors',
                    data: visitorsData
                }, {
                    name: 'Page Views',
                    data: pageViewsData
                }],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#0ea5e9', '#22c55e'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.3,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                grid: {
                    borderColor: 'rgba(148, 163, 184, 0.2)',
                    strokeDashArray: 4
                },
                markers: {
                    size: 4,
                    strokeWidth: 2,
                    strokeColors: '#ffffff',
                    hover: {
                        size: 6
                    }
                },
                xaxis: {
                    categories: labels,
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#94a3b8'
                        }
                    }
                },
                tooltip: {
                    theme: 'light',
                    x: {
                        show: true
                    }
                }
            };

            new ApexCharts(chartEl, options).render();
        });
    </script>
@endsection
