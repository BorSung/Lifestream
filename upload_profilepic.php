<?php

//upload.php

if(isset($_POST["image"]))
{
 $data = $_POST["image"];
    
 $image_array_1 = explode(";", $data);

 $image_array_2 = explode(",", $image_array_1[1]);

 $data = base64_decode($image_array_2[1]);

 $image_Name = time() . '.png';

 file_put_contents($image_Name, $data);

 echo '<img src="'.$image_Name.'" class="img-thumbnail style="width:250px; height:250px;" />';

}

?>