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


function get_all_teams($client_id=null){
global $conn;
$sql = "SELECT * FROM teams WHERE client_id=".$client_id." ORDER BY created_at DESC";
$result = $conn->query($sql);

$return_array = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
//$return_array['teams'][] = $row;

$sql2 = "SELECT * FROM invites WHERE team_id = ".$row['id']." ORDER BY created_at ASC";
$result2 = $conn->query($sql2);


if ($result2->num_rows > 0) {
while($row2 = $result2->fetch_assoc()){
$row['invites'][] = $row2;
}
}
$return_array[] = $row;
}
}

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
//$return_array['teams'][] = $row;

$sql2 = "SELECT * FROM invites WHERE team_id = ".$team_id;
$result2 = $conn->query($sql2);


if ($result2->num_rows > 0) {
while($row2 = $result2->fetch_assoc()){
$row['invites'][] = $row2;
}
}
$return_array[] = $row;
}
}

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


?>