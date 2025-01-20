@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
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
                <a href="/admin/integrations">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-6 mb-4 pb-3">
                                <span
                                    class="round-48 d-flex align-items-center justify-content-center rounded bg-primary-subtle">
                                    <iconify-icon icon="la:project-diagram" class="fs-6 text-primary">
                                    </iconify-icon>
                                </span>
                                <h6 class="mb-0 fs-4">Integrations</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
