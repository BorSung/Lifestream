<?php
//delete.php

include('config.php');

if(isset($_POST["video_id"])) {

 $file_path = './pic/' . $_POST["video_name"];
 
 if(unlink($file_path)){

  $query = "DELETE FROM Video_upload WHERE Video_id = '".$_POST["video_id"]."'";
  $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
  $excute = mysqli_query($connection, $query);

 }
}

?>