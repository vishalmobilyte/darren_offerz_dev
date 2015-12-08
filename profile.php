<?php
include('process/profile.php');
// print_r($get_user_data); die;
?>


<!----content----->
<div class="container">
<div class="row Under_Armour">
		<div class="col-md-12" style="margin-bottom:50px;">
			
			<div class="col-md-4 col-sm-4">
			<h2>User Profile</h2>
				<div class="input-group">
				<div><?php 
				if(isset($_GET['msg'])){
				echo "Profile Updated Successfully";
				}
				?></div>
					<form class="form-horizontal" id="register_form" enctype="multipart/form-data" method="POST">
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Enter Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Name" name="name" id="name" value="<?php echo $get_user_data['name'];?>" class="form-control">
								<input type="hidden"  name="client_id" id="client_id" value="<?php echo $get_user_data['id'];?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">User Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Username" name="username"  disabled value="<?php echo $get_user_data['username'];?>" id="username" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Email</label>
							<div class="col-xs-7">
								<input type="email" placeholder="email" name="email" id="email"  value="<?php echo $get_user_data['email'];?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">Upload Image:</label>
							<div class="col-xs-7">
								<input type="file" placeholder="Under Armour" name="user_image" id="user_image">
							</div>
						</div>
						<?php
						if($get_user_data['image_name'] != ''){ ?>
						
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail"></label>
							<div class="col-xs-7">
								<img src="<?php echo SITE_URL; ?>/uploads/user_images/<?php echo $get_user_data['image_name']; ?>" width="150" height="150"/>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="control-label col-xs-5" for="inputEmail">About You:</label>
							<div class="col-xs-7">
								<textarea name="description"><?php echo $get_user_data['description'];?></textarea>
							</div>
						</div>
							
						
						
						
						<div class="col-xs-7" style="float:right;">
								<input type="submit" id="submit" name="submit" value="Save">
							</div>
						
						
					</form>

				</div>
				
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

 require_once('inc/footer.php');
?>