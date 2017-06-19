<!-- line modal for text-->
<div class="modal fade" id="textInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:visible !important;">
	<div class="modal-dialog modal-box text-nsert-modal">
		<div class="modal-content modal-outer">
			<div class="modal-header modal-headernew">
				<button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Create new text entry</h3>
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
							<div class="form-group col-xs-6 col-sm-4">
								<select name="AID" id="AID" class="form-control">
								</select>
							</div>
							<div class="form-group col-xs-6 col-sm-3">
								<div class="btn e-btn btn-brown">
									<div class="fa fa-plus"></div>
										Add album
								</div>
							</div>
							<div class="form-group col-xs-6 col-sm-5">
								<div class="" id="append-div">
									<input type="text" class="form-control friendsid" name="friendsid" id="friendsid" placeholder="Type Friend Name...">
								</div>
								<div class="dropdown-div">
									<ul style="list-style-type: none;z-index: 999999; position: relative; display:none;" id="frndlist" class="frndlist">
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 71%;">
							<button class="btn btn-default" type="button" onclick="$('.close').trigger('click');" data-toggle="modal" data-target="#uploadModal" >Back</button>
							<button class="btn btn-primary" type="button" id="textPublishBtn">Publish</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
