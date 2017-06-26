<div class="modal fade" id="squarespaceModalemail" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-box signin_popup">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Recovery password</h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <div id="recoverymailid">
               <form method="post" action="/authlogin/recover" enctype="multipart/form-data" name="nameform" id="recovery_form">
                  <div class="form-group  full-width">
                     <input type="text" class="form-control" id="recoveryemail" placeholder="Email">
                  </div>
                  <a id="back" data-toggle="modal" data-target="#squarespaceModal2" class="link-color use-margin" onclick="showhide();" style="cursor:pointer;">Back</a>
                  <button type="submit" value="Submit" style="display:none;"></button>
               </form>
               <div class="modal-footersec">
                  <div class="button-div">
                     <a class="modal-button" id="recoverybutton">Recovery</a> 
                     <div class="alertmesage_recovery" style="display: none;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>