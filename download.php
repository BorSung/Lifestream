<?php 

include('config.php');

$filename = $_POST["video_name"];

$connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");

$sql="SELECT * FROM Video_upload WHERE Video_name='".$_POST["video_name"]."'";

$result = mysqli_query($connection,$sql);

$file = mysqli_fetch_assoc($result);

$filepath = './pic/'.$file['Video_name'];





if(file_exists($filepath)){
        header('Pragma:no-cache');
        header('Content-Disposition: attachment; filename='.$file['Video_name']);
        header('Content-Type: application/mp4'); 
        header('Expeires: 0');
        readfile('./pic/'.$file['Video_name']);
        exit();

}else{
        echo "Something Wrong with Database. Please contact us.";
}

?>

