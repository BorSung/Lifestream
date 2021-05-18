<?php
//edit.php
include('config.php');
session_start();

$query = "SELECT * FROM Video_upload WHERE Video_id = '".$_POST["video_id"]."'";
$connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
$excute = mysqli_query($connection, $query);



$result = mysqli_fetch_array($excute);
	

foreach($excute as $row){
    $file_array = explode(".", $row["Video_name"]);
    $output['video_name'] = $file_array[0];
    $output['video_description'] = $row["Video_description"];
}

echo json_encode($output);

?>
