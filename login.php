<?php
// include('inc/header.php');
include('process/login.php');
?>
<!----content----->
<div class="container">
<div class="row Under_Armour">
		<div class="col-md-12" style="margin-bottom:50px;">
			
			<div class="col-md-4 col-sm-4">
			<h2>User Login</h2>
				<div class="input-group">
					<form class="form-horizontal" id="login_form" method="POST">
						
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Username/Email</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Username" name="username"  id="username" class="form-control">
							</div>
						</div>
	
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputPassword">Password</label>
							<div class="col-xs-7">
								<input type="password" placeholder="Password" name="password" required id="password" class="form-control">
							</div>
						</div>
						
						<div class="col-xs-7" style="float:right;">
								<input type="submit" id="submit" name="submit" value="Login">
						</div>
					</form>
				</div>
				<div style="margin-top: 50px;"><span>Don't have account?</span> <a href="<?php echo SITE_URL; ?>/register.php">Sign Up here</a></div>
			</div>
			
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	setTimeout(function(){$("span.success").slideUp();},8000);
	setTimeout(function(){$("span.failed").slideUp();},8000);
	// -----------  VALIDATIONS  ---------------------
	//alert('eee');
	$("#login_form").validate({
    ignore: [],
    rules: {
	name: {
		required: true
		
	},
	username: {
		required: true
		
	},
	email: {
		required: true
		
	},
	password: "required",
    vpass: {
      equalTo: "#password"
    }
		}
       
    });
	}); // END OF DOCUMENT READY
	</script>
<?php

// require_once('inc/footer.php');
?>