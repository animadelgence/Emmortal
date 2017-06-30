<!-- line modal -->
<div class="modal fade" id="videoInsertModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:scroll !important;">
    <div class="modal-dialog modal-box modal-photo">
        <div class="modal-content modal-outer inner-modal-photo">
            <div class="modal-header modal-headernew">
                <button type="button" class="close close-new" data-dismiss="modal" onclick="videoClick();"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Add new Video</h3>
            </div>
            <div class="modal-body select-media-type-popup">
                
                <div class="modal-body photo-popup">
                    <div class="row">
                        <div class="col-md-6">
                            <form name="videoupload" id="videoupload" action="/video/videosubmit" method="POST" enctype="multipart/form-data">
                                <div class="">
                                    <div class="image-form-field " picture-name="photo" height="360" field-name="image"></div>
                                    <div class="image-select">
                                        <div class="img-input">
                                            <div class="canvas-placeholder" id="canvas-placeholderid" style="height: 230px;">
                                                <i class="fa fa-video-camera"></i>
                                            </div>
                                            <div class="btn e-btn btn-primary file-input-btn">
                                                <i class="fa fa-upload"></i> Choose
                                                <span class="">video</span>
                                                <input class="" type="file" id="file" name="file">

                                            </div>
                                            <span id="videouploaderror" style="color:red;display:none;">Required</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
            
                            <div class="m-t-20">
                                <div class="tags-input-wrapper">
                                    <div class="host">
                                        <div class="tags">
                                            <div id="append-div-video" class="">
                                                <input type="text" placeholder="Type Friend Name..." class="e-tags-input friendsids" id="friendsidvideo" name="friendsid" class="form-control" style="width:100%;">
                                            </div>
                                            <div class="dropdown-div">
                                                <ul class="frndlists" id="frndlistvideo" style="list-style-type: none;z-index: 999999; position: relative; display:none;">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-t-xs-20">
                            <div class="m-b-10">
                                <input class="form-control" type="text" placeholder="Title" name="title" id="title">
                                <span id="videoTitleError" style="color:red;display:none;">Required</span>
                            </div>
                            <input type="hidden" class="uploadedvideo" name="uploadedvideo" id="uploadedvideo">
                            <div class="m-b-20 m-t-20">

                                <textarea name="videoDescription" id="videotextDescription" class="form-control" style="height:353px;"></textarea>
                                <span id="videotextDescriptionError" style="color:red;display:none;">Required</span>
                            </div>
                            <div class="errormsg" style="display:none;">
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="e-select">
                                        <select id="AID" class="AID-class form-control" name="AID">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-7 m-t-xs-20">
                                    <div class="btn e-btn btn-brown">
                                        <div class="fa fa-plus"></div> Add album
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <span class="">
                       <button type="button" class="btn e-btn btn-default" onclick="videoClick();">Back</button>
                       <button type="submit" class="btn e-btn btn-primary" id="publishid">Publish</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
</div>
