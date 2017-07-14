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
                     <input type="text" class="form-control loginform" id="loginemail" placeholder="Email">
                     <span id = "loginEmailError" class='error'>Invalid email or password.</span>
                  </div>
                  <div class="form-group full-width">
                     <input type="password" class="form-control loginform" id="loginpassword" placeholder="Password">
                  </div>
                  <a onclick="squarespaceModalemailopen();"  class="link-color use-margin" id="forgotmail" onclick="showhide();" style="cursor: pointer;">Forgot Password?</a>
                  <input type="button" value="Submit" style="display:none;">
               </form>
               <div class="modal-footersec">
                  <div class="button-div">
                     <button class="modal-button" id="signinbutton" disabled="disabled" style="cursor:not-allowed;">Sign IN</button> 
                     <div class="alertmesage_signin" style="display: none;"></div>
                  </div>
                  <p>Don't have an account? Please,  <a id="signup" class="link-color" onclick="squarespaceModalopen();" style="cursor: pointer;">Sign Up</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>