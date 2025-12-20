@extends('admin.layouts.main')

@include('admin.experience-section.create')
@include('admin.experience-section.edit')

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
                                <h5><b>experience List</b></h5>
                            </div>
                            <div class="col-6">
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" class="btn btn-primary float-end"
                                        id="btn_add_experience">Add
                                        Experience</a>
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
                                        <th style="text-align: left; padding: 12px;">No</th>
                                        <th style="text-align: left; padding: 12px;">Job Title</th>
                                        <th style="text-align: left; padding: 12px;">Company</th>
                                        <th style="text-align: left; padding: 12px;">Periode</th>
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
        $(document).ready(function() {
            $('#experience_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
            $('#edit_experience_description').summernote({
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
                    url: "/admin/experience-section/get-data",
                    type: "GET",
                    dataType: 'JSON',
                    success: function(response) {
                        table.clear();

                        $.each(response.data, function(key, value) {
                            let data = `
                            <tr class="data-row" id="index_${value.id}">
                                <td>${key + 1}</td>
                                <td>${value.job_title}</td>
                                <td>${value.company}</td>
                                <td>${value.start_date} - ${value.is_current ? 'Now' : value.end_date}</td>
                                <td>
                                    <a href="javascript:void(0)" id="btn_edit_experience" data-id="${value.id}" class="btn btn-icon btn-warning btn-lg mb-2"><i class="ti ti-edit"></i> </a>
                                    <a href="javascript:void(0)" id="btn_delete_experience" data-id="${value.id}" class="btn btn-icon btn-danger btn-lg mb-2"><i class="ti ti-trash"></i> </a>
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
            $('body').on('click', '#btn_add_experience', function() {
                $('#modal_add_experience').modal('show');
                clearAlert();
                clearForm();
            });

            function clearAlert() {
                $('#job_title_error').removeClass('d-block').addClass('d-none');
                $('#company_error').removeClass('d-block').addClass('d-none');
                $('#start_date_error').removeClass('d-block').addClass('d-none');
                $('#end_date_error').removeClass('d-block').addClass('d-none');
                $('#summary_error').removeClass('d-block').addClass('d-none');
            }

            function clearForm() {
                $('#job_title').val('');
                $('#company').val('');
                $('#start_date').val('');
                $('#end_date').val('');
                $('#summary').summernote('code', '');
            }

            // Proses store data
            $('#store').click(function(e) {
                e.preventDefault();

                let job_title = $('#job_title').val();
                let company = $('#company').val();
                let start_date = $('#start_date').val();
                let end_date = $('#end_date').val();
                let is_current = $('#is_current').is(':checked') ? 1 : 0;
                let summary = $('#summary').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('job_title', job_title);
                formData.append('company', company);
                formData.append('start_date', start_date);
                formData.append('end_date', end_date);
                formData.append('is_current', is_current);
                formData.append('summary', summary);
                formData.append('_token', token);

                $.ajax({
                    url: '/admin/experience-section/store',
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

                        $('#modal_add_experience').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.job_title) {
                            $('#job_title_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.job_title[0]);
                        }
                        if (error.responseJSON && error.responseJSON.company) {
                            $('#company_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.company[0]);
                        }
                        if (error.responseJSON && error.responseJSON.start_date) {
                            $('#start_date_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.start_date[0]);
                        }
                        if (error.responseJSON && error.responseJSON.end_date) {
                            $('#end_date_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.end_date[0]);
                        }
                        if (error.responseJSON && error.responseJSON.is_current) {
                            $('#is_current_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.is_current[0]);
                        }
                        if (error.responseJSON && error.responseJSON.summary) {
                            $('#summary_error').removeClass('d-none').addClass(
                                'd-block').html(error.responseJSON.summary[
                                0]);
                        }
                    }
                });

            });

            // Show modal edit data
            $('body').on('click', '#btn_edit_experience', function() {
                let experience_id = $(this).data('id');
                clearAlert();

                $.ajax({
                    url: `/admin/experience-section/${experience_id}/edit`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        $('#experience_id').val(response.data.id);
                        $('#edit_job_title').val(response.data.job_title);
                        $('#edit_company').val(response.data.company);
                        $('#edit_start_date').val(response.data.start_date);
                        $('#edit_end_date').val(response.data.end_date);
                        if (response.data.is_current) {
                            $('#edit_is_current').prop('checked', true);
                        } else {
                            $('#edit_is_current').prop('checked', false);
                        }
                        $('#edit_summary').summernote('code', response.data.summary);

                        $('#modal_edit_experience').modal('show');
                    }
                });
            });

            // proccess update
            $('#update').click(function(e) {
                e.preventDefault();

                let experience_id = $('#experience_id').val();
                let job_title = $('#edit_job_title').val();
                let company = $('#edit_company').val();
                let start_date = $('#edit_start_date').val();
                let end_date = $('#edit_end_date').val();
                let is_current = $('#edit_is_current').is(':checked') ? 1 : 0;
                let summary = $('#edit_summary').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append('job_title', job_title);
                formData.append('company', company);
                formData.append('start_date', start_date);
                formData.append('end_date', end_date);
                formData.append('is_current', is_current);
                formData.append('summary', summary);
                formData.append('_token', token);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/admin/experience-section/${experience_id}`,
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

                        $('#modal_edit_experience').modal('hide');

                        // Reset form fields
                        clearForm();
                        // Reload data
                        loadDataTable();
                    },

                    error: function(error) {
                        clearAlert();

                        if (error.responseJSON && error.responseJSON.job_title) {
                            $('#job_title_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.job_title[0]);
                        }
                        if (error.responseJSON && error.responseJSON.company) {
                            $('#company_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.company[0]);
                        }
                        if (error.responseJSON && error.responseJSON.start_date) {
                            $('#start_date_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.start_date[0]);
                        }
                        if (error.responseJSON && error.responseJSON.end_date) {
                            $('#end_date_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.end_date[0]);
                        }
                        if (error.responseJSON && error.responseJSON.is_current) {
                            $('#is_current_error').removeClass('d-none').addClass(
                                    'd-block')
                                .html(error.responseJSON.is_current[0]);
                        }
                        if (error.responseJSON && error.responseJSON.summary) {
                            $('#summary_error').removeClass('d-none').addClass(
                                'd-block').html(error.responseJSON.summary[
                                0]);
                        }
                    }
                });
            });


            // Proccess Delete/Destroy
            $('body').on('click', '#btn_delete_experience', function() {
                let experience_id = $(this).data('id');
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
                            url: `/admin/experience-section/${experience_id}`,
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
