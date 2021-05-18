<?php
$vkey = $_GET['vkey'];
if($vkey){ 
    $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
    $vkey_get = mysqli_real_escape_string($connection, $vkey);
    $sql = "SELECT Verified,V_key FROM Users WHERE V_key = '$vkey_get' LIMIT 1";
    $res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if($res->num_rows==1){
        $update_query= "UPDATE Users SET Verified =1 WHERE V_key ='$vkey_get' LIMIT 1";
        $update = mysqli_query($connection, $update_query) or die(mysqli_error($connection));
        if($update){
            echo "Your account has been verified. You may login now";
        } else{
            echo $mysqli->error;
        }
    } else {
       echo "This account invalid or already verified.";
    }
} else {
    die("Something went wrong");
}
?>

<html>
    <head>
    </head>
    <body>

    </body>
    
</html>