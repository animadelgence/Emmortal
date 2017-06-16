<!-- line modal -->
<div class="modal fade" id="videoInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:visible !important;">
	<div class="modal-dialog modal-box modal-photo">
		<div class="modal-content modal-outer inner-modal-photo">
			<div class="modal-header modal-headernew">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Add new Video</h3>
			</div>
			<div class="modal-body select-media-type-popup">
				<form name="textAddForm" id="textAddForm" action="http://emmortal.localhost/profile/publishtext" method="POST" enctype="multipart/form-data">
					<div class="modal-body photo-popup">
						<div class="row">
							<div class="col-md-6">
								<div class="ng-scope">
									<div class="image-form-field ng-isolate-scope" height="360"></div>
									<div class="image-select">
										<div class="img-input ng-isolate-scope">
											<div class="canvas-placeholder" style="height: 360px;">
												<i class="fa fa-picture-o"></i>
											</div>
											<div class="btn e-btn btn-primary file-input-btn ng-scope">
												<i class="fa fa-upload"></i>
												Choose
												<span class="ng-binding">photo</span>
												<input class="ng-isolate-scope" type="file">
											</div>
										</div>
									</div>
								</div>
								<div class="m-t-20">
									<div class="tags-input-wrapper ng-isolate-scope ng-valid">
										
									</div>

								</div>
							</div>
							<div class="col-md-6 m-t-xs-20">
									<input class="form-control ng-pristine ng-valid-maxlength ng-valid ng-valid-required ng-touched" type="text" placeholder="Title">
								</div>
								<div class="m-b-20 m-t-20 ng-isolate-scope ng-valid">
									
								</div>
								<div class="row ng-scope">
									<div class="col-sm-5">
										<div class="e-select">
											<select class="ng-pristine ng-untouched ng-valid">
												<option value="number:47" label="My chronicles" selected="selected">My chronicles</option>
											</select>
										</div>
									</div>
									<div class="col-sm-7 m-t-xs-20">
										<div class="btn e-btn btn-brown ng-isolate-scope" target="photo" albums="albums">
											<div class="fa fa-plus"></div> Add album
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer text-right">
						<span class="ng-scope">
							<button type="button" class="btn e-btn btn-default">Back</button>
							<button type="submit" class="btn e-btn btn-primary">Publish</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
