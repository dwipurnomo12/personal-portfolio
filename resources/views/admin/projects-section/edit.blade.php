       <div class="modal modal-lg fade" tabindex="-1" role="dialog" id="modal_edit_project" data-bs-backdrop="static">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Edit Project</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <form enctype="multipart/form-data">
                       <div class="modal-body">
                           <input type="hidden" id="project_id">
                           <div class="mb-3">
                               <label for="featured_image" class="form-label">Featured Image <span
                                       class="text-danger">*</span></label>
                               <br>
                               <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview_edit"
                                   style="border-radius: 5px; max-height: 250px; max-width: 100%; overflow: hidden; display: block;">
                               <input type="file" class="form-control" name="featured_image" id="edit_featured_image"
                                   onchange="previewImage()">
                               <div class="text-danger d-none" id="featured_image_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="project_name" class="form-label">Project Name <span
                                       class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="project_name" id="edit_project_name"
                                   value="{{ old('project_name') }}">
                               <div class="text-danger d-none" id="project_name_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="url_preview" class="form-label">URL Preview <span
                                       class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="url_preview" id="edit_url_preview"
                                   value="{{ old('url_preview') }}">
                               <div class="text-danger d-none" id="url_preview_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="project_description" class="form-label">Project Description <span
                                       class="text-danger">*</span></label>
                               <textarea name="project_description" id="edit_project_description" cols="30" rows="10"></textarea>
                               <div class="text-danger d-none" id="project_description_error"></div>
                           </div>

                       </div>
                       <div class="modal-footer bg-whitesmoke br">
                           <button type="button" class="btn btn-primary" id="store">Submit</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
