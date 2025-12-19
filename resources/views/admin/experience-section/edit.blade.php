<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="modal_edit_experience" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="experience_id">
                    <div class="mb-3">
                        <label for="job_title" class="form-label">Job Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="job_title" id="edit_job_title"
                            value="{{ old('job_title') }}">
                        <div class="text-danger d-none" id="job_title_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company" id="edit_company"
                            value="{{ old('company') }}">
                        <div class="text-danger d-none" id="company_error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_date" id="edit_start_date"
                                    value="{{ old('start_date') }}">
                                <div class="text-danger d-none" id="start_date_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="edit_end_date"
                                    value="{{ old('end_date') }}">
                                <div class="text-danger d-none" id="end_date_error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_current" value="1"
                                id="edit_is_current">
                            <label class="form-check-label" for="is_current">
                                Currently Working Here
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="summary" id="edit_summary" cols="30" rows="10"></textarea>
                        <div class="text-danger d-none" id="summary_error"></div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary" id="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
