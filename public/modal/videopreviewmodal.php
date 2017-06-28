<!-- line modal for text-->
<div class="modal fade previewmodal" id="videoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important;">
	<div class="modal-dialog modal-box">
		<div class="modal-content modal-outer">
			<div class="" style="background-color: rgb(180, 80, 78);">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
			    <div class="show-modal-video">
			         <div class="show-video-wrapper">
			             <div class="video-player">
                             <video width="100%" controls>
                                  <source src="/video/Wildlife.wmv" id="videolink">
                             </video>
			             </div>
			         </div>
			         <div class="show-video-description">
			             <h3 class="e-brown m-t-0 show-title text-center" style="color: rgb(180, 80, 78);" id="videoTitleLabel">new</h3>
			             <div class="text-right e-brown">
			                 <span>by</span>
			                 <a class="e-link font-bold" href="#" id="videouploadedBy"></a>
			             </div>
			             <div class="show-description m-t-15 e-brown text-justify p-b-15">
			                 <p id="videoDescription"></p>
			             </div>
			         </div>
			     </div>
			     <div class="show-adds-btns left">
			         <div class="btn e-btn btn-round full" style="background-color: rgb(180, 80, 78);" data-toggle="tooltip" data-placement="bottom" title="Tribute">0</div>
			         <div class="e-like btn e-btn btn-round full likeClick" style="background-color: rgb(180, 80, 78);" data-cmd="video" id="videoLikeCount" data-toggle="tooltip" data-placement="bottom" title="Like">0</div>
			     </div>
			     <div class="show-date" id="videoUploadedDate"></div>
			 </div>
		</div>
	</div>
</div>
