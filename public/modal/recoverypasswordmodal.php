<div class="modal fade" id="squarespaceModalepassword" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-box signin_popup">
  <div class="modal-content modal-outer">
    <div class="modal-header modal-headernew">
      <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <h3 class="modal-title" id="lineModalLabel">Recovery password</h3>
    </div>
    <div class="modal-body">
      
            <!-- content goes here -->
      <form method="post" action="/authlogin/resetpassword" enctype="multipart/form-data" name="nameform" id="resetpassword_form">
<!--              </div>-->
                <div class="form-group full-width">
                <input type="password" class="form-control" id="forgetpassword" placeholder="Password">
              </div>
                <div class="form-group full-width">
                <input type="password" class="form-control" id="forgetconfirmPassword" placeholder="Confirm Password">
              </div>
               
                <button type="submit" value="Submit" style="display:none;"></button>
      </form>
            <div class="modal-footersec">
                <div class="button-div">
                  <a class="modal-button" id="savepassbutton">Save</a> 
                  <div class="alertmesage_recoverypassword" style="display: none;"></div>
                </div>
            </div>
    </div>
  </div>
  </div>
</div>