<div class="modal fade" id="squarespaceModal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-box signin_popup">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Sign In</h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <div class="loginid">
               <form method="post" action="/authlogin/login" enctype="multipart/form-data" name="nameform" id="login_form">
                  <div class="form-group  full-width">
                     <input type="text" class="form-control" id="loginemail" placeholder="Email">
                  </div>
                  <div class="form-group full-width">
                     <input type="password" class="form-control" id="loginpassword" placeholder="Password">
                  </div>
                  <a data-toggle="modal" data-target="#squarespaceModalemail" class="link-color use-margin" id="forgotmail" onclick="showhide();" style="cursor: pointer;">Forgot Password?</a>
                  <button type="submit" value="Submit" style="display:none;"></button>
               </form>
               <div class="modal-footersec">
                  <div class="button-div">
                     <a class="modal-button" id="signinbutton">Sign IN</a> 
                     <div class="alertmesage_signin" style="display: none;"></div>
                  </div>
                  <p>Don't have an account? Please,  <a id="signup" class="link-color" data-toggle="modal" data-target="#squarespaceModal" onclick="$('.close').trigger('click');" style="cursor: pointer;">Sign Up</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>