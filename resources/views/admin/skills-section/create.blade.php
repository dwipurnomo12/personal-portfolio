       <div class="modal fade" tabindex="-1" role="dialog" id="modal_add_skill" data-bs-backdrop="static">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Add Skill</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <form enctype="multipart/form-data">
                       <div class="modal-body">
                           <div class="mb-3">
                               <label for="skill_logo" class="form-label">Skill Logo <span
                                       class="text-danger">*</span></label>
                               <br>
                               <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview"
                                   style="border-radius: 5px; max-height: 100px; max-width: 100px; overflow: hidden; display: block;">
                               <input type="file" class="form-control" name="skill_logo" id="skill_logo"
                                   onchange="previewImage()">
                               <div class="text-danger d-none" id="skill_logo_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="skill_name" class="form-label">Skill Name <span
                                       class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="skill_name" id="skill_name"
                                   value="{{ old('skill_name') }}">
                               <div class="text-danger d-none" id="skill_name_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="skill_description" class="form-label">Description <span
                                       class="text-danger">*</span></label>
                               <textarea name="skill_description" id="skill_description" cols="30" rows="10"></textarea>
                               <div class="text-danger d-none" id="skill_description_error"></div>
                           </div>

                       </div>
                       <div class="modal-footer bg-whitesmoke br">
                           <button type="button" class="btn btn-primary" id="store">Submit</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
