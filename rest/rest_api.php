<?php
include('../inc/db_connection.php');
include('../inc/functions.php');
//print_r($conn); die;

$WS_obj = new Offerz_web_services();

class Offerz_web_services
{
	protected $params;
	protected $json_response = array();
	protected $ws_response = array();
	public function __construct()
	{
		
		
		$handle = fopen ( 'php://input', 'r' );
		$jsonInput = fgets ( $handle );
		$this->params = json_decode( $jsonInput );
		//	print_r($this->params); die;
		$this->process();
	}
	
	private function process()
	{
		
		if( $this->params->method == "register_user" )
		{
			$result = $this->register_user();
		}
			
		else if( $this->params->method == "login_user" )
		{
			$result = $this->login_user();
		}
		
		else if( $this->params->method == "update_user_profile" )
		{
			$result = $this->update_user_profile();
		}
    
		else if( $this->params->method == "get_requests" )
		{
			$result = $this->get_requests();
		}
		
		else if( $this->params->method == "user_stats" )
		{
			$result = $this->user_stats();
		}
		
		else if( $this->params->method == "get_offers" )
		{
			$result = $this->get_offers();
		}
		
		else if( $this->params->method == "forgot_password_user" )
		{
			$result = $this->forgot_password_user();
		}
		
		else if( $this->params->method == "get_request_response" )
		{
			$result = $this->get_request_response();
		}
		
		else if( $this->params->method == "update_user_offer" )
		{
			$result = $this->update_user_offer();
		}
    
		echo json_encode($this->ws_response);
	}
	
	private function success_failure_msgs( $code, $message, $result = array())
	{
		$currentDateTime = new \DateTime();
		if($code == 200)
		{
			$this->ws_response = array("Response"=>array("Code"=>$code,"Status"=>"OK","message"=>$message,"result"=>$result, "CurrentDateTime"=>$currentDateTime));
		}
		else
		{
			$this->ws_response = array("Response"=>array("Code"=>$code,"Status"=>"Error","message"=>$message));
		}
		return $this->ws_response;
	}	
	
	/* METHOD: register_user */
	private function register_user(){
	global $conn;
	
	if( $this->params->name && $this->params->password && $this->params->email)
		{
		$name = 	$this->params->name;
		$email = $this->params->email;
		$password = $this->params->password;
		$oauth_token = $this->params->oauth_token;
		$oauth_secret_token = $this->params->oauth_secret_token;
		$screen_name = $this->params->screen_name;
		$twitter_id = $this->params->twitter_id;
		// check if email already exisits or not in db
		 $sql_chk_email = "SELECT * from users WHERE email='$email'";
		//die;
		$result_chk_email=mysqli_query($conn,$sql_chk_email);
		$row=mysqli_fetch_array($result_chk_email,MYSQLI_ASSOC);
		
		$count=mysqli_num_rows($result_chk_email);
		//echo $count; die("--");
		if($count < 1){

		$sql=	"INSERT INTO users SET 
		name='$name', 
		email='$email',
		oauth_token='$oauth_token',
		oauth_secret_token='$oauth_secret_token',
		screen_name='$screen_name',
		twitter_id='$twitter_id',
		password='$password'"; 
		
		$result=mysqli_query($conn,$sql);
		
			if($result)
			{
				$ret_array['success']='1';
				$ret_array['message']='User Registered Successfully';
				$ret_array['user_id']=$conn->insert_id;
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "User Registered Success.", $this->json_response);
			}
			else
			{
				$msg = "Failed To Insert User!";
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
		else{
		$msg = "Email id already exisits.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
		}	
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
		/* METHOD: update_user_profiles */
	private function update_user_profile(){
	global $conn;
	// print_r($this->params); die;
	if( $this->params->name && $this->params->email && $this->params->user_id )
		{
		$name = $this->params->name;
		$email = $this->params->email;
		$user_id = $this->params->user_id;
		$password = @$this->params->password;
		$oauth_token = @$this->params->oauth_token;
		$oauth_secret_token = @$this->params->oauth_secret_token;
		$screen_name = @$this->params->screen_name;
		$twitter_id = @$this->params->twitter_id;
		// check if email already exisits or not in db
		$sql_chk_email = "SELECT * from users WHERE email='$email'";
		 
		//die;
		$result_chk_email=mysqli_query($conn,$sql_chk_email);
		$row=mysqli_fetch_array($result_chk_email,MYSQLI_ASSOC);
		$extra_qry = '';
		if($password!=''){
		$extra_qry = "password='$password',";
		}
		if($oauth_token!='' && $oauth_secret_token!='' && $screen_name!='' && $twitter_id!='' ){
		$extra_qry .= "oauth_token='$oauth_token',
		oauth_secret_token='$oauth_secret_token',
		screen_name='$screen_name',
		twitter_id='$twitter_id',";
		}
		$count=mysqli_num_rows($result_chk_email);
		//echo $count; die("--");
		if($count >0){

		$sql=	"UPDATE users SET 
		".$extra_qry."
		name='$name', 
		
		email='$email'
		WHERE id='$user_id'";
		
		$result=mysqli_query($conn,$sql);
		
			if($result)
			{
				$ret_array['success']='1';
				$ret_array['message']='User Updated Successfully';
				$ret_array['user_id']=$user_id;
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "User Update Success.", $this->json_response);
			}
			else
			{
				$msg = "Failed To Update User!";
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
		else{
		$msg = "Email id already exisits.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
		}	
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
	
	// ========================== LOGIN USER ============================
	
	private function login_user(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->email && $this->params->password )
		{
		$email = 	$this->params->email;
		$password =$this->params->password;
	
		$sql="SELECT * FROM users WHERE email='$email' and password='$password'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	 	$count=mysqli_num_rows($result);

			if($count>0)
			{
				$ret_array['success']='1';
				$ret_array['data']=$row;
				$ret_array['message']='Login User Successfully';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Login User Successfully", $this->json_response);
			}
			else
			{
				$msg = "Invalid Email or Password!";
				$ret_array['success']='0';
				$ret_array['message']='Invalid Email or Password!';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}	
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	// ========================== GET INVITES REQUESTS USER ============================
	
	private function get_requests(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->email )
		{
		$email = 	$this->params->email;
		$sql="SELECT I.*, T.name FROM invites I  JOIN teams T on I.team_id=T.id WHERE I.email='$email' AND I.is_accepted=0";
		
		$result=mysqli_query($conn,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	 	$count=mysqli_num_rows($result);
		$data_rows = array();
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$data_rows[] = $row;
		}

			if($count>0)
			{
			
				$ret_array['success']='1';
				//$ret_array['id']=$row['id'];
				$ret_array['data']=$data_rows;
				$ret_array['message']='Team Requests got Successfully';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Team Requests got Successfully", $this->json_response);
			}
			else
			{
				$msg = "No Record";
				$ret_array['success']='0';
				$ret_array['message']='No Record found.';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
			
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
	// ===================== GET RESPONSE FROM USER ======================
	private function get_request_response(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->email && $this->params->team_id && $this->params->is_accepted )
		{
		$email = 	$this->params->email;
		$team_id = 	$this->params->team_id;
		$is_accepted = 	$this->params->is_accepted;
		
		$sql="UPDATE invites SET 
							is_accepted = $is_accepted
							WHERE email='$email' AND team_id='$team_id'";
		
		$result=mysqli_query($conn,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			if($result)
			{
			
				$ret_array['success']='1';
				$ret_array['message']='Updated Successfully';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Team Requests got Successfully", $this->json_response);
			}
			else
			{
				$msg = "There was an error while updating request response.";
				$ret_array['success']='0';
				$ret_array['message']='Error in Executing Query.';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
			
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}	
	}
	
	// ========================== GET OFFERZ NEW OFFERS AND SHARED OFFERS ============================
	
	private function get_offers(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->user_id )
		{
		$user_id = 	$this->params->user_id;
		$images_path = SITE_URL.'/uploads/offers_images/';
		
		$sql="SELECT DATE_FORMAT(UO.created_at,'%b %d') AS offer_received_time, 
		(CASE
		WHEN (status = 0) THEN 'New' 
		WHEN (status = 1) THEN 'Shared' 
		WHEN (status = 2) THEN 'Declined' 
		ELSE 'Shared' 
		 END)
 
		as offer_status, UO.id as user_offer_id, O.editable_text, T.name as team_name,
		CONCAT('".$images_path."',O.image_name) as offer_image_path, O.not_editable_text, O.date_send_on as offer_start_date  
		FROM user_offers UO 
		
		LEFT JOIN offers O ON UO.offer_id = O.id  
		
		LEFT JOIN users U ON UO.user_id = U.id 
		
		LEFT JOIN teams T ON O.team_id = T.id 
		
		WHERE UO.user_id = $user_id";
		
		
		//echo $sql; die;
		$result=mysqli_query($conn,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	 	$count=mysqli_num_rows($result);
		$data_rows = array();
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$data_rows[] = $row;
		}

			if($count>0)
			{
			
				$ret_array['success']='1';
				//$ret_array['id']=$row['id'];
				$ret_array['data']=$data_rows;
				$ret_array['message']='Offers got Successfully';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Team Requests got Successfully", $this->json_response);
			}
			else
			{
				$msg = "No Record";
				$ret_array['success']='0';
				$ret_array['message']='No Record found.';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
			
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
	private function update_user_offer(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->user_id && $this->params->user_offer_id && $this->params->status )
		{
		$user_id = 	$this->params->user_id;
		$user_offer_id = 	$this->params->user_offer_id;
		$status = 	$this->params->status;
		// 0 = Not shared, 1 = Shared, 2 = Declined
		if($status == '0' || $status == '1' || $status == '2'){
		
		$sql="UPDATE user_offers SET status = $status WHERE user_id=$user_id AND id= $user_offer_id";

		//echo $sql; die;
		$result=mysqli_query($conn,$sql);

			if($result)
			{
				$ret_array['success']='1';
				$ret_array['message']='Offer Updated Successfully';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Offer Updated Successfully", $this->json_response);
			}
			else
			{
				$msg = "No Record";
				$ret_array['success']='0';
				$ret_array['message']='No Record found.';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}
		else{
				$msg = "Invalid Status Parameter";
				$ret_array['success']='0';
				$ret_array['message']='Invalid Status Parameter';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
		}
		}
			
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
	// ============= FORGOT Password ======================
	
	private function forgot_password_user(){
	global $conn;
	// echo $this->params->email; die("--3333");
	if( $this->params->email )
		{
		$email = 	$this->params->email;
	
		$sql="SELECT * FROM users WHERE email='$email'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
	 	$count=mysqli_num_rows($result);

			if($count>0)
			{
				$id = $row['id'];
				$ret_array['success']='1';
				//$ret_array['data']=$row;
				sendEmailResetPass($email,$id);
				$ret_array['message']='Email sent for reset password';
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "Email sent for reset password", $this->json_response);
			}
			else
			{
				$msg = "Email Not Found!";
				$ret_array['success']='0';
				$ret_array['message']='Email Not Found!';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		}	
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	
	private function user_stats(){
	global $conn;
	// echo $this->params->email; die("--3333");
	
	if( $this->params->user_id)
		{
		
		$user_id = 	$this->params->user_id;
		$email_user = getEmailById($user_id);
		
		$sql2 = "SELECT COUNT(*) as total_teams FROM invites WHERE email='$email_user' AND is_accepted=1";
		$result2=mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
		$total_teams_joined = $row2['total_teams'];
		
		$sql = "SELECT (CASE
		WHEN (status = 0) THEN 'New' 
		WHEN (status = 1) THEN 'Shared' 
		WHEN (status = 2) THEN 'Declined' 
		ELSE 'Shared' 
		 END) as status, COUNT(*) as count_status  FROM   user_offers WHERE user_id = ".$user_id." GROUP BY status";
		
		
		//echo $sql; die;
		$result=mysqli_query($conn,$sql);
		$total_shared ='';
		$total_declined ='';
		$total_new ='';
		$total_received ='';
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		
		if($row['status'] == 'Shared'){
		
		$total_shared = $row['count_status'];
		}
		elseif($row['status'] == 'Declined'){
		
		$total_declined = $row['count_status'];
		}
		
		elseif($row['status'] == 'New'){
		
		$total_new = $row['count_status'];
		}
		else{
		
		}
		}
		$total_received_offer = $total_shared+$total_declined+$total_new;
	 	//$count=mysqli_num_rows($result);
		
			if($result)
			{
				$ret_array['success']='1';
				$ret_array['message']='User\'s';
				$ret_array['total_shared']=$total_shared;
				$ret_array['total_received']=$total_received_offer;
				$ret_array['total_teams_joined']=$total_teams_joined;
				array_push($this->json_response,$ret_array);
				$this->success_failure_msgs(200, "User Stats", $this->json_response);
			}
			else
			{
				$msg = "No Record";
				$ret_array['success']='0';
				$ret_array['message']='No Record found.';
				array_push($this->json_response,$ret_array);
				//echo("Validation errors:<br/>");
				
				$this->success_failure_msgs(301, $msg, $this->json_response);
			}
		
		}
			
		else
		{
		$msg = "Required Parameters Are Missing.";
		$this->json_response = "";
		$this->success_failure_msgs(301, $msg, $this->json_response);
		}
			
	}
	

}

?>