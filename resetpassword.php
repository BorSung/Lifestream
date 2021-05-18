<?php

$connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");

$token = $_GET['token'];
if($token){
    $token_get = mysqli_real_escape_string($connection, $token);
    $query = "SELECT * FROM Password_reset WHERE Token ='$token_get'";
    $excute = mysqli_query($connection, $query);
    if(mysqli_num_rows($excute)>0){
            $row= mysqli_fetch_array($excute);
            $token_he = $row['Token'];
            $email = $row['Email'];
    } else {
        header('location:login.php');
    }
    
}

if(isset($_POST['submit'])){
    $pw = $_POST['password'];
    $cpw = $_POST['confirmpassword'];
    $password = mysqli_real_escape_string($connection, $pw);
    $confirmpassword = mysqli_real_escape_string($connection, $cpw);
    $password_encrypted = sha1($password);
    if($password!= $confirmpassword) {
        $msg = "<div class='alert alert-danger'>Sorry, password mismatch</div>";
    }else {
        $query = "UPDATE Users set Password='$password_encrypted' WHERE Email='$email'";
        mysqli_query($connection, $query);
        $query = "DELETE FROM Password_reset WHERE Email = '$email'";
        mysqli_query($connection, $query);
        $msg = "<div class='alert alert-danger'>Password Updated. <a href='login.php' style='color:black;text-decoration: underline; font-weight: bold;' class='forgot'> Click Here to Login</a></div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ResetPassword</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.container{
			color:#fff;
		}

		#content {
			background-color: #333;
			padding: 40px;
			padding-top: 20px;
			padding-bottom: 30px;
			border-radius: 20px;
		}

		.img img{
			width: 8%;
			margin: 2%;
			margin-left: 3%;
			height: 1%;

		}
	</style>
</head>
<body>

<div class="img">
	<img src="logo.png" class="img-responsive" alt="Responsive image">
</div>

<div>
	<form action="" method="post">
		<div class="container">
			
			<div class="row">

				<div class="col-lg-3"></div>

				<div class="col-lg-6">
					<div id ="content"> 
						<h1>Reset Password</h1>

						<hr class="mb-3">

						<label for="email"><b>Email</b></label>
						<input class="form-control" type="text" name="email" readonly value ="<?php echo $email ?>"/><br>


						<label for="password"><b>Password</b></label>
                        <input class="form-control"  type="password" name="password" placeholder="Enter Your Password" /><br>
                        
                        <label for="password"><b>Confirm Password</b></label>
                        <input class="form-control"  type="password" name="confirmpassword" placeholder="Confirm Your Password" /><br>
                        
                        <hr class="mb-3">

                        <?php  if(isset($msg)){echo $msg;} ?>

						<input class="btn btn-info btn-block" type= "submit" name="submit" value="Rest Password">
						

						
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

    </body>

    </html>