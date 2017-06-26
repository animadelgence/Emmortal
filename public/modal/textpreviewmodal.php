<!-- line modal for text-->
<div class="modal fade" id="textPreviewModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:visible !important;">
	<div class="modal-dialog modal-box">
		<div class="modal-content modal-outer">
			<div class="modal-header modal-headernew" style="background-color: rgb(180, 80, 78);">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="textTitleLabel"></h3>
			</div>
			<div class="modal-body">
			    <div class="show-modal-text show-body">
			        <div class="text-right e-brown m-b-10">
			            <span>by</span> 
			            <a class="e-link font-bold" href="#" id="textuploadedBy"></a>
			         </div>
			         <div class="show-description m-t-15 e-brown text-justify p-b-15 ta-bind">
			         <p id="textTitleDescription"></p>
			         </div>
			         <div class="show-adds-btns">
			             <div class="btn e-btn btn-round full" style="background-color: rgb(180, 80, 78);"  data-toggle="tooltip" title="Tribute">0</div>
			             <div class="e-like btn e-btn btn-round full likeClick" style="background-color: rgb(180, 80, 78);" data-cmd="text" id="TextLikeCount" data-toggle="tooltip" title="Like"></div>
			         </div>
			         <div class="show-date" id="textUploadedDate" ></div>
			     </div>
			 </div>
		</div>
	</div>
</div>
