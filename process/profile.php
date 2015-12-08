<?php
ini_set('display_errors','0');
session_start();
include('inc/db_connection.php');
	
// die('--eeee--');
if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){

header("Location:".SITE_URL."/login.php");
} 
if(isset($_POST['submit'])){

// print_r($_POST);// die;
$user_image ="";
if(!empty($_FILES["user_image"]) && isset($_FILES["user_image"])){
//print_r($_FILES);
//die;
$target_dir = "uploads/user_images/";
$target_str = md5(time().uniqid());
$target_file_name = $target_str . $_FILES["user_image"]["name"];
$target_file = $target_dir . basename($target_file_name);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

if(!empty($_FILES["user_image"]["tmp_name"])){

    $check = getimagesize(@$_FILES["user_image"]["tmp_name"]);
    if($check !== false) {
    //    echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
  //  echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["user_image"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
    //    echo "The file ". basename( $_FILES["user_image"]["name"]). " has been uploaded.";
		$user_image = $target_file_name;
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}

}

if(!empty($user_image)){
$user_img_field = "image_name = '$user_image',";
}
else{
$user_img_field = "";

}
$name = $_POST['name'];
$id = $_POST['client_id'];
$email = $_POST['email'];
$image_name = $user_image;
$description = $_POST['description'];
// print_r($_SERVER); die;
$sql = "UPDATE clients SET 
		name = '$name', 
		".$user_img_field."
		
		email = '$email',
		description = '$description'
		WHERE id='$id'";
// echo $sql; die;
if ($conn->query($sql) === TRUE) {
header("location: profile.php?msg=success");
// print_r($_SESSION); die;
    echo "Congratulations!! You have been registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}


include('inc/header.php');
?>