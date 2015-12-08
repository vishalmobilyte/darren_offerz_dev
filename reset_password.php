<?php
include('inc/header.php');

if(isset($_GET['e']) && !empty($_GET['e']) && isset($_GET['id'])){

$email_encoded = $_GET['e'];
$id_encoded = $_GET['id'];
$email = base64_decode($email_encoded);
$user_id = base64_decode($id_encoded);
}
else{
$email = "";
$user_id = "";
}

if(isset($_POST['submit'])){
//print_r($_POST); die;
$id=$_POST['user_id'];
$password=$_POST['password'];
if(!empty($id) && !empty($password)){

	$sql=	"UPDATE users SET 
		password = '$password'
		WHERE id='$id'";	
		$result=mysqli_query($conn,$sql);
		if($result){
		echo "<h3>Password Updated Successfully!</h3>";
		}
}
else{
echo "<h3>Invalid details provided.</h3>";
}
}

//print_r($conn); die;
?>
<div class="container">
<div class="row Under_Armour">
		<div class="col-md-12" style="margin-bottom:50px;">
			
			<div class="col-md-4 col-sm-4">
			<h2>Reset Password</h2>
				<div class="input-group">
					<form class="form-horizontal" id="login_form" method="POST">
						
					
	
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputPassword">New Password</label>
							<div class="col-xs-7">
								<input type="password" placeholder="Password" name="password" required id="password" class="form-control">
								<input type="hidden" name="email"  id="email" value="<?php echo $email; ?>" />
								<input type="hidden" name="user_id"  id="user_id" value="<?php echo $user_id; ?>"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputPassword">Confirm New Password</label>
							<div class="col-xs-7">
								<input type="password" placeholder="Password" name="password" required id="password" class="form-control">
							</div>
						</div>
						
						
						<div class="col-xs-7" style="float:right;">
								<input type="submit" id="submit" name="submit" value="Update">
						</div>
					</form>
				</div>
				<div style="margin-top: 50px;"><span>Don't have account?</span> <a href="<?php echo SITE_URL; ?>/register.php">Sign Up here</a></div>
			</div>
			
		</div>
	</div>
</div>