

<!-- line modal -->
<div class="modal fade" id="tributemodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;padding-right:282px !important;">
   <div class="modal-dialog modal-box">
      <!-- Modal content-->
      <div class="modal-content modal-outer inner-modal-photo">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Create new tribute</h3>
         </div>
         <div class="modal-body select-media-type-popup">
            <div class="m-t-20">
               <div class="tags-input-wrapper" >
                  <div class="host">
                     <div class="tags">
                        <div id="append-div-video" class="">
                           <input type="text" placeholder="Type Friend Name..." class="friendsids" id="friendsidtribute" name="friendsidtribute" class="form-control" style="width:100%;">
                        </div>
                        <div class="dropdown-div">
                           <ul class="frndliststribute" id="frndlisttribute" style="list-style-type: none;z-index: 999999; position: relative; display:none;">
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="m-b-20 m-t-20" >
               <textarea name="tributeDescription" id="tributeDescription" class="form-control" style="height:353px;"></textarea>
               <span id="videoDescriptionError" style="color:red;display:none;">Required</span>
            </div>
         </div>
         <div class="modal-footer text-right">
            <span class="">
            <button type="button" class="btn e-btn btn-default">Back</button>
            <button type="submit" class="btn e-btn btn-primary" id="publishid">Publish</button>
            </span>
         </div>
      </div>
   </div>
</div>
</div>

