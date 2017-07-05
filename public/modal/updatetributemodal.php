<!-- line modal for text-->
<div class="modal fade" id="tributeUpdatemodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
   <div class="modal-dialog modal-box text-nsert-modal">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Edit tribute for <span class="friendname"></span></h3>
         </div>
         <div class="modal-body select-media-type-popup">
            <form name="tributeUpdate" id="tributeUpdate" action="/tribute/tributeupdate" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="form-group col-xs-12 col-sm-12">
         </div>
                     <input class="frndId" type="hidden" name="frndId[]">
                     <div class="form-group col-xs-12 col-sm-12">
                        <textarea name="tributeDescriptionUpdate" id="tributeDescriptionUpdate" class="form-control tributeDescriptionUpdate" style="height:200px;"></textarea>
                        <span id="tributeDescriptionError" style="color:red;display:none;">Required</span>
                     </div>
                     </div>
                  </div>
                   <div class="modal-footer text-right">
               <span class="">
               <button type="submit" id="publishidtribute" class="btn e-btn btn-primary">Save</button>
               </span>
            </div>
               </div>
            </form>
         </div>
      </div>
   </div>

