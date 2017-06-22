<!-- line modal for text-->
<div class="modal fade" id="tributeAddModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="position: absolute !important; overflow:visible !important;">
<div role="dialog" class="modal fade offCanvas animated in" style="z-index: 1050; display: block;">
	<div class="modal-dialog">
	    <div class="modal-content">
	        <div class="offcanvas-comments animated">
	            <div class="offcanvas-comments-header">
	                <div class="pointer back-btn inline hidden-lg hidden-sm hidden-md">
	                    <div class="icon-wrapper">
	                        <span class="fa fa-chevron-left"></span>
                        </div>
                    </div>
                    <div class="comments-count" id="totalTribute"></div>
                    <div class="offcanvas-comments-title">Tributes</div>
                    <div class="pull-right btn-wrapper">
                        <div class="btn e-btn btn-brown" data-toggle="modal" data-target="#friendTributeAddModal" onclick="$('#tributeAddModal').css('z-index','0');">Add tribute</div>
                    </div>
                </div>
                <div class="offcanvas-comments-content" id="tributeAppend">  
            </div>
        </div>
    </div>
  </div>
</div>
</div>
