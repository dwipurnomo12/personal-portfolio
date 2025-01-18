       <div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_tool" data-bs-backdrop="static">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Edit Tool</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <form enctype="multipart/form-data">
                       <div class="modal-body">
                           <input type="hidden" id="tool_id">
                           <div class="mb-3">
                               <label for="tool_logo" class="form-label">Tool Logo <span
                                       class="text-danger">*</span></label>
                               <br>
                               <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview_edit"
                                   style="border-radius: 5px; max-height: 100px; max-width: 100px; overflow: hidden; display: block;">
                               <input type="file" class="form-control" name="tool_logo" id="edit_tool_logo"
                                   onchange="previewImageEdit()">
                               <div class="text-danger d-none" id="tool_logo_error"></div>
                           </div>
                           <div class="mb-3">
                               <label for="tool_name" class="form-label">Tool Name <span
                                       class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="tool_name" id="edit_tool_name"
                                   value="{{ old('tool_name') }}">
                               <div class="text-danger d-none" id="tool_name_error"></div>
                           </div>
                       </div>
                       <div class="modal-footer bg-whitesmoke br">
                           <button type="button" class="btn btn-primary" id="update">Update</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
