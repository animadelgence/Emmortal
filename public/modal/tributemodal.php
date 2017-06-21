<!-- line modal for text-->
<div class="modal fade" id="tributemodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:visible !important;">
   <div class="modal-dialog modal-box text-nsert-modal">
      <div class="modal-content modal-outer" style="height: 450px; ">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Create new tribute</h3>
         </div>
         <div class="modal-body select-media-type-popup">
            <form name="textAddForm" id="textAddForm" action="/profile/publishtext" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="form-group col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="textTitle" id="textTitle" placeholder="Title">
                           <span id="textTitleError" style="color:red;display:none;">Required</span>
                     </div>
                     <div class="form-group col-xs-12 col-sm-12">
                        <textarea name="textDescription" id="textDescription" class="form-control" style="height:200px;"></textarea>
                        <span id="textDescriptionError" style="color:red;display:none;">Required</span>
                     </div>
                        <div class="dropdown-div">
                           <ul style="list-style-type: none;z-index: 999999; position: relative; display:none;" id="frndlist" class="frndlist">
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 71%;">
                     <button class="btn btn-default" type="button" onclick="$('.close').trigger('click');" data-toggle="modal" data-target="#uploadModal" >Back</button>
                     <button type="submit" ng-disabled="!user.id" class="btn e-btn btn-primary" disabled="disabled">Publish</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
