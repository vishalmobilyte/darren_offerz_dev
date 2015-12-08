<?php
include('inc/header.php');
include('process/register.php');

?>


<!----content----->
<div class="container">
<div class="row Under_Armour">
		<div class="col-md-12" style="margin-bottom:50px;">
			
			<div class="col-md-4 col-sm-4">
			<h2>User Sign Up</h2>
				<div class="input-group">
					<form class="form-horizontal" id="register_form" enctype="multipart/form-data" method="POST">
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Enter Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Name" name="name" id="name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">User Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Username" name="username"  id="username" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Email</label>
							<div class="col-xs-7">
								<input type="email" placeholder="email" name="email" id="email"  class="form-control">
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputPassword">Password</label>
							<div class="col-xs-7">
								<input type="password" placeholder="Password" name="password" required id="password" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputPassword">Verify Password</label>
							<div class="col-xs-7">
								<input type="password" placeholder="Verify Password" name="vpass" id="vpass" class="form-control">
							</div>
						</div>
						
						<!--<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Upload Image:</label>
							<div class="col-xs-7">
								<input type="file" placeholder="Under Armour" name="user_image" id="user_image">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">About You:</label>
							<div class="col-xs-7">
								<textarea name = "description"></textarea>
							</div>
						</div> -->
							
						
						
						
						<div class="col-xs-7" style="float:right;">
								<input type="submit" id="submit" name="submit" value="Register">
							</div>
						
						
					</form>

				</div>
				<div style="margin-top: 50px;"><span>Already have account?</span> <a href="<?php echo SITE_URL; ?>/login.php">Login here</a></div>
			</div>
			
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	
	// -----------  VALIDATIONS  ---------------------
	//alert('eee');
	$("#register_form").validate({
    ignore: [],
    rules: {
		name: {
			required: true
			
		},
		username: {
			required: true
			
		},
		email: {
			required: true,
			remote: "check_email.php"
			
		},
		password: "required",
		vpass: {
		  equalTo: "#password"
		}
	},
		
	messages:{
		email:{
		remote: "Email Already Exists"
	}
	}
       
    });
	}); // END OF DOCUMENT READY
	</script>
<?php

// require_once('inc/footer.php');
?>