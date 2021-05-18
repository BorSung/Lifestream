<?php
//update.php

include('config.php');
session_start();

$video_id = $_POST["video_id"];

if(isset($_POST["video_id"])){


    $video_name = $_POST["video_name"];
    $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
    $old_name = get_old_video_name($connection, $_POST["video_id"]);
    $file_array = explode(".", $old_name);
    $file_extension = end($file_array);
    $new_name = $video_name . '.' . $file_extension;

    $query = '';

    if($old_name != $new_name) {
        $old_path = './pic/'.$old_name;
        $new_path = './pic/'.$new_name;
        if(rename($old_path, $new_path)){ 
        $query = "UPDATE Video_upload SET Video_name = '".$new_name."', Video_description = '".$_POST["Video_description"]."' WHERE Video_id = '".$_POST["Video_id"]."'";
        }
    } else {
    $query = "UPDATE Video_upload SET Video_description = '".$_POST["Video_description"]."' WHERE Video_id = '".$_POST["Video_id"]."'";
    }
    $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
    $excute = mysqli_query($connection, $query);
    
}

function get_old_video_name($connect, $video_id) {
 $query = "SELECT Video_name FROM Video_upload WHERE Video_id = '".$video_id."'";
 $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
 $excute = mysqli_query($connection, $query);
 $result = mysqli_fetch_array($excute);
 
 foreach($excute as $row)
 {
  return $row["Video_name"];
 }
}

?>