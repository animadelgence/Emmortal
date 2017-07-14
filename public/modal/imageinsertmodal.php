<!-- line modal -->
<div class="modal fade" id="photoInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
	<div class="modal-dialog modal-box modal-photo">
		<div class="modal-content modal-outer inner-modal-photo">
			<div class="modal-header modal-headernew">
				<button type="button" class="close close-new" data-dismiss="modal" onclick="photoClick();"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Create new image</h3>
			</div>
			<div class="modal-body select-media-type-popup">
				<!--<form name="textAddForm" id="textAddForm" action="" method="POST" enctype="multipart/form-data">-->
					<div class="modal-body photo-popup">
						<div class="row">
							<div class="col-md-6">
                                <form action="/image/saveimage" method="post" enctype="multipart/form-data" name="form1" id="imageuploadform">
                                    <input type= "hidden" value= "" id ="uploadId"/>
                                    <div class="aviary-div">
                                        <div class="" >
                                            <div class="image-form-field " picture-name="photo" height="360" field-name="image"></div>
                                            <div class="image-select">
                                                <div class="img-input">
                                                    <div class="canvas-placeholder" id="canvasPlaceholdeId" style="height: 360px;">
                                                        <i class="fa fa-picture-o remove-fa-picture-icon"></i>
                                                        <!--<img id= 'profile_pic_thumb'/>-->
                                                    </div>
                                                    <div class="btn e-btn btn-primary file-input-btn" >
                                                        <i class="fa fa-upload"></i>
                                                        Choose photo
                                                        <input name="file" type="file" id="imageArea1">
                                                        <input type = "hidden" id = "imagePath" value="">
                                                        <input type = "hidden" id = "imageName" value="">
                                                        <input type = "hidden" id = "imageFolder" value="">
                                                        <input type = "hidden" id= "aviaryPath" name= "action" value="">

                                                    </div>
                                                    <span id="imagePathError" style="color:red;display:none;">No image Selected</span>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </form>
								<div class="m-t-20">
									<div class="tags-input-wrapper" >
										<!--<tags-input class="e-tags-input " placeholder="Type friend name..." min-length="1" >-->
											<div class="host">
												<div class="tags">
													
                                                    <div class="auto-listing-div" id="append-div-image">
                                                        <input type="text" class="e-tags-input friendsids" name="friendsid" placeholder="Type Friend Name..." id ="imageFriend">
                                                        <!--<span id="imageFriendError" style="color:red;display:none;">Required</span>-->
                                                    </div>
                                                    <div class="dropdown-div">
                                                        <ul style="list-style-type: none;z-index: 999999; position: relative; display:none; margin-top:4px; width:445px;" id="frndlistImage" class="frndlist spanClass">
                                                        </ul>
                                                    </div>
                                                </div>
											</div>
										<!--</tags-input>-->
									</div>

								</div>
							</div>
							<div class="col-md-6 m-t-xs-20">
								<div class="m-b-10">
									<input class="form-control" type="text" placeholder="Title" id="imageTitle">

								</div>
                                <span id="imageTitleError" style="color:red;display:none;">Required</span>
								<div class="m-b-20 m-t-20" >
									<textarea name="imagetextDescription" id="imagetextDescription" class="form-control" style="height:353px;"></textarea>
								    <span id="imagetextDescriptionError" style="color:red;display:none;">Required</span>
								</div>
								<div class="row error-style" style="margin-top: 46px;">
									<div class="col-sm-4 ">
                                        <div class="hostt" id="div-editphoto">
                                            <!--<tags-input class="e-tags-input ">-->
                                                
                                                <div class="tags" style = "margin-top: -5px;">
                                                    <ul class="input"></ul>
                                                    <input id="imgbtnEditPhoto" type="image" src="http://advanced.aviary.com/images/feather/edit-photo.png" value="Edit photo" onclick="return launchEditor('profile_pic_thumb');" style="padding: 10px;"/>
                                                </div>
                                                
                                            <!--</tags-input>-->
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
										<div class="e-select">
											<!--<select>
												<option value="number:47" label="My chronicles" selected="selected">My chronicles</option>
											</select>-->
                                            <select name="AID" id="listing" class="AID-image">
								            </select>
										</div>
									</div>
									<div class="col-sm-4 m-t-xs-20">
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
							<button type="button" class="btn e-btn btn-default" onclick="photoClick();">Back</button>
							<button type="submit" class="btn e-btn btn-primary" id = "saveDetails">Publish</button>
						</span>
					</div>
				<!--</form>-->
			</div>
		</div>
	</div>
</div>
