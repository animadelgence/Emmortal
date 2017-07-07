<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-box signup_popup">
      <div class="modal-content modal-outer">
         <div class="modal-header modal-headernew">
            <button type="button" class="close close-new" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Create a Profile and Become Emmortal</h3>
         </div>
         <div class="modal-body">
            <!-- content goes here -->
            <div class="signupidenter">
            <form method="post" action="/authsignup/signup" enctype="multipart/form-data" name="nameform" id="signup_form">
               <div class="form-group input-box">
                  <input type="text" class="form-control signupForm" id="fname" placeholder="First Name">
               </div>
               <div class="form-group input-box">
                  <input type="text" class="form-control" id="lname signupForm" placeholder="Last Name">
               </div>
               <div class="form-group  full-width">
                  <input type="text" class="form-control signupForm" id="email" placeholder="Email">
               </div>
               <div class="form-group full-width">
                  <input type="password" class="form-control signupForm" id="password" placeholder="Password">
                  <span id = "passwordError" class='error'>Should be at least 8 characters length</span>
               </div>
               <div class="form-group full-width">
                  <input type="password" class="form-control signupForm" id="confirmPassword" placeholder="Confirm Password">
                  <span id = "confpasswordError" class='error'>doesn't match Password</span>
               </div>
                <div class="form-group full-width" >
                  <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control signupForm" id= "datepicker" placeholder="Date of birth"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
               </div>

               <button type="submit" value="Submit" style="display:none;" disabled="disabled" >Sign Up</button>
            </form>
            <div class="modal-footersec">
               <p>By clicking Sign Up, you agree to our <a class="link-color" onclick= "termsandconditions();" style = "cursor:pointer;">Terms and conditions</a></p>
               <button class="modal-button" id="signupbutton" disabled="disabled" style="cursor:not-allowed;">Sign Up</button> 
               <!--<div class="alertmesage_signup" style="display: none;"></div>-->
               <p>Already have an account? Please, <a id="signin" class="link-color" onclick="squarespaceModal2open();" style="cursor: pointer;">Sign In</a></p>
            </div>
          </div>
         </div>
      </div>
   </div>
</div>
