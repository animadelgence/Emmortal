

<!-- line modal -->
<div class="modal fade ng-isolate-scope e-modal in" id="videoInsertModal">
<div class="modal-dialog modal-lg"  tabindex="-1" role="dialog" >
   <div class="modal-content modal-outer">

      <div class="modal-header modal-headernew">
				<button data-dismiss="modal" class="close close-new" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 id="lineModalLabel" class="modal-title">Add new Video</h3>
			</div>
      <form class="ng-pristine ng-scope ng-valid-max-tags ng-valid-min-tags ng-valid-leftover-text ng-valid-maxlength ng-valid ng-valid-required">
         <div class="modal-body video-popup">
            <div class="row">
               <div class="col-md-6">
                  <div class="show-video-wrapper">
                     <div class="video-input ng-isolate-scope" height="230">
                        <div class="canvas-placeholder" style="height: 230px;">
                        <i class="fa fa-video-camera"></i>
                        </div>
                        <div class="btn e-btn btn-primary file-input-btn"><i class="fa fa-upload"></i> Choose video<input type="file" accept="video/3gpp,video/mp4,video/x-msvideo,video/x-flv,video/x-m4v,video/*"></div>
                     </div>
                  </div>
                  <div class="m-t-20">
                     <div class="tags-input-wrapper ng-isolate-scope ng-valid">
                       
                      
                     </div>
                  </div>
               </div>
               <div class="col-md-6 m-t-xs-20">
                  <div class="m-b-10 ng-isolate-scope ng-valid" placeholder="Title">
                     <input type="text" placeholder="Title" required="ngRequired" class="form-control ng-pristine ng-untouched ng-valid-maxlength ng-valid ng-valid-required">
                  </div>
                  <div class="m-b-20 m-t-20 ng-isolate-scope ng-valid">
                     
                  </div>
                 
                  <div class="row ng-scope">
                     <div class="col-sm-5">
                        <div class="e-select">
                           <select class="ng-pristine ng-untouched ng-valid">
                              <option value="number:46" label="My chronicles" selected="selected">My chronicles</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-7 m-t-xs-20">
                        <div class="btn e-btn btn-brown ng-isolate-scope" target="video">
                           <div class="fa fa-plus"></div>
                           Add album
                        </div>
                     </div>
                  </div>
                
               </div>
            </div>
         </div>
         <div class="modal-footer text-right">
           <span class="ng-scope"><button type="button" class="btn e-btn btn-default">Back</button><button type="submit" class="btn e-btn btn-primary">Publish</button></span>
         </div>
      </form>
   </div>
</div>
</div>

