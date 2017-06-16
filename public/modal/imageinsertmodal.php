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
								<div class="ng-scope" >
									<div class="image-form-field ng-isolate-scope" picture-name="photo" object="photo" height="360" field-name="image" errors="errors.image"></div>
									<div class="image-select">
										<div class="img-input ng-isolate-scope" selected-image="object[field]" picture-name="photo" on-remove="removeImage" keep-aspect="keepAspect" height="height">
											<div class="canvas-placeholder" style="height: 360px;">
												<i class="fa fa-picture-o"></i>
											</div>
											<div class="btn e-btn btn-primary file-input-btn ng-scope" >
												<i class="fa fa-upload"></i>
												Choose
												<span class="ng-binding">photo</span>
												<input class="ng-isolate-scope" type="file" img-cropper-fileread="" image="cropper.sourceImage" accept="image/*">
											</div>
										</div>
									</div>
								</div>
								<div class="m-t-20">
									<div class="tags-input-wrapper ng-isolate-scope ng-valid" ng-model="photo.tagged_users" errors="errors['tags.user']">
										<tags-input class="e-tags-input ng-pristine ng-untouched ng-valid ng-isolate-scope ng-valid-max-tags ng-valid-min-tags ng-valid-leftover-text" placeholder="Type friend name..." ng-model="ngModel" min-length="1" display-property="first_name" add-from-autocomplete-only="true">
											<div class="host" ti-transclude-append="" ng-click="eventHandlers.host.click()" tabindex="-1">
												<div class="tags" ng-class="{focused: hasFocus}">
													<ul class="tag-list"></ul>
													<input class="input ng-pristine ng-untouched ng-valid" type="text" ti-autosize="" ti-bind-attrs="{type: options.type, placeholder: options.placeholder, tabindex: options.tabindex, spellcheck: options.spellcheck}" ng-disabled="disabled" ng-class="{'invalid-tag': newTag.invalid}" ng-trim="false" ng-paste="eventHandlers.input.paste($event)" ng-blur="eventHandlers.input.blur($event)" ng-focus="eventHandlers.input.focus($event)" ng-keydown="eventHandlers.input.keydown($event)" ng-model-options="{getterSetter: true}" ng-model="newTag.text" autocomplete="off" placeholder="Type friend name..." style="width: 132px;" spellcheck="true">
													<span class="input" style="visibility: hidden; width: auto; white-space: pre; display: none;">Type friend name...</span>
												</div>
												<auto-complete class="ng-scope ng-isolate-scope" template="directives/e-tags-input/template.html" source="getFriends($query)" min-length="1" load-on-down-arrow="true" debounce-delay="300"></auto-complete>
											</div>
										</tags-input>
									</div>

								</div>
							</div>
							<div class="col-md-6 m-t-xs-20">
								<div class="m-b-10 ng-isolate-scope ng-valid" ng-class="{'has-error': errors.length}" placeholder="Title" ng-model="photo.title" errors="errors.title">
									<input class="form-control ng-pristine ng-valid-maxlength ng-valid ng-valid-required ng-touched" type="text" placeholder="Title" ng-required="ngRequired" ng-model-options="{debounce: debounce}" ng-model="ngModel" ng-disabled="ngDisabled" ng-change="onChange()" min="min" maxlength="maxlength" max="max">
								</div>
								<div class="m-b-20 m-t-20 ng-isolate-scope ng-valid" ng-class="{'has-error': errors.length}" ng-model="photo.description" errors="errors.description">
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
								<div ng-if="!photo.id" class="row ng-scope">
									<div class="col-sm-5">
										<div class="e-select">
											<select ng-options="album.id as album.title for album in albums" ng-model="photo.album_id" e-select="" class="ng-pristine ng-untouched ng-valid">
												<option value="number:47" label="My chronicles" selected="selected">My chronicles</option>
											</select>
										</div>
									</div>
									<div class="col-sm-7 m-t-xs-20">
										<div ng-click="createAlbumModal()" class="btn e-btn btn-brown ng-isolate-scope" target="photo" albums="albums">
											<div class="fa fa-plus"></div> Add album
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer text-right"><!-- ngIf: !photo.id -->
						<span ng-if="!photo.id" class="ng-scope">
							<button type="button" ng-click="back()" class="btn e-btn btn-default">Back</button>
							<button type="submit" class="btn e-btn btn-primary">Publish</button>
						</span><!-- end ngIf: !photo.id --><!-- ngIf: photo.id -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
