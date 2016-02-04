<?php
include('inc/header.php');
include('process/twitter_functions.php');
if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){
?>
      <script type="text/javascript">
         <!--
          var url = "<?Php echo SITE_URL; ?>";
               window.location=url+"/login.php";
            
         //-->
      </script>
	  <?php
//header("Location:".SITE_URL."/login.php");
} 
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM clients WHERE id='$user_id' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
// print_r($row);
}

?>


<!----content----->
<div class="container">
	<div class="row Under_Armour">
		<div class="col-md-12">
			<div class="col-md-5 col-sm-5">
			<?php
				if($get_user_data['image_name'] != ''){ ?>
			
					<img src="<?php echo SITE_URL; ?>/uploads/user_images/<?php echo $get_user_data['image_name']; ?>" class="img-responsive f_l x_img" style="margin-bottom:21px;" width="150" height="140"/>
							
						
			<?php } else {?>
				<img alt="" class="img-responsive f_l x_img" src="img/img_x.png">
			<?php } ?>
				<p class="under_armr_text"><?php echo $row['name']; ?> </p>
				<p class="under_armr_text_btm">
				<?php
				if($get_user_data['twitter_id'] != ''){ 
				echo "@".$get_user_data['screen_name'];
				}
				?>
				</p>
				<p class="text_btm"><?php echo $row['description']; ?></p>
			</div>
			<div class="col-md-7 col-sm-7">
				<div class="col-md-3 col-sm-3">
				<?php
				if($get_user_data['twitter_id'] != ''){ 
				$tweets_count = getTweetsCount($get_user_data['screen_name']);
				$followers_count = getFollowersCount($get_user_data['screen_name']);
				$retweet_count = getRetweetsCount($get_user_data['screen_name']);
				$favorites_count = getfavoritesCount($get_user_data['screen_name']);
				}
				else{
				$tweets_count = "NA";
				$followers_count = "NA";
				$retweet_count = "NA";
				$favorites_count = "NA";
				}
				?>
					<p class="nmbr"><?php echo $tweets_count; ?><br><span class="scl_text">Tweets</span></p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p class="nmbr"><?php echo $followers_count; ?><br><span class="scl_text">Followers</span></p>	
				</div>
				<div class="col-md-3 col-sm-3">
					<p class="nmbr"><?php echo $retweet_count; ?><br><span class="scl_text">Retweets</span></p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p class="nmbr_2"><?php echo $favorites_count; ?><br><span class="scl_text">Favorites</span></p>
				</div>
			</div>
		</div>
		<div class="col-md-12">

			<img alt="" class="img-responsive f_l x_img" src="img/setting.png" onclick="toggle_profile_div();">
			<p class="edit_prfile" onclick="toggle_profile_div();">EDIT PROFILE<a href=""></a></p>
			
		</div>
	</div>
	<div class="row Under_Armour" id="profile_div">
	<img alt="" class="img-responsive f_r" src="img/cross.png" onclick="toggle_profile_div();">
		<div class="col-md-12">
		<form class="form-horizontal" id="register_form" action="process/home_profile.php" method="POST" enctype="multipart/form-data">
			<div class="col-md-4 col-sm-4">
				<div class="col-md-4 col-sm-4">
					
						<?php
						if($get_user_data['image_name'] != ''){ ?>
						
						
							<div class="col-xs-7">
								<img src="<?php echo SITE_URL; ?>/uploads/user_images/<?php echo $get_user_data['image_name']; ?>" style="margin-bottom:21px;" width="86" height="80"/>
							</div>
						
						<?php } ?>
						<input type="file" placeholder="Under Armour" name="user_image" id="user_image">
				</div>
				<div class="col-md-8 col-sm-8">
					<textarea class="form-control custom-control"  name="description" rows="3"><?php echo $get_user_data['description'];?></textarea>  
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="input-group">
						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-5">Enter Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Name" class="form-control"  name="name" id="name" value="<?php echo $get_user_data['name'];?>" class="form-control">
								<input type="hidden"  name="client_id" id="client_id" value="<?php echo $get_user_data['id'];?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-5">User Name</label>
							<div class="col-xs-7">
								<input type="text" placeholder="Username" class="form-control"  name="username"  disabled value="<?php echo $get_user_data['username'];?>" id="username" class="form-control">
							</div>
						</div>
					
					

				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="input-group">
					
						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-5">Email</label>
							<div class="col-xs-7">
								<input type="email" placeholder="email" class="form-control"  name="email" id="email"  value="<?php echo $get_user_data['email'];?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-5">Twitter</label>
							<div class="col-xs-7 twitter_form">
								<img alt="" class="img-responsive f_l x_img" src="img/twitter.png">
								<p class="twitter">
								<?php
								if($get_user_data['twitter_id'] != ''){   ?>
								<a href="unlink_twt.php" >UNLINK TWITTER</a>
								
								<?php } else {?>
								<a href="connect_twitter.php" target="blank" >LINK TWITTER</a>
								<?php } ?>
								</p>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="control-label col-xs-5"></label>
							<div class="col-xs-7 twitter_form">
								<input type="submit" name="submit" id="submit" value="Update Profile"/>
							</div>
						</div>
						
						
				</div>
			</div>
					</form>
		</div>
	</div>
	<div class="row offerz_tabs">
		<div class="col-md-12">
			<div>
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Me</a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Teams</a></li>
			  </ul>
			  <!-- Tab panes -->
			  <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<div class="col-md-4 col-sm-4">
							jkhiuyuioihj lohoiuharchitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia 
						</div>
						<div class="col-md-4 col-sm-4">
							erytw  wyweywreyt rtywty sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Exceptety ertyhrty
						</div>
						<div class="col-md-4 col-sm-4">
							erytw  sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepte
						</div>		
					</div>
				<div role="tabpanel" class="tab-pane" id="profile">
					<div class="col-md-4 col-sm-4">
							jkhiuy quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse 
						</div>
						<div class="col-md-4 col-sm-4">
							the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advanta
						</div>
						<div class="col-md-4 col-sm-4">
							upiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates r
						</div>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid social_teams">
	<div class="container">
	<!------accordian--------->
		<div class="row my_social_terms" id="teams">
			
			<div class="col-md-12 accordion_clm">
				<div class="panel-group" id="panel-527391">
				
				<!------accordian-1-------->
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<h1>My Social Teams</h1>
								<div class="col-md-1 col-sm-1" style="float: right; width:250px;">
									
									<div class="col-md-1 col-sm-1" style="width:240px;">
									<!-- <button class="create_new panel-title collapsed" data-toggle="collapse" data-parent="#panel-527391">+CREATE NEW</button> -->
									 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-527391" href="#panel-element-260016"> 
									<button class="create_new">+CREATE NEW</button>
									</a>
								</div>
								</div>
							</div>
						</div>
						<div id="panel-element-260016" class="panel-collapse collapse">
						<form class="form-horizontal" action="process/create_team.php" method="post">
							<div class="panel-body">
							<!--row t_member-->
								<div class="row t_members">
								
									<div class="col-md-12">
										<div class="col-md-6 col-sm-6">
										
											<div class="team_members">
											<input type="text" class="form-control members_email" name="team_name" placeholder="ADD TEAM NAME" required style="font-size:22px; border:none;"/>
											</div>					
											
											
											
										
											<div class="team_members">
												
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
									    <div class="new_team_right">		
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text">0<br><span class="scl_text2">TWEETS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text">0<br><span class="scl_text2">FOLLOWERS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text">0<br><span class="scl_text2">RETWEETS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text">0<br><span class="scl_text2">FAVORITES</span></p>
								</div>
								</div>
											
											<div class="col-md-4 col-sm-4"></div>
										</div>
									</div>
									
								</div>
								
								<!--/row t_member-->
								<div class="team-result">
									<div class="team_members">												
												<div class="team_members">
												<div class="form-group">	
												<div class="row">
													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
															<span class="add_team_span">+ Add Team Members</span>
													</div>
													<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
															<input type="email" class="form-control members_email" id="inputEmail" placeholder="Enter email address">
													</div>		
													<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">	
														<label for="inputEmail" class=""><a href="javascript:void(0);" class="add_email" onclick="add_email(this);">ADD EMAIL</a></label>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">	
														<input type="submit" name="submit" class="send_invites f_c" value="SAVE TEAM" />
													</div>	
													</div>
													</div>
											</div>
											</div>
											<div class="team_members">
											<div class="emails_cont">
											
											</div>
										
											
											</div>
								</div>
								
							</div>
							</form>	
						</div>
					</div>
					<!-----end-accordian-1-------->
					<?php 
					$client_id = $_SESSION['user_id'];
					$get_all_teams = get_all_teams($client_id);
					$count_teams = count($get_all_teams);
					if($count_teams > 0){
									
					//print_r($get_all_teams); die;
					foreach($get_all_teams as $team_data){ 
					$count_members = count(@$team_data['invites']);
					
					$team_id = $team_data['id'];
					?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<p class="acrdion_text"><?php echo $team_data['name']; ?><br><span class="scl_text2"><?Php echo $count_members;?> INFLUENCERS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text"><?php echo @$team_data['twitter_count_total']?@$team_data['twitter_count_total']:'0'; ?><br><span class="scl_text2">TWEETS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text"><?php echo @$team_data['followers_count']?@$team_data['followers_count']:'0'; ?><br><span class="scl_text2">FOLLOWERS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text"><?php echo @$team_data['retweets_count']?@$team_data['retweets_count']:'0'; ?><br><span class="scl_text2">RETWEETS</span></p>
								</div>
								<div class="col-md-2 col-sm-2">
									<p class="acrdion_text"><?php echo @$team_data['fav_count']?@$team_data['fav_count']:'0'; ?><br><span class="scl_text2">FAVORITES</span></p>
								</div>
								<div class="col-md-1 col-sm-1">
									<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-527391" href="#panel-element-<?php echo $team_id; ?>">
									<i class="fa fa-bars"></i>
									</a>
								</div>
							</div>
						</div>
						<div id="panel-element-<?php echo $team_id;?>" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row t_members">
									<div class="col-md-12">
									<!---->
									<div class="team-result">
									<form id="invites_form_<?php echo $team_id;?>" class="send_invites_form">
									<div class="row">										
											<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
												<h3>+ Add Team Members</h3>
											</div>									
											<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
												
													
														
															<input type="email" class="form-control members_email" id="inputEmail" placeholder="Enter email address">
														
														
											</div>
											<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
												<label for="inputEmail" class="control-label col-xs-6"><a href="javascript:void(0);" class="add_email" onclick="add_email(this);"> ADD EMAIL</a></label>
													
												
											</div>
												
											<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
											<input type="hidden" value="<?php echo $team_id;?>" name="team_id"/>
											
												
												
												<a href="javascript:void(0);" class="add_email" onclick="submit_form_invites(this);">SEND INVITES</a>
											
											
											</div>									
											
											
										
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="emails_cont">
											
												</div>
											</div>
										</div>
										</form>
										</div>
									    <!---->	
										
										<div class="col-md-6 col-sm-6">
										<?php
										if(@$team_data['invites']){
										foreach(@$team_data['invites'] as $team_member){
										if($team_member['is_accepted'] == '1'){
										$img_path = @str_replace("_normal","",$team_member['twt_img']);
										}
										else{
										$img_path = "img/img_no_user.jpg";
										}
										?>
										<div class="col-md-4 col-sm-4"><img alt="" class="img-responsive f_c" style="border-radius: 55px;" width="100" src="<?php echo $img_path; ?>"><p class="img_text"><?php echo $team_member['email']; ?></p></div>
										
										<?php }
										} ?>
											
											
											<div class="col-md-4 col-sm-4"></div>
										</div>
										
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					} // END FOREACH TEAMS
					}
					else{ ?>
						<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row" style="text-align:center;">
							<h4>No Team Created Yet!</h4>
							</div>
							</div>
							</div>
							
					<?php }
					?>
					
				</div>
			</div>
		</div>
		<!-----end-accordian--------->
	
	</div>
</div>



<div class="container">
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel-group" id="panel-527391">
			<!------accordian-5-------->
		<div class="panel panel-default" id="offers">
			<div class="panel-heading bottom_accordion">
				<div class="row">
					<div class="row my_shared_offerz">
						<div class="col-md-12">
						<div class="col-md-6 col-sm-6">
							<h1>My Shared Offerz</h1>
						</div>
						<div class="col-md-6 col-sm-6">
							<a class=" create_new panel-title collapsed" data-toggle="collapse" data-parent="#panel-5273912" href="#panel-element-new">+CREATE NEW</a>
												
						</div>
						</div>
					</div>
		
								
				</div>
			</div>
			<div id="panel-element-new" class="panel-collapse collapse">
			<div class="panel-body">
			<div class="col-md-12 editable_user">
				<!-- ============================= SEND OFFERZ TO TEAM =========================== -->
				<form role="form" action="process/create_offer.php" method="POST" enctype="multipart/form-data">
					<div class="col-md-6 col-sm-6">
						<h5>EDITABLE BY USER</h5>
						<textarea  class="form-control custom-control" rows="3" name="editable_text" id="editable_text" maxlength="124" minlength="0"  onkeyup="check_word_len_editable(this);"></textarea>  
						<h5>Not EDITABLE BY USER</h5>
						<textarea  class="form-control custom-control" rows="3" name="not_editable_text" id="not_editable_text" minlength="0" maxlength="124" onkeyup="check_word_len(this);"></textarea>  
						<div id="preview">
						<img alt="No Image" class="img-responsive f_l gallery_img" src="img/gallery.png">
						</div>
						<p class="add_photo" ><span id="add_image_offer">ADD PHOTO</span><span class="right_nmbr chars">124</span></p>
						
						<input type="submit" name="submit" class="send_invites f_c" value="SAVE & SEND OFFER" />
					</div>
					<div class="col-md-3 col-sm-3">
						<h3>CHOOSE TEAM</h3>
						 
							<?php 
							foreach($get_all_teams as $team_data){ 
							$count_members = count(@$team_data['invites']);
							$team_id = $team_data['id'];
							$team_name = $team_data['name'];
							?>
							
							<div class="radio">
							  <label class="text_radio_b"><input type="radio" required value="<?php echo $team_id; ?>" name="team_id"><?php echo $team_name; ?></label>
							</div>
							<?php } ?>
					</div>
				
					<div class="col-md-3 col-sm-3">
						
							<div class="radio">
							  <label class="text_radio_b"><input type="radio" required value="now" name="start_date">START IMMEDIATELY</label>
							</div>
							<div class="radio">
							  <label class="text_radio_b"><input type="radio" required name="start_date" value="later" onclick="showDatePicker();">CHOOSE START DATE</label>
							</div>
							<div class="dpic">
							<div id='datepicker'></div>
							</div>
							<input type="hidden" id="datepicker_val" name="date_send_on" />
						
					</div>
				</form>
		<!-- ============================= SEND OFFERZ TO TEAM ENDS =========================== -->
			</div>
			</div>
			</div>
		</div>
					
										<!-----end-accordian-5-------->	
				<?php 
				
					$get_all_offers = get_all_offers($client_id);
					$count_offers = count($get_all_offers);
					if($count_offers > 0){
					// print_r($get_all_offers); die;
					foreach($get_all_offers as $team_data){ 
					
					$count_members = count(@$team_data['invites']);
					$team_id = $team_data['id'];
					$editable_text = $team_data['editable_text'];
					$not_editable_text = $team_data['not_editable_text'];
				?>
		<div class="panel panel-default" id="listing_offers_div"> 
		
						<div class="panel-heading bottom_accordion">
							<div class="row">
								<div class="col-md-2 col-sm-2">
								
									<img alt="" width="80" height="70" class="img-responsive f_c" src="<?php echo SITE_URL;?>/uploads/offers_images/<?php echo $team_data['image_name']; ?>">
								</div>
								<div class="col-md-3 col-sm-3">
									<h5><?Php echo $editable_text; ?> </h5>
									<p class="gear">@UnderArmour <?php echo $not_editable_text; ?></p>
									
								</div>
								<div class="col-md-3 col-sm-3">
									<p class="acrdion_text"><?php echo @$team_data['twitter_count_total']?@$team_data['twitter_count_total']:'0'; ?><br><span class="scl_text2">FOLLOWERS</span></p>
								</div>
								<div class="col-md-3 col-sm-3">
									<p class="acrdion_text"><?php echo @$team_data['retweets_count']?@$team_data['retweets_count']:'0'; ?><br><span class="scl_text2">RETWEETS</span></p>
								</div>
								<div class="col-md-1 col-sm-1">
									<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-527391_<?php echo $team_id;?>" href="#panel-element-260016zzz_<?php echo $team_id;?>">
									<i class="fa fa-bars"></i>
									</a>
								</div>
							</div>
						</div>
						<div id="panel-element-260016zzz_<?php echo $team_id;?>" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row t_members">
									<div class="col-md-12">
									
									<?php
									if(count($team_data['invites'])>0){
									
									
										foreach(@$team_data['invites'] as $team_member){ 
										$img_path = @str_replace("_normal","",$team_member['twt_img']);
										?>
										<div class="col-md-4 col-sm-4"><img alt="" class="img-responsive f_c" style="border-radius: 55px;" width="100" src="<?php echo $img_path; ?>"><p class="img_text"><?php echo $team_member['email']; ?></p></div>
										<?php } }
										else{
										echo "No user has shared this offer yet!";
										}
										
										?>
										
									</div>
								</div>
							</div>
						</div>
					</div>	
					<?php } 
					}
					else{ ?>
						<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row" style="text-align:center;">
							<h4>YOU HAVEN'T CREATED ANY OFFER YET!</h4>
							</div>
							</div>
							</div>
							
					<?php } ?>
<!-- ===================== END OF ACCORDION =========================== -->	
			<span><a href="javascript:void(0);" onclick="load_offers();">Load MOre Records</a></span>
			</div>
		</div>
	</div>
</div>
<div id="ajax_form" style="display:none;">
<form id="imageform" method="post" enctype="multipart/form-data" action='process/multiplefileupload.php' style="clear:both">
Upload image: 
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photos[]" id="photoimg" />
</div>
</form>
</div>
<?php
require_once('inc/footer.php');
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="js/jquery_upload_multiple.js"></script>
   <script src="js/ajax_image.js"></script>
<script>
$(document).ready(function(){
// ---------------------- DATEPICKER -------------------------------
$( "#datepicker").datepicker({
dateFormat: 'yy-mm-dd',
 minDate: new Date(),
 constrainInput: false,
  onSelect: function(dateText, inst) {
        var date = $(this).val();
		var time = $('#datepicker_val').val(date);
        //alert(date);
    //    alert('on select triggered');
    //    $("#start").val(date + time.toString(' HH:mm').toString());

    }
	
});

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

}); // ----------  END DOCUMENT READY   ----------------------------

function load_offers(){
	//$('#loading').show();
	 $.ajax({
	 url:"ajax_offers.php",
	 type:"POST",
	 data:"offset=2",
	 cache: false,
	 success: function(response){
	// $('#loading').hide();
	 $('#listing_offers_div').append(response);

	 }

	 });
}
function showDatePicker(){

$( "#datepicker" ).datepicker( "show" );
}
// ======================== ADD EMAIL TO SEND INVITES =================

function add_email(e){
var email = $(e).parents("div.panel-collapse").find("#inputEmail").val();
var isValidEmail = validateEmail(email);
if(isValidEmail){
$(e).parents("div.panel-collapse").find("#inputEmail").val("");
var email_str = '<p class="add_email_text"><i class="fa fa-times close_icon" onclick="rem_email(this);" style="cursor:pointer;"></i>'+email+'<input type="hidden" value = "'+email+'" name="invite_emails[]"/></p>';
 $(e).parents("div.panel-collapse").find("div.emails_cont").append(email_str);
}
else{
alert("Invalid email!");
}
}
//------------------ REMOVES EMAIL ------------------------------------

function rem_email(e){
$(e).parents('p').remove();
}
// ---------------- VALIDATE EMAIL --------------------------------------
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
// =================== SUBMIT INVITES FORM WITH AJAX ====================== //
function submit_form_invites(e){
var form_data = $(e).parents("form").serialize();
var num_of_emails_invites = $(e).parents("form").find("input[name='invite_emails[]']").size();
if(num_of_emails_invites > 0){
$(e).css('cursor', 'default');

   
        $(e).html('Processing...');
	
var request = $.ajax({
  url: "<?php echo SITE_URL; ?>/process/ajax_invites.php",
  method: "POST",
  data: form_data,
  dataType: "html",
  success: function(msg){
	if(msg="success"){
		$(e).html('SEND INVITES');
		$(e).parents("div.panel-collapse").find("div.emails_cont").html("<span class='success_msg'>Invation(s) Sent Successfully!</span>");
		setTimeout(function(){
		$(e).parents("div.panel-collapse").find("div.emails_cont").html("");
		},5000);
	  $(e).css('cursor', 'pointer');
	}
  }
});
}
else{
// No Email is Entered
alert("Please enter atleast 1 email.");
}
}

// =================== SUBMIT QUERY FORM WITH AJAX ====================== //
function submit_form_query(e){
var form_data = $(e).parents("form").serialize();
var content_query = $(e).parents("form").find("#content_query").val();
if(content_query != ""){

	
var request = $.ajax({
  url: "<?php echo SITE_URL; ?>/process/ajax_submit_query.php",
  method: "POST",
  data: form_data,
  dataType: "html",
  success: function(msg){
	if(msg="success"){
		
		$(e).parents("form").find("div#response_submit_query").html("<span class='success_msg' style='text-align: center!important;'>Query Submitted Successfully!</span>");
		$(e).parents("form").find("#content_query").val("");
		setTimeout(function(){
			$(e).parents("form").find("div#response_submit_query").html("");
		},5000);
	}
  }
});
}
else{
// No Email is Entered
alert("Please enter your query.");
}
}

// =================== CHECK MAX LENGTH OF WORDS IN TEXTAREA =======================


function check_word_len(e) {
	var maxLength=124;
	var old_length = $("#not_editable_text").val().length;
	var new_val = maxLength-old_length;
	if(new_val > 0){
	var length1 = $("#editable_text").attr("maxlength",new_val);
	}
		console.log("Not editable maxlenght--"+length1);
	//var length = $(e).val().length;
	run_counter();
	
};

function check_word_len_editable(e) {
	var maxLength=124;
	var old_length = $("#editable_text").val().length;
	var new_val = maxLength-old_length;
	if(new_val > 0){
	var length1 = $("#not_editable_text").attr("maxlength",new_val);
	}
	console.log("editable maxlenght--"+length1);
	//var length = $(e).val().length;
	run_counter();
	//var length_limit = maxLength-length;
	//$('.chars').text(length_limit);
};

function run_counter(){
	var maxLength=124;
	var editable_text = $("#editable_text").val().length;
	var not_editable_text = $("#not_editable_text").val().length;
	var length = parseInt(editable_text+not_editable_text);
	var length_limit = maxLength-length;
	$('.chars').text(length_limit);
}
// ------------- Trigger Click of ajax upload ---------------------------------------

$( "#add_image_offer" ).on( "click", function() {
  $( "#photoimg" ).trigger( "click" );
});
</script>