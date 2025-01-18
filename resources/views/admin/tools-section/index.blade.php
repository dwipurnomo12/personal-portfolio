@extends('admin.layouts.main')

@include('admin.tools-section.create')
@include('admin.tools-section.edit')

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
                                <h5><b>Tools List</b></h5>
                            </div>
                            <div class="col-6">
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" class="btn btn-primary float-end" id="btn_add_tool">Add
                                        Tool</a>
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
                                        <th style="text-align: left; padding: 12px;">Tools Logo</th>
                                        <th style="text-align: left; padding: 12px;">Tools Name</th>
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
            let table = $('#table_id').DataTable();

            // function load data in table
            function loadDataTable() {
                $.ajax({
                    url: "/admin/tools-section/get-data",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(response) {
                        table.clear();

                        $.each(response.data, function(key, value) {
                            let data = `
                            <tr class="data-row" id="index_${value.id}">
                                <td><img src="/storage/${value.tool_logo}" alt="tool Logo" style="width: 100px; height: 100px;"></td>
                                <td>${value.tool_name}</td>
                                <td>
                                    <a href="javascript:void(0)" id="btn_edit_tool" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="ti ti-edit"></i> </a>
                                    <a href="javascript:void(0)" id="btn_delete_tool" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="ti ti-trash"></i> </a>
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
            $('body').on('click', '#btn_add_tool', function() {
                $('#modal_add_tool').modal('show');
                clearAlert();
                clearForm();
            });

            function clearAlert() {
                $('#tool_logo_error').removeClass('d-block').addClass('d-none');
                $('#preview').attr('src', '');
                $('#tool_name_error').removeClass('d-block').addClass('d-none');
            }

            function clearForm() {
                $('#tool_logo').val('');
                $('#preview').attr('src', '');
                $('#tool_name').val('');
            }

            // Proses store data
            $('#store').click(function(e) {
                e.preventDefault();

                let tool_logo = $('#tool_logo')[0].files[0];
                let tool_name = $('#tool_name').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('tool_logo', tool_logo);
                formData.append('tool_name', tool_name);
                formData.append('_token', token);

                $.ajax({
                    url: '/admin/tools-section',
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

                        $('#modal_add_tool').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.tool_logo) {
                            $('#tool_logo_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.tool_logo[0]);
                        }
                        if (error.responseJSON && error.responseJSON.tool_name) {
                            $('#tool_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.tool_name[0]);
                        }
                    }
                });

            });


            // Show modal edit data
            $('body').on('click', '#btn_edit_tool', function() {
                let tool_id = $(this).data('id');
                clearAlert();

                $.ajax({
                    url: `/admin/tools-section/${tool_id}/edit`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#tool_id').val(response.data.id);
                        $('#edit_tool_name').val(response.data.tool_name);
                        $('#preview_edit').attr('src', '/storage/' + response.data
                            .tool_logo);

                        $('#modal_edit_tool').modal('show');
                    }
                });
            });

            // proccess update
            $('#update').click(function(e) {
                e.preventDefault();

                let tool_id = $('#tool_id').val();
                let tool_logo = $('#edit_tool_logo')[0].files[0];
                let tool_name = $('#edit_tool_name').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('tool_logo', tool_logo);
                formData.append('tool_name', tool_name);
                formData.append('_token', token);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/admin/tools-section/${tool_id}`,
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

                        $('#modal_edit_tool').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.tool_logo) {
                            $('#tool_logo_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.tool_logo[0]);
                        }
                        if (error.responseJSON && error.responseJSON.tool_name) {
                            $('#tool_name_error').removeClass('d-none').addClass('d-block')
                                .html(error.responseJSON.tool_name[0]);
                        }
                    }
                });
            });


            // Proccess Delete/Destroy
            $('body').on('click', '#btn_delete_tool', function() {
                let tool_id = $(this).data('id');
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
                            url: `/admin/tools-section/${tool_id}`,
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
