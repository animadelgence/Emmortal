<!-- line modal for text-->
<div class="modal fade" id="tributemodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
   <div class="modal-dialog modal-box text-nsert-modal">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Create new tribute</h3>
         </div>
         <div class="modal-body select-media-type-popup">
            <form name="tributecreate" id="tributecreate" action="/tribute/tributesubmit" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="form-group col-xs-12 col-sm-12">  
            <div id="append-div-tribute" class="">
            <input type="text" placeholder="Type Friend Name..." class="friendsids" id="friendsidtribute" name="friendsid" class="form-control" style="width:100%;">
            </div>
            <div class="dropdown-div">
            <ul class="frndlists" id="frndlisttribute" style="list-style-type: none;z-index: 999999; position: relative; display:none;">
            </ul>
            </div>
            
            <span id="tributefriendError" style="color:red;display:none;">Required</span>
         </div>
            
                     <div class="form-group col-xs-12 col-sm-12">
                        <textarea name="tributeDescription" id="tributeDescription" class="form-control" style="height:200px;"></textarea>
                        <span id="tributeDescriptionError" style="color:red;display:none;">Required</span>
                     </div>
                        <div class="dropdown-div">
                           <ul style="list-style-type: none;z-index: 999999; position: relative; display:none;" id="frndlist" class="frndlist">
                           </ul>
                        </div>
                     </div>
                  </div>
                   <div class="modal-footer text-right">
               <span class="">
               <button type="button" class="btn e-btn btn-default">Back</button>
               <button type="submit" id="publishidtribute" class="btn e-btn btn-primary" id="publishid">Publish</button>
               </span>
            </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
