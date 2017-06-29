<!-- line modal for text-->
<div class="modal fade previewmodal" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important;">
	<div class="modal-dialog modal-box">
		<div class="modal-content modal-outer" style="padding:5px;">
			<div class="" style="background-color: rgb(180, 80, 78);">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body-scope">
			     <div class="show-modal-photo show-body" style="margin: 20px;">
			         <div class="row full-height">
			             <div class="col-sm-6 full-height col-xs-12">
                             <div class="show-photo-wrapper full-height">
                                 <div class="image-show-wrapper">

                                     <img src="" id="imagelink">

                                     <div class="placeholder-wrapper">
                                         <div class="text-wrapper">
                                             <div class="text"><a class="imagepreview" data-target="#showimagepreview"  data-toggle="modal">Click to See Larger</a></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
			             </div>
			             <div class="col-sm-6 full-height col-xs-12">
			                 <h3 class="e-brown m-t-0 show-title" style="color: rgb(180, 80, 78);" id="imageTitleLabel"></h3>
			                 <div class="text-right e-brown">
			                     <span>by</span> 
			                     <a class="e-link font-bold" href="#" id="imageuploadedBy"></a>
			                 </div>
			                 <div class="show-description m-t-15 e-brown text-justify p-b-15">
			                     <p id="imageDescription"></p>
			                 </div>
			             </div>
			         </div>
			         <div class="show-adds-btns bottom">
			             <div class="btn e-btn btn-round full"style="background-color: rgb(180, 80, 78);" data-toggle="tooltip" data-placement="bottom" data-placement="bottom" title="Tribute">0</div>
			             <div class="e-like btn e-btn btn-round full likeClick" style="background-color: rgb(180, 80, 78);" data-cmd="image" id="ImageLikeCount" data-toggle="tooltip" data-placement="bottom" data-placement="bottom" title="Like">0</div>
			         </div>
			         <div class="show-date e-brown" id="imageUploadedDate"></div>
			     </div>
			 </div>
		</div>
	</div>
</div>
