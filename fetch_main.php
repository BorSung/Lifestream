<?php


include('config.php');

$query = "SELECT * FROM Video_upload ORDER BY Video_id DESC";


$connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");

$excute = mysqli_query($connection, $query);

$result = mysqli_fetch_array($excute);
	
$number_of_rows = mysqli_num_rows($excute);


$output = '';




$output .= '
 	<table class="table table-bordered table-striped">
  	<tr>
   	<th>No</th>
   	<th>Video</th>
   	<th>Name</th>
   	<th>Description</th>
   	<th>Download</th>
  	</tr>
';

if($number_of_rows > 0) {

	$count = 0;

	foreach($excute as $row){

		$count ++; 
		$output .= '
		<tr>
		<td>'.$count.'</td>
		
		<td><video controls src="pic/'.$row["Video_name"].'" class="img-thumbnail" width="250px" height="300px"/></td>
		<td width="250px">'.$row["Video_name"].'</td>
		<td width="300px">'.$row["Video_description"].'</td>
		<td><button type="button" class="btn btn-warning btn-xs download" id="'.$row["Video_name"].'"> Download</button></td>
		</tr>
		';

	}
	
} else {
	$output .= '
  	<tr>
   <td colspan="6" align="center">No Data Found</td>
  	</tr>
 	';
}

$output .= '</table>';

echo $output;

?>