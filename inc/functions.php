<?php
function get_user_data($id){
global $conn;
// print_r($_SESSION); die('--');
$sql = "SELECT * FROM clients WHERE id='$id' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
return $row;
}
else{
return false;
}
}

// get_all_teams

function get_all_teams($client_id=null){
global $conn;

$sql = "SELECT * FROM teams WHERE client_id=".$client_id." AND (is_deleted='0' OR is_deleted='') ORDER BY created_at DESC";
$result = $conn->query($sql);

$return_array = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
//$return_array['teams'][] = $row;

	$sql2 = "SELECT * FROM invites WHERE team_id = ".$row['id']." ORDER BY created_at ASC";
	//$sql2 = "SELECT U.*, I.team_id, I.is_accepted FROM invites I JOIN users U ON U.email = I.email WHERE I.team_id = ".$row['id']." ORDER BY I.created_at ASC";
	$result2 = $conn->query($sql2);


	if ($result2->num_rows > 0) {
	$tweets_count = 0;
	$followers_count = 0;
	$retweets_count = 0;
	$fav_count = 0;
	while($row2 = $result2->fetch_assoc()){
	
		$invite_email = $row2['email'];
		$screen_name = getTwtScreenNameByEmail($invite_email);
		//$screen_name = $row2['screen_name'];
		$is_accepted = $row2['is_accepted'];
		$profile_img ='';
		//$screen_name = 'vkarora42';
		if($screen_name !='' && $is_accepted=='1'){
		
		$userTimelineObj = getUserTimeline($screen_name);
		// print_r($userTimelineObj); die;
		$profile_img = $userTimelineObj->user->profile_image_url;
		$tweets_count = $tweets_count + $userTimelineObj->user->statuses_count;
		$followers_count = $followers_count + $userTimelineObj->user->followers_count;
		$fav_count = $fav_count + $userTimelineObj->user->favourites_count;
		$retweets_count = $retweets_count + getRetweetsCount($screen_name);
			/*$tweets_count = $tweets_count + getTweetsCount($screen_name);
			$followers_count = $followers_count + getFollowersCount($screen_name);
			$retweets_count = $retweets_count + getRetweetsCount($screen_name);
			$fav_count = $fav_count + getfavoritesCount($screen_name);*/
		}
		$row2['twt_img'] = $profile_img;

		$row['invites'][] = $row2;
	}
	$row['twitter_count_total'] = $tweets_count;
	$row['followers_count'] = $followers_count;
	$row['retweets_count'] = $retweets_count;
	$row['fav_count'] = $fav_count;
	}
$return_array[] = $row;
}
}
//print_r($return_array); die;
return $return_array;

}

// ================= GET ALL OFFERS ================

function get_all_offers($client_id=null){
global $conn;

$sql = "SELECT * FROM offers WHERE client_id=".$client_id." ORDER BY created_at DESC";
$result = $conn->query($sql);

$return_array = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
$team_id=$row['team_id'];
$offer_id=$row['id'];
//$sql2 = "SELECT * FROM invites WHERE team_id = ".$row['id']." ORDER BY created_at ASC";
	 $sql2 = "SELECT U.*, I.team_id,I.email as email_user, I.is_accepted, UO.status as offer_status FROM invites I JOIN users U ON U.email = I.email JOIN user_offers UO ON U.id=UO.user_id WHERE (I.team_id = ".$team_id." AND I.is_accepted=1) AND (UO.status =1 AND UO.offer_id=".$offer_id.") ORDER BY I.created_at ASC";
//	echo "<hr>";
	 $result2 = $conn->query($sql2);
	//die('--');
	if (@$result2->num_rows > 0) {
	$tweets_count = 0;
	$followers_count = 0;
	$retweets_count = 0;
	$fav_count = 0;
	$row['invites'] = array();
	while($row2 = $result2->fetch_assoc()){
	
		$screen_name = $row2['screen_name'];
		$is_accepted = $row2['is_accepted'];
		$profile_img ='';
		//$screen_name = 'vkarora42';
		if($screen_name !='' && $is_accepted=='1'){
		
		$userTimelineObj = getUserTimeline($screen_name);
		// print_r($userTimelineObj); die;
		$profile_img = $userTimelineObj->user->profile_image_url;
		$tweets_count = $tweets_count + $userTimelineObj->user->statuses_count;
		$followers_count = $followers_count + $userTimelineObj->user->followers_count;
		$fav_count = $fav_count + $userTimelineObj->user->favourites_count;
		// print_r(getRetweetsCount($screen_name));
		$retweets_count = $retweets_count + getRetweetsCount($screen_name);
			/*$tweets_count = $tweets_count + getTweetsCount($screen_name);
			$followers_count = $followers_count + getFollowersCount($screen_name);
			$retweets_count = $retweets_count + getRetweetsCount($screen_name);
			$fav_count = $fav_count + getfavoritesCount($screen_name);*/
		}
		$row2['twt_img'] = $profile_img;

		$row['invites'][] = $row2;
	}
	$row['twitter_count_total'] = $tweets_count;
	$row['followers_count'] = $followers_count;
	$row['retweets_count'] = $retweets_count;
	$row['fav_count'] = $fav_count;
	$row['offer_id'] = $offer_id;
	
	}
	$return_array[] = $row;
}
}
// print_r($return_array); die;
return $return_array;

}


// ================= GET ALL Support Queries ================

function get_all_client_queries($client_id=null){
global $conn;

$sql = "SELECT * FROM client_queries WHERE client_id=".$client_id." ORDER BY created_at DESC" ;
$result = $conn->query($sql);

$return_array = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
//$return_array['teams'][] = $row;
$return_array[] = $row;
}
}
return $return_array;

}

// ====================== GET ID BY EMAIL =====================

function getIdByEmail($email){
global $conn;
	$sql = "SELECT * FROM users WHERE email='".$email."' LIMIT 1" ;
	$result = $conn->query($sql);

	$return_id = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	//$return_array['teams'][] = $row;
	$return_id= $row['id'];
	}
	}
	//echo "-".$return_id; die;
	return $return_id;

}

// ================== GET EMAIL BY ID ===================================

// ====================== GET ID BY EMAIL =====================

function getEmailById($id){
global $conn;
	$sql = "SELECT email FROM users WHERE id='".$id."' LIMIT 1" ;
	$result = $conn->query($sql);

	$return_id = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	//$return_array['teams'][] = $row;
	$return_id= $row['email'];
	}
	}
	//echo "-".$return_id; die;
	return $return_id;

}
// ================ INVITES EMAIL EXISTS CHECK ==============

function chkTeamMemAlreadyExists($email,$team_id){
	global $conn;
	 $client_by_team_id_qry = "SELECT id FROM invites WHERE email='$email' AND team_id=$team_id";
		//echo $sql; die;
	$client_by_team_id_qry_result = $conn->query($client_by_team_id_qry);
	$rows = $client_by_team_id_qry_result->num_rows;
//	print_r($row); die;
	
	return $rows;
}

function getTwtScreenName($id){
global $conn;
	$sql = "SELECT screen_name FROM users WHERE id='".$id."' LIMIT 1" ;
	$result = $conn->query($sql);

	$return_screen_name = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	//$return_array['teams'][] = $row;
	$return_screen_name= $row['screen_name'];
	}
	}
	return $return_screen_name;

}

function getTwtScreenNameByEmail($email){
global $conn;
	$sql = "SELECT screen_name FROM users WHERE email='".$email."' LIMIT 1" ;
	$result = $conn->query($sql);

	$return_screen_name = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	//$return_array['teams'][] = $row;
	$return_screen_name= $row['screen_name'];
	}
	}
	return $return_screen_name;

}

function getTotalImpressions($screen_name){
global $conn;
	$TotalImpressions = 0;
		//echo "--".$screen_name."--"; die('---');
	if(!empty($screen_name)){
		$userTimelineObj = getUserTimeline($screen_name);
		//print_r($userTimelineObj); die('--www');
		$followers_count = $userTimelineObj->user->followers_count;
	}
	
	
	return $TotalImpressions;

}
// ===== GET Stripe customer by id ==============

function GetUserFieldById($id,$field_name){
global $conn;
	 $sql = "SELECT ".$field_name." FROM clients WHERE id='".$id."' LIMIT 1" ;
	$result = $conn->query($sql);

	$fieldNameVal = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	//$return_array['teams'][] = $row;
	$fieldNameVal= $row[$field_name];
	}
	}
	return $fieldNameVal;

}

// ===== GET SUBCSRIPTION DETAIL BY CLIENT ID ==============
function getSubcDetail($client_id){
global $conn;
	$sql = "SELECT * FROM subscriptions WHERE client_id='".$client_id."' LIMIT 1" ;
	$result = $conn->query($sql);

	$row = "";
	if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	}
	//print_r($row); die;
	return $row;

}
// ===== GET PLAN DETAIL BY PLAN ID ==============
function getPlanDetail($plan_id){
global $conn;
	$sql = "SELECT * FROM plans WHERE id='".$plan_id."' LIMIT 1" ;
	$result = $conn->query($sql);

	$row = "";
	if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	}
//	print_r($row); die;
	return $row;

}
// ==================== chkUserClientRel ================

function chkUserClientRel($user_email,$client_id){
	global $conn;
	$sql = "SELECT * FROM users_clients_relation WHERE user_email='".$user_email."' AND client_id=".$client_id." LIMIT 1" ;
	$result = $conn->query($sql);

	$row = "";
	if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	}
//	print_r($row); die;
	
	return $row;

}

// ================ UPDATE INVITES  ==========================

function update_invites($status_request,$user_email,$client_id){
	
	global $conn;
	$sql = "SELECT T.id from teams T WHERE T.client_id=$client_id";
	$result = $conn->query($sql);
	$row = "";
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	$row_arr[]=$row['id'];
	}
	}
	$ids = implode(',',$row_arr);
	//print_r($row_arr); die;
	if($status_request == '2'){
	
	$sql_updt_invt_qry = "DELETE FROM invites WHERE email='$user_email' AND team_id IN ($ids)";
	}
	else{
	$sql_updt_invt_qry = "UPDATE invites I SET I.is_accepted=$status_request WHERE email='$user_email' AND team_id IN ($ids)";
	}
//	echo $sql_updt_invt_qry; die;
	$sql_updt_invt_qry_result = $conn->query($sql_updt_invt_qry);
	
	return $row;
}

// =================== SEND FORGOT PASS EMAIL TO RESET PASS =============

function sendEmailResetPass($email,$id){

	$to = $email;
	$subject = "Offerz - Reset Password";
	$encoded_email = base64_encode($email);
	$encoded_id = base64_encode($id);
	$message = "
	<html>
	<head>
	<title>Offerz - Reset Password</title>
	</head>
	<body>
	<h2>Reset Password Request</h2>
	<table>

	<tr>
	<td>Hi $email ,</td>
	</tr>
	<tr><td>Please click the link below to reset your password.</td></tr>
	<tr><td><a href='".SITE_URL."/reset_password.php?id=".$encoded_id."&e=".$encoded_email."'>Reset Password Here</a></td></tr>
	</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <mailer@betasoftdev.com>' . "\r\n";
	//$headers .= 'Cc: viskumar@betasoftsystems.com' . "\r\n";

	mail($to,$subject,$message,$headers);
	
}


?>