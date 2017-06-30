<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$protocolPath = $protocol . $_SERVER['HTTP_HOST'];
?>
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-box">
		<div class="modal-content modal-outer">
			<div class="modal-header modal-headernew">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">What are you going to add?</h3>
			</div>
			<div class="modal-body select-media-type-popup">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 add-content-section">
						<div class="col-xs-6 col-sm-4">
							<a class="btn btn-default btn-media-type pointer" onclick="imagemodalopen();" href="javascript:void(0)" id="photoInsert">
								<i class="fa fa-camera"></i>
								<div class="text">Photo</div>
							</a>
						</div>
						<div class="col-xs-6 col-sm-4">
							<a class="btn btn-default btn-media-type pointer" onclick="videomodalopen();" href="javascript:void(0)" id="videoInsert">
								<i class="fa fa-video-camera"></i>
								<div class="text">Video</div>
							</a>
						</div>
						<div class="col-xs-6 col-sm-4">
							<a class="btn btn-default btn-media-type pointer" onclick="textmodalopen();" href="javascript:void(0)" id="textInsert">
								<i class="fa fa-file-text-o"></i>
									<div class="text">Text</div>
							</a>
						</div>
						<div class="col-xs-6 col-sm-4">
							<a class="btn btn-default btn-media-type pointer" onclick="albummodalopen();" href="javascript:void(0)">
								<i class="fa fa-book"></i>
								<div class="text">Album</div>
							</a>
						</div>
						<div class="col-xs-6 col-sm-4">
							<a class="btn btn-default btn-media-type pointer" onclick="tributemodalopen();" id="tributeinsert" href="javascript:void(0)">
								<i class="fa fa-file-text"></i>
								<div class="text">Tribute</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 add-page-section">
						<div class="add-page-wrapper">
							<a class="btn btn-default btn-media-type pointer add-page-btn" href="javascript:void(0);">
								<i class="fa fa-plus"></i>
								<div class="text">Create new page</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
