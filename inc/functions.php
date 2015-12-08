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

$sql = "SELECT * FROM teams WHERE client_id=".$client_id." ORDER BY created_at DESC";
$result = $conn->query($sql);

$return_array = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
//$return_array['teams'][] = $row;

	//$sql2 = "SELECT * FROM invites WHERE team_id = ".$row['id']." ORDER BY created_at ASC";
	$sql2 = "SELECT U.*, I.team_id, I.is_accepted FROM invites I JOIN users U ON U.email = I.email WHERE I.team_id = ".$row['id']." ORDER BY I.created_at ASC";
	$result2 = $conn->query($sql2);


	if ($result2->num_rows > 0) {
	$tweets_count = 0;
	$followers_count = 0;
	$retweets_count = 0;
	$fav_count = 0;
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
	$sql2 = "SELECT U.*, I.team_id,I.email as email_user, I.is_accepted, UO.status as offer_status FROM invites I JOIN users U ON U.email = I.email JOIN user_offers UO WHERE (I.team_id = ".$team_id." AND I.is_accepted=1) AND (UO.status !=2 AND UO.offer_id=".$offer_id.") ORDER BY I.created_at ASC";
//	echo "<hr>";
	$result2 = $conn->query($sql2);


	if ($result2->num_rows > 0) {
	$tweets_count = 0;
	$followers_count = 0;
	$retweets_count = 0;
	$fav_count = 0;
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
	$return_array[] = $row;
	}
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