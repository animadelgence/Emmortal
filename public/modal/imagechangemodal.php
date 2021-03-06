<div class="modal fade" id="squarespaceModalchangeimage" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-box signin_popup">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Upload your profile photo and background</h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <div>
               <div class="" >
                  <form action="/account/profileimage" method="post" enctype="multipart/form-data" name="form1" id="profileimagechangeform">
                     <div class="aviary-div">
                        <div class="image-form-field " picture-name="photo" height="360" field-name="image"></div>
                        <div class="image-select">
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="img-input">
                                    <div class="canvas-placeholder" id="canvas-placeholderpfimage" style="height: 120px;">
                                       <i class="fa fa-picture-o remove-fa-picture-icon"></i>
                                       <!--<img id= 'profile_pic_thumb'/>-->
                                    </div>
                                    <div class="btn e-btn btn-primary file-input-btn" >
                                       <i class="fa fa-upload"></i>
                                       Choose photo
                                       <input name="profileimage" type="file" id="profileimagechange">
                                       <input type = "hidden" id = "pfimagePath" value="">
                                       <!--<input type = "hidden" id= "aviaryPath" name= "action" value=""> -->
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="img-input">
                                    <div class="canvas-placeholder" id="canvas-placeholderbkimage" style="height: 120px;">
                                       <i class="fa fa-picture-o remove-fa-picture-icon"></i>
                                       <!--<img id= 'profile_pic_thumb'/>-->
                                    </div>
                                    <div class="btn e-btn btn-primary file-input-btn" >
                                       <i class="fa fa-upload"></i>
                                       Choose photo
                                       <input name="backgroundimage" type="file" id="backgroundimagechange">
                                       <input type = "hidden" id = "bkimagePath" value="">
                                       <!--<input type = "hidden" id= "aviaryPath" name= "action" value=""> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <span id="imagePathError" style="color:red;display:none;">No image Selected</span>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footersec">
                  <div class="row">
                     <span class="button-part" style="float: right;list-style: outside none none;margin: 20px 0 0;overflow: hidden;padding: 0 15px;">
                     <button type="button" class="btn e-btn btn-default" onclick="$('.close').trigger('click');" data-toggle="modal" data-target="#uploadModal">skip</button>
                     <button type="submit" class="btn e-btn btn-primary" id = "profilesaveimageDetails">save</button>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>