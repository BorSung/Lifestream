<?php
//upload.php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('config.php');
session_start();

$connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
$email = $_SESSION['email'];
$email_get = mysqli_real_escape_string($connection, $email);
echo print_r($email_get);


if(count($_FILES["file"]["name"]) > 0){

  sleep(3);

  for($count=0; $count<count($_FILES["file"]["name"]); $count++) {

    $file_name = $_FILES["file"]["name"][$count];
    $tmp_name = $_FILES["file"]['tmp_name'][$count];
    $file_array = explode(".", $file_name);
    $file_extension = end($file_array);

    if(file_already_uploaded($file_name, $connection)) {
    $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
    }
    $location = './pic/'. $file_name;

    if(move_uploaded_file($tmp_name, $location)){
    $query = "INSERT INTO Video_upload (Video_name, Video_description, Useremail) VALUES ('".$file_name."', '', '$email_get')";
    $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
    $excute = mysqli_query($connection, $query);
    } 

  }

}

function file_already_uploaded($file_name, $c) {
  $query = "SELECT * FROM Video_image WHERE image_name = '".$file_name."'";
  $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
  $excute = mysqli_query($connection, $query);
  $number_of_rows = mysqli_num_rows($excute);

 if($number_of_rows > 0){
  return true;
 }
 else{
  return false;
 }
 
}

?>
