<!-- line modal -->
<div class="modal fade" id="albumInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
   <div class="modal-dialog modal-box modal-photo">
      <div class="modal-content modal-outer inner-modal-photo">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal" onclick="albumClick();"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Create new Album</h3>
         </div>
         <div class="modal-body select-media-type-popup">
            <!--<form name="textAddForm" id="textAddForm" action="" method="POST" enctype="multipart/form-data">-->
            <div class="modal-body photo-popup">
               <div class="row">
                  <div class="col-md-6">
                     <form action="/createalbum/savealbum" method="post" enctype="multipart/form-data" name="formalbum" id="albumuploadform">
                        <div class="aviary-div">
                           <div class="" >
                              <div class="image-form-field " picture-name="photo" height="360" field-name="image"></div>
                              <div class="image-select">
                                 <div class="img-input">
                                    <div class="canvas-placeholder" id="canvasPlaceholdeIdalbum" style="height: 360px;">
                                       <i class="fa fa-picture-o remove-fa-picture-icon"></i>
                                       <!--<img id= 'profile_pic_thumb'/>-->
                                    </div>
                                    <div class="btn e-btn btn-primary file-input-btn" >
                                       <i class="fa fa-upload"></i>
                                       Choose photo
                                       <input name="albumImagefile" type="file" id="albumArea1">
                                       <input type = "hidden" id = "albumPath" value="">
                                       <input id="albumName" type="hidden" value="">
                                       <input id="albumFolder" type="hidden" value="">
                                       <input type = "hidden" id= "aviaryPathalbum" name= "action" value="">
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
                                    <ul style="list-style-type: none;z-index: 999999; position: relative; display:none; margin-top:4px; width:445px;" id="frndlistAlbum" class="frndlist spanClass">
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
                        <input class="form-control" type="text" placeholder="Title" id="albumTitle">
                     </div>
                     <span id="imageTitleError" style="color:red;display:none;">Required</span>
                     <div class="m-b-20 m-t-20" >
                        <textarea name="albumtextDescription" id="albumtextDescription" class="form-control" style="height:1000px;"></textarea>
                        <span id="imagetextDescriptionError" style="color:red;display:none;">Required</span>
                     </div>
                     <div class="col-sm-4 ">
                        <div id="div-editalbumphoto" class="hostt">
                        <!--<tags-input class="e-tags-input ">-->
                        	<div style="margin-top: -5px;" class="tags">
                                <ul class="input"></ul>
                                <input type="image" style="padding: 10px;" onclick="return launchalbumaviaryEditor('album_pic_thumb');" value="Edit photo" src="http://advanced.aviary.com/images/feather/edit-photo1.png" id="imgbtnEditAlbum">
                            </div>
                        <!--</tags-input>-->
                    	</div>

                      </div>
                     <div class="row error-style" style="margin-top: 32px;">
                        <div class="col-sm-6" style="padding-left: 0 !important;">
                           <div class="col-sm-10">
                              <div class="e-select" style="width:93% !important;">
                                 <!--<select>
                                    <option value="number:47" label="My chronicles" selected="selected">My chronicles</option>
                                    </select>-->
                                 <select name="AID" id="listing" class="AID">
                                    <option value="public">Public</option>
                                    <option value="friends">Friends</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6" style="padding-right: 0 !important;">
                           <div class="col-sm-12">
                              <div dropdown="" class="dropdown" id="colordropdown" style="border: 1px solid #aaa897;height: 35px;">
                                 <div dropdown-toggle="" class="select dropdown-toggle" aria-haspopup="true" aria-expanded="true" style="padding-top: 3px;">
                                    <span style="background-color: rgb(87, 153, 66); "></span><span class="color-preview" style="background-color: rgb(87, 153, 66); margin-left: 5px; padding: 0 10px;"></span><span class="color-name text-capitalize" style="color: rgb(87, 153, 66); font-size: 16px;padding-left: 7px;">green</span>
                                 </div>
                                 <div role="menu" class="colors-section dropdown-menu" aria-labelledby="single-button">
                                    <div class="e-brown font-bold m-l-xs select-title">Select a color:</div>
                                    <div class="color"><span class="color-preview" style="background-color: rgb(170, 168, 151); margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize " style="color: rgb(170, 168, 151); font-size: 16px;padding-left: 7px;">brown</span></div>
                                    <div class="color active"><span class="color-preview" style="background-color: rgb(87, 153, 66); margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize" style="color: rgb(87, 153, 66);font-size: 16px;padding-left: 7px;">green</span></div>
                                    <div class="color"><span class="color-preview" style="background-color: rgb(180, 80, 78);margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize" style="color: rgb(180, 80, 78);font-size: 16px;padding-left: 7px;">red</span></div>
                                    <div class="color"><span class="color-preview" style="background-color: rgb(179, 176, 77);margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize" style="color: rgb(179, 176, 77); font-size: 16px;padding-left: 7px;">yellow</span></div>
                                    <div class="color"><span class="color-preview" style="background-color: rgb(47, 109, 107);margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize" style="color: rgb(47, 109, 107); font-size: 16px;padding-left: 7px;">blue</span></div>
                                    <div class="color"><span  class="color-preview" style="background-color: rgb(141, 141, 141); margin-left: 5px; padding: 0 10px;"></span> <span class="color-name text-capitalize" style="color: rgb(141, 141, 141); font-size: 16px;padding-left: 7px;">grey</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="col-sm-4 m-t-xs-20">
                           <div class="btn e-btn btn-brown" >
                           	<div class="fa fa-plus"></div> Add album
                           </div>
                           </div> -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer text-right">
               <span class="" style="padding-right: 15px;">
               <button type="button" class="btn e-btn btn-default" onclick="albumClick();">Cancle</button>
               <button type="submit" class="btn e-btn btn-primary" id = "savealbumDetails">Save</button>
               </span>
            </div>
            <!--</form>-->
         </div>
      </div>
   </div>
</div>