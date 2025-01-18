       <div class="modal modal-lg fade" tabindex="-1" role="dialog" id="modal_show_project" data-bs-backdrop="static">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">show Project</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-md-6">
                               <input type="hidden" id="project_id">
                               <div class="mb-3">
                                   <label for="featured_image" class="form-label">Featured Image <span
                                           class="text-danger">*</span></label>
                                   <br>
                                   <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview_show"
                                       style="border-radius: 5px; max-height: 175px; max-width: 100%; overflow: hidden; display: block;">
                                   <div class="text-danger d-none" id="featured_image_error"></div>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="mb-3">
                                   <label for="project_name" class="form-label">Project Name <span
                                           class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="project_name" id="show_project_name"
                                       value="{{ old('project_name') }}" disabled>
                                   <div class="text-danger d-none" id="project_name_error"></div>
                               </div>
                               <div class="mb-3">
                                   <label for="url_preview" class="form-label">URL Preview <span
                                           class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="url_preview" id="show_url_preview"
                                       value="{{ old('url_preview') }}" disabled>
                                   <div class="text-danger d-none" id="url_preview_error"></div>
                               </div>
                           </div>
                           <div class="mb-3">
                               <label for="project_description" class="form-label">Project Description <span
                                       class="text-danger">*</span></label>
                               <textarea class="form-control" name="project_description" id="show_project_description" cols="30" rows="10"
                                   disabled></textarea>
                               <div class="text-danger d-none" id="project_description_error"></div>
                           </div>
                       </div>
                   </div>

               </div>
           </div>
       </div>
