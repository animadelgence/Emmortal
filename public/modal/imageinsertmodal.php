<!-- line modal -->
<div class="modal fade" id="photoInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
	<div class="modal-dialog modal-box modal-photo">
		<div class="modal-content modal-outer inner-modal-photo">
			<div class="modal-header modal-headernew">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Create new text entry</h3>
			</div>
			<div class="modal-body select-media-type-popup">
				<form name="textAddForm" id="textAddForm" action="" method="POST" enctype="multipart/form-data">
					<div class="modal-body photo-popup">
						<div class="row">
							<div class="col-md-6">
								<div class="" >
									<div class="image-form-field " picture-name="photo" height="360" field-name="image"></div>
									<div class="image-select">
										<div class="img-input">
											<div class="canvas-placeholder" style="height: 360px;">
												<i class="fa fa-picture-o"></i>
											</div>
											<div class="btn e-btn btn-primary file-input-btn" >
												<i class="fa fa-upload"></i>
												Choose
												<span class="">photo</span>
												<input class="" type="file">
											</div>
										</div>
									</div>
								</div>
								<div class="m-t-20">
									<div class="tags-input-wrapper" >
										<tags-input class="e-tags-input " placeholder="Type friend name..." min-length="1" >
											<div class="host">
												<div class="tags">
													<ul class="tag-list"></ul>
													<input class="input" type="text" autocomplete="off" placeholder="Type friend name..." style="width: 132px;" spellcheck="true">
													<span class="input" style="visibility: hidden; width: auto; white-space: pre; display: none;">Type friend name...</span>
												</div>
											</div>
										</tags-input>
									</div>

								</div>
							</div>
							<div class="col-md-6 m-t-xs-20">
								<div class="m-b-10">
									<input class="form-control" type="text" placeholder="Title" >
								</div>
								<div class="m-b-20 m-t-20" >
									<textarea name="imagetextDescription" id="imagetextDescription" class="form-control" style="height:353px;"></textarea>
								    <span id="imagetextDescriptionError" style="color:red;display:none;">Required</span>
								</div>
								<div class="row">
									<div class="col-sm-5">
										<div class="e-select">
											<select>
												<option value="number:47" label="My chronicles" selected="selected">My chronicles</option>
											</select>
										</div>
									</div>
									<div class="col-sm-7 m-t-xs-20">
										<div class="btn e-btn btn-brown" >
											<div class="fa fa-plus"></div> Add album
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer text-right">
						<span class="">
							<button type="button" class="btn e-btn btn-default">Back</button>
							<button type="submit" class="btn e-btn btn-primary">Publish</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
