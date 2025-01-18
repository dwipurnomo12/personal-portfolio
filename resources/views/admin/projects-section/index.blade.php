@extends('admin.layouts.main')

@include('admin.projects-section.create')
@include('admin.projects-section.edit')
@include('admin.projects-section.show')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5><b>Projects List</b></h5>
                            </div>
                            <div class="col-6">
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" class="btn btn-primary float-end" id="btn_add_project">Add
                                        project</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-striped table-hover"
                                style="width: 100%; border-collapse: collapse;">
                                <thead class="align-middle"
                                    style="background-color: #f8f9fa; text-transform: uppercase; font-size: 14px; font-weight: bold; border-bottom: 2px solid #dee2e6;">
                                    <tr>
                                        <th style="text-align: left; padding: 12px;">Featured Image</th>
                                        <th style="text-align: left; padding: 12px;">Project Name</th>
                                        <th style="text-align: left; padding: 12px;">Url Preview</th>
                                        <th style="text-align: left; padding: 12px;">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function previewImage() {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        }

        function previewImageEdit() {
            const file = event.target.files[0];
            const preview = document.getElementById('preview_edit');

            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        }

        $(document).ready(function() {
            $('#project_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            });
            $('#edit_project_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            });
        });

        $(document).ready(function() {
            let table = $('#table_id').DataTable();

            // function load data in table
            function loadDataTable() {
                $.ajax({
                    url: "/admin/projects-section/get-data",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(response) {
                        table.clear();

                        $.each(response.data, function(key, value) {
                            let data = `
                            <tr class="data-row" id="index_${value.id}">
                                <td><img src="/storage/${value.featured_image}" alt="project Logo" style="width: 300px; height: 175px;"></td>
                                <td>${value.project_name}</td>
                                <td>${value.url_preview}</td>
                                <td>
                                    <a href="javascript:void(0)" id="btn_show_project" data-id="${value.id}" class="btn btn-icon btn-success btn-lg mb-2"><i class="ti ti-eye"></i> </a>
                                    <a href="javascript:void(0)" id="btn_edit_project" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="ti ti-edit"></i> </a>
                                    <a href="javascript:void(0)" id="btn_delete_project" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="ti ti-trash"></i> </a>
                                </td>
                            </tr>
                        `;
                            table.row.add($(data)).draw(
                                false);
                        });
                    }
                });
            }

            // show data in table
            loadDataTable();

            // Show modal add data
            $('body').on('click', '#btn_add_project', function() {
                $('#modal_add_project').modal('show');
                clearAlert();
                clearForm();
            });

            function clearAlert() {
                $('#featured_image_error').removeClass('d-block').addClass('d-none');
                $('#preview').attr('src', '');
                $('#project_name_error').removeClass('d-block').addClass('d-none');
                $('#url_preview_error').removeClass('d-block').addClass('d-none');
                $('#project_description_error').removeClass('d-block').addClass('d-none');
            }

            function clearForm() {
                $('#featured_image').val('');
                $('#preview').attr('src', '');
                $('#project_name').val('');
                $('#url_preview').val('');
                $('#project_description').summernote('code', '');
            }

            // Proses store data
            $('#store').click(function(e) {
                e.preventDefault();

                let featured_image = $('#featured_image')[0].files[0];
                let project_name = $('#project_name').val();
                let url_preview = $('#url_preview').val();
                let project_description = $('#project_description').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('featured_image', featured_image);
                formData.append('project_name', project_name);
                formData.append('url_preview', url_preview);
                formData.append('project_description', project_description);
                formData.append('_token', token);

                $.ajax({
                    url: '/admin/projects-section',
                    type: "POST",
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            timer: 3000
                        });

                        $('#modal_add_project').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.featured_image) {
                            $('#featured_image_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.featured_image[0]);
                        }
                        if (error.responseJSON && error.responseJSON.project_name) {
                            $('#project_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.project_name[0]);
                        }
                        if (error.responseJSON && error.responseJSON.url_preview) {
                            $('#url_preview_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.url_preview[0]);
                        }
                        if (error.responseJSON && error.responseJSON.project_description) {
                            $('#project_description_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.project_description[0]);
                        }
                    }
                });

            });

            // Show modal show detail data
            $('body').on('click', '#btn_show_project', function() {
                let project_id = $(this).data('id');
                clearAlert();

                $.ajax({
                    url: `/admin/projects-section/${project_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#project_id').val(response.data.id);
                        $('#show_project_name').val(response.data.project_name);
                        $('#show_url_preview').val(response.data.url_preview);
                        $('#show_project_description').val(response.data.project_description);
                        $('#preview_show').attr('src', '/storage/' + response.data
                            .featured_image);

                        $('#modal_show_project').modal('show');
                    }
                });
            });


            // Show modal edit data
            $('body').on('click', '#btn_edit_project', function() {
                let project_id = $(this).data('id');
                clearAlert();

                $.ajax({
                    url: `/admin/projects-section/${project_id}/edit`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#project_id').val(response.data.id);
                        $('#edit_project_name').val(response.data.project_name);
                        $('#edit_url_preview').val(response.data.url_preview);
                        $('#edit_project_description').val(response.data.project_description);
                        $('#preview_edit').attr('src', '/storage/' + response.data
                            .featured_image);
                        $('#edit_project_description').summernote('code', response.data
                            .project_description);

                        $('#modal_edit_project').modal('show');
                    }
                });
            });

            // proccess update
            $('#update').click(function(e) {
                e.preventDefault();

                let project_id = $('#project_id').val();
                let featured_image = $('#edit_featured_image')[0].files[0];
                let project_name = $('#edit_project_name').val();
                let url_preview = $('#edit_url_preview').val();
                let project_description = $('#edit_project_description').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('featured_image', featured_image);
                formData.append('project_name', project_name);
                formData.append('url_preview', url_preview);
                formData.append('project_description', project_description);
                formData.append('_token', token);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/admin/projects-section/${project_id}`,
                    type: "POST",
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                            timer: 3000
                        });

                        $('#modal_edit_project').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.featured_image) {
                            $('#featured_image_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.featured_image[0]);
                        }
                        if (error.responseJSON && error.responseJSON.project_name) {
                            $('#project_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.project_name[0]);
                        }
                        if (error.responseJSON && error.responseJSON.url_preview) {
                            $('#url_preview_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.url_preview[0]);
                        }
                        if (error.responseJSON && error.responseJSON.project_description) {
                            $('#project_description_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.project_description[0]);
                        }
                    }
                });
            });


            // Proccess Delete/Destroy
            $('body').on('click', '#btn_delete_project', function() {
                let project_id = $(this).data('id');
                let token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Delete this data',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'YES, DELETE!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/projects-section/${project_id}`,
                            type: "DELETE",
                            cache: false,
                            data: {
                                "_token": token
                            },
                            success: function(response) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: true,
                                    timer: 3000
                                });
                                $('#table_id').DataTable().clear().draw();

                                // Reload data
                                loadDataTable();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
