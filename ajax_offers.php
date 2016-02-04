<?php
include('inc/db_connection.php');
include('inc/functions.php'); 
$user_id = 5;

$sql = "SELECT * FROM clients WHERE id='$user_id' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
// print_r($row);
}


					$offset=2;
					$get_all_offers = get_all_offers($user_id,$offset);
					$count_offers = count($get_all_offers);
					if($count_offers > 0){
					// print_r($get_all_offers); die;
					foreach($get_all_offers as $team_data){ 
					
					$count_members = count(@$team_data['invites']);
					$team_id = $team_data['id'];
					$editable_text = $team_data['editable_text'];
					$not_editable_text = $team_data['not_editable_text'];
				?>
		<div class="panel panel-default"> 
		
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
					
					
