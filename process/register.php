<?php
// die('--eeee--');
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
header("Location:".SITE_URL."/home.php");
} 
if(isset($_POST['submit'])){
// print_r($_POST); die;
$target_dir = "uploads/user_images/";
$target_file = $target_dir . basename($_FILES["user_image"]["name"]);
$target_str = md5(time().uniqid());
$target_file = $target_str.'_'.$target_file;
$uploadOk = 1;
$user_image ="";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
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
if ($_FILES["user_image"]["size"] > 5000000) {
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
		$user_image = $target_file;
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}
}
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$image_name = @$user_image;
$description = @$_POST['description'];

$sql = "INSERT INTO clients (name, username, email, password, image_name, description)
VALUES ('$name', '$username', '$email','$password','$image_name','$description')";

if ($conn->query($sql) === TRUE) {
 $last_id = $conn->insert_id;
 $_SESSION['user_id']=$last_id;
// print_r($_SESSION); die;
	$_SESSION['flash_msg']="Congratulations!! You have been registered successfully!";
	header("Location:".SITE_URL."/home.php?msg=success");
   // echo "Congratulations!! You have been registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}



?>