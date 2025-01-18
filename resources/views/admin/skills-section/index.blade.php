@extends('admin.layouts.main')

@include('admin.skills-section.create')
@include('admin.skills-section.edit')

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
                                <h5><b>Skills List</b></h5>
                            </div>
                            <div class="col-6">
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" class="btn btn-primary float-end" id="btn_add_skill">Add
                                        Skill</a>
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
                                        <th style="text-align: left; padding: 12px;">Skill Logo</th>
                                        <th style="text-align: left; padding: 12px;">Skill Name</th>
                                        <th style="text-align: left; padding: 12px;">Description</th>
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
            $('#skill_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
            $('#edit_skill_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
        });
        $(document).ready(function() {
            let table = $('#table_id').DataTable();

            // function load data in table
            function loadDataTable() {
                $.ajax({
                    url: "/admin/skills-section/get-data",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(response) {
                        table.clear();

                        $.each(response.data, function(key, value) {
                            let data = `
                            <tr class="data-row" id="index_${value.id}">
                                <td><img src="/storage/${value.skill_logo}" alt="Skill Logo" style="width: 100px; height: 100px;"></td>
                                <td>${value.skill_name}</td>
                                <td>${value.skill_description}</td>
                                <td>
                                    <a href="javascript:void(0)" id="btn_edit_skill" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="ti ti-edit"></i> </a>
                                    <a href="javascript:void(0)" id="btn_delete_skill" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="ti ti-trash"></i> </a>
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
            $('body').on('click', '#btn_add_skill', function() {
                $('#modal_add_skill').modal('show');
                clearAlert();
                clearForm();
            });

            function clearAlert() {
                $('#skill_logo_error').removeClass('d-block').addClass('d-none');
                $('#preview').attr('src', '');
                $('#skill_name_error').removeClass('d-block').addClass('d-none');
                $('#skill_description_error').removeClass('d-block').addClass('d-none');
            }

            function clearForm() {
                $('#skill_logo').val('');
                $('#preview').attr('src', '');
                $('#skill_name').val('');
                $('#skill_description').summernote('code', '');

            }

            // Proses store data
            $('#store').click(function(e) {
                e.preventDefault();

                let skill_logo = $('#skill_logo')[0].files[0];
                let skill_name = $('#skill_name').val();
                let skill_description = $('#skill_description').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('skill_logo', skill_logo);
                formData.append('skill_name', skill_name);
                formData.append('skill_description', skill_description);
                formData.append('_token', token);

                $.ajax({
                    url: '/admin/skills-section',
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

                        $('#modal_add_skill').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.skill_logo) {
                            $('#skill_logo_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.skill_logo[0]);
                        }
                        if (error.responseJSON && error.responseJSON.skill_name) {
                            $('#skill_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.skill_name[0]);
                        }
                        if (error.responseJSON && error.responseJSON.skill_description) {
                            $('#skill_description_error').removeClass('d-none').addClass(
                                'd-block').html(error.responseJSON.skill_description[0]);
                        }
                    }
                });

            });


            // Show modal edit data
            $('body').on('click', '#btn_edit_skill', function() {
                let skill_id = $(this).data('id');
                clearAlert();

                $.ajax({
                    url: `/admin/skills-section/${skill_id}/edit`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#skill_id').val(response.data.id);
                        $('#edit_skill_name').val(response.data.skill_name);
                        $('#edit_skill_description').val(response.data.skill_description);
                        $('#preview_edit').attr('src', '/storage/' + response.data
                            .skill_logo);
                        $('#edit_skill_description').summernote('code', response.data
                            .skill_description);

                        $('#modal_edit_skill').modal('show');
                    }
                });
            });

            // proccess update
            $('#update').click(function(e) {
                e.preventDefault();

                let skill_id = $('#skill_id').val();
                let skill_logo = $('#edit_skill_logo')[0].files[0];
                let skill_name = $('#edit_skill_name').val();
                let skill_description = $('#edit_skill_description').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('skill_logo', skill_logo);
                formData.append('skill_name', skill_name);
                formData.append('skill_description', skill_description);
                formData.append('_token', token);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/admin/skills-section/${skill_id}`,
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

                        $('#modal_edit_skill').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.skill_logo) {
                            $('#skill_logo_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.skill_logo[0]);
                        }
                        if (error.responseJSON && error.responseJSON.skill_name) {
                            $('#skill_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.skill_name[0]);
                        }
                        if (error.responseJSON && error.responseJSON.skill_description) {
                            $('#skill_description_error').removeClass('d-none').addClass(
                                'd-block').html(error.responseJSON.skill_description[0]);
                        }
                    }
                });
            });


            // Proccess Delete/Destroy
            $('body').on('click', '#btn_delete_skill', function() {
                let skill_id = $(this).data('id');
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
                            url: `/admin/skills-section/${skill_id}`,
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
