<!-- line modal for text-->
<div class="modal fade" id="friendTributeAddModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
   <div class="modal-dialog modal-box text-nsert-modal">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal" onclick="$('#tributeAddModal').css('z-index','1042');"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Add Tribute</h3>
         </div>
         <div class="modal-body select-media-type-popup">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="form-group col-xs-12 col-sm-12">
                        <textarea name="friendtributeDescription" id="friendtributeDescription" class="form-control" style="height:200px;"></textarea>
                        <span id="friendtributeDescriptionError" style="color:red;display:none;">Required</span>
                        <input type="hidden" name="friendId" id="friendId" value="">
                     </div>
                 </div>
                </div>
                <div class="modal-footer text-right">
                   <span class="">
                       <button type="button" class="btn e-btn btn-default" onclick="$('.close').trigger('click');$('#tributeAddModal').css('z-index','1042');">Back</button>
                       <button type="button" id="publishFriendTribute" class="btn e-btn btn-primary">Publish</button>
                   </span>
               </div>
         </div>
      </div>
    </div>
</div>
