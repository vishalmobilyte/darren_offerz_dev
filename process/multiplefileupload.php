<?php
error_reporting(0);
include('../inc/db_connection.php');

define ("MAX_SIZE","20000"); // 20MB MAX file size
function getExtension($str)
{
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
// Valid image formats 
$valid_formats = array("jpg", "png", "gif","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
$img_path = SITE_URL.'/uploads/offers_images/';
$uploaddir = "../uploads/offers_images/"; //Image upload directory
foreach ($_FILES['photos']['name'] as $name => $value)
{
$filename = stripslashes($_FILES['photos']['name'][$name]);
$size=filesize($_FILES['photos']['tmp_name'][$name]);
//Convert extension into a lower case format
$ext = getExtension($filename);
$ext = strtolower($ext);
//File extension check
if(in_array($ext,$valid_formats))
{
//File size check
if ($size < (MAX_SIZE*1024))
{ 
//$image_name=str_replace(" ", "_",time().$filename); 
$image_name=time().'.'.$ext; 
$offer_id = @$_REQUEST['offer_id_temp'];

echo "<img src='".SITE_URL.'timthumb.php?src='.$img_path.$image_name."&w=250&h=150' class='imgList'><input type='hidden' id='image_name' name='image_name' value='".$image_name."' /><input type='hidden' id='offer_id' value='".$offer_id."'/>"; 
$newname=$uploaddir.$image_name; 
//Moving file to uploads folder
if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
{ 
$time=time(); 
//Insert upload image files names into user_uploads table
//mysql_query("INSERT INTO user_uploads(image_name,user_id_fk,created) VALUES('$image_name','$session_id','$time')");
}
else 
{ 
echo 'You have exceeded the size limit! so moving unsuccessful!'; } 
}

else 
{ 
echo '<span class="imgList">You have exceeded the size limit!</span>'; 
} 

} 

else 
{ 
echo 'Unknown extension!. Only png, Jpg or gif images allowed.'; 
} 

} //foreach end

} 
?>