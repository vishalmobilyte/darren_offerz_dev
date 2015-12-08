<?php
session_start();
include('inc/db_connection.php');
	
//print_r($_SESSION); die;
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
header("location:".SITE_URL."/admin/index.php");
// die('555ee');

} 
if(isset($_POST['submit'])){
// print_r($_POST); die;
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM clients WHERE ((username='$username' AND password='$password')  OR (email='$username' AND password='$password')) AND role=2 LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
//print_r($row); die;
$_SESSION['user_id']=$row['id'];
$_SESSION['user_role']=$row['role'];

header("location:".SITE_URL."/admin");
$conn->close();

}
else{
$_SESSION['flash_msg'] = "Invalid Username/Password!";
header("location:".SITE_URL."/admin/login.php?msg=failed");

//echo "Sorry! Invalid credentials.";
}
}
require_once('header.php');
?>