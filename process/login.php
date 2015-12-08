<?php
session_start();
include('inc/db_connection.php');
	
//print_r($_SESSION); die;
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
header("location:".SITE_URL."/home.php");
// die('555ee');

} 
if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM clients WHERE (username='$username' AND password='$password')  OR (email='$username' AND password='$password') LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$_SESSION['user_id']=$row['id'];
header("location:".SITE_URL."/home.php");
$conn->close();

}
else{
$_SESSION['flash_msg'] = "Invalid Username/Password!";
header("location:".SITE_URL."/login.php?msg=failed");

//echo "Sorry! Invalid credentials.";
}
}
require_once('inc/header.php');
?>