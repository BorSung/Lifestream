<?php
	session_start();
	require_once('config.php');
	require_once('google_config.php');

	$loginURL = $gClient->createAuthUrl();

	if(isset($_SESSION['access_token']) || isset($_SESSION['userlogin'])){
		header('Location: profile.php');
	}


	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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

		.forgot{
			float:right;
			margin-right:10px;
		}
	</style>
</head>
<body>

<div class="img">
	<img src="logo.png" class="img-responsive" alt="Responsive image">
</div>

<div>
	<form action="login.php" method="post">
		<div class="container">
			
			<div class="row">
				<div

				<div class="col-lg-3"></div>

				<div class="col-lg-6">
					<div id ="content"> 
						<h1>Login</h1>

						<hr class="mb-3">

						<label for="email"><b>Email</b></label>
						<input class="form-control" id="email" type="text" name="email" value= "<?php if(isset($_COOKIE["email"])){echo $_COOKIE["email"];}?>"  placeholder="Enter Your Email" />


						<label for="password"><b>Password</b></label>
						<input class="form-control" id="password"  type="password" name="password" value= "<?php if(isset($_COOKIE["password"])){echo $_COOKIE["password"];}?>"placeholder="Enter Your Password" /><br>

						<input type="checkbox" name="remember_me" value="value1" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?> /><b>		Remember Me<b>

						<hr class="mb-3">


						<p>Don't have an account?<a href="registration.php?Sign Up=true">	Sign Up</a> <a href="forgotpassword.php?check=Yes" style="color:white;text-decoration: underline;" class="forgot"> Forgot Password</a> </p>

						<input class="btn btn-info btn-block" type="submit" id="login" name="create" value="Sign In">
						<input class="btn btn-danger btn-block"  type="button" onclick="window.location = '<?php echo $loginURL ?>'" id="loginwG" name="create" value="Sign In with Google">

						
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
			$('#login').click(function(e){

				var valid = this.form.checkValidity();

				if(valid){

				var email 		= $('#email').val();
				var password 	= $('#password').val();
				var remember 	= $('remember_me').val();
				

					e.preventDefault();	

					$.ajax({
						type: 'POST',
						url: 'loginprocess.php',
						data: {email: email,password: password, remember:remember},
						success: function(data){
						Swal.fire({
									'title': 'Successful',
									'text': data,
									'type': 'success'
									});
						if($.trim(data) == "Signed In") {
							setTimeout('window.location.href= "profile.php"', 2000);
						}
								
						},
						error: function(data){
							Swal.fire({
									'title': 'Errors',
									'text': data,
									'type': 'error'
									})
						}
					});

					
				}else{
					
				}

				



			});		

			
	});

</script>

</body>
</html>