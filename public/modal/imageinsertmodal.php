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
											<div class="btn e-btn btn-primary file-input-btn ng-scope" >
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
									<text-angular class="ng-pristine ng-untouched ng-valid ng-isolate-scope ta-root" ng-model="ngModel">
										<div class="ng-scope ng-isolate-scope ta-toolbar btn-toolbar" name="textAngularToolbar2402683519906137" text-angular-toolbar="">
											<div class="btn-group">
												<button type="button" class="btn btn-default ng-scope" name="bold" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Bold" unselectable="on" disabled="disabled">
													<i class="fa fa-bold"></i>
												</button>
												<button type="button" class="btn btn-default ng-scope" name="italics" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Italic" unselectable="on" disabled="disabled">
													<i class="fa fa-italic"></i>
												</button>
												<button type="button" class="btn btn-default ng-scope" name="underline" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Underline" unselectable="on" disabled="disabled">
													<i class="fa fa-underline"></i>
												</button>
												<button type="button" class="btn btn-default ng-scope" name="strikeThrough" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Strikethrough" unselectable="on" disabled="disabled">
													<i class="fa fa-strikethrough"></i>
												</button>
											</div>
											<div class="btn-group">
												<button type="button" class="btn btn-default ng-scope" name="ul" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Unordered List" unselectable="on" disabled="disabled">
													<i class="fa fa-list-ul"></i>
												</button>
												<button type="button" class="btn btn-default ng-scope" name="ol" ta-button="ta-button" ng-disabled="isDisabled()" tabindex="-1" ng-click="executeAction()" ng-class="displayActiveToolClass(active)" title="Ordered List" unselectable="on" disabled="disabled">
													<i class="fa fa-list-ol"></i>
												</button>
											</div>
										</div>
										<div class="ta-scroll-window ng-scope ta-text ta-editor form-control" ng-hide="showHtml">
											<div style="max-width: none; width: 305px;" class="popover fade bottom">
												<div class="arrow"></div>
												<div class="popover-content"></div>
											</div>
											<div class="ta-resizer-handle-overlay">
												<div class="ta-resizer-handle-background"></div>
												<div class="ta-resizer-handle-corner ta-resizer-handle-corner-tl"></div>
												<div class="ta-resizer-handle-corner ta-resizer-handle-corner-tr"></div>
												<div class="ta-resizer-handle-corner ta-resizer-handle-corner-bl"></div>
												<div class="ta-resizer-handle-corner ta-resizer-handle-corner-br"></div>
												<div class="ta-resizer-handle-info"></div>
											</div>
											<div contenteditable="true" id="taTextElement2402683519906137" ta-bind="ta-bind" ng-model="html" class="ng-pristine ng-untouched ng-valid ta-bind">
												<p><br></p>
											</div>
										</div>
									</text-angular>
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
