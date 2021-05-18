<?php
	require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
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
	<form action="process.php" method="post">
		<div class="container">
			
			<div class="row">

				<div class="col-lg-3"></div>

				<div class="col-lg-6">
					<div id ="content"> 
						<h1>Sign Up</h1>
						<p>Fill up the form with correct values.</p>

						<hr class="mb-3">


						<label for="firstname"><b>First Name</b></label>
						<input class="form-control" id="firstname" type="text" name="firstname" placeholder="Enter Your First name" required>

						<label for="lastname"><b>Last Name</b></label>
						<input class="form-control" id="lastname"  type="text" name="lastname" placeholder="Enter Your Last name" required>

						<label for="email"><b>Email Address</b></label>
						<input class="form-control" id="email"  type="email" name="email" placeholder="Enter Your Email" required>

						<label for="phonenumber"><b>Phone number</b></label>
						<input class="form-control" id="phonenumber"  type="number" name="phonenumber" placeholder="Enter Your Phone number" required>
				
						<label for="password"><b>Password</b></label>
						<input class="form-control" id="password"  type="password" name="password" placeholder="Enter Your Password" required>
						<progress max="100" value = "0" id = "strength" style="width:100%"></progress>
						
						<label for="password"><b>Confirm Password</b></label>
						<input class="form-control" id="password2"  type="password" name="password2" placeholder="Confirm Your Password" required>

						<hr class="mb-3">

						<p>Already have an account?<a href="login.php?Login in=true" >	Login</a></p>

						<input class="btn btn-info btn-block" type="submit" id="register" name="create" value="Sign Up">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
	var pass = document.getElementById("password");
	
	pass.addEventListener('keyup', function() {
		checkPassword(pass.value);
	})
	
	function checkPassword(password) {
		var strength = 0;
		var strengthLine = document.getElementById("strength");
		var checker = document.getElementById("checker");
		
		if (password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)) {
			strength += 1;
		}
		if(password.match(/[~<>?]+/)) {
			strength += 1;
		}
		if(password.match(/[!@#$%^&*()]+/)) {
			strength += 2;
		}
		if(password.length >5) {
			strength += 1;
		}
		if(password.length >10) {
			strength += 1;
		}
		if(password.length >20) {
			strength += 1;
		}
		switch(strength) {
			case 0:
				strengthLine.value = 0;
				checker.html("Weak");
				break
			case 1:
				strengthLine.value = 30;
				checker.html("Need more");
				break
			case 2:
				strengthLine.value = 55;
				checker.html("Just standard");
				break
			case 3:
				strengthLine.value = 80;
				checker.html("Good");
				break
			case 4:
				strengthLine.value = 100;
				checker.html("Execellent");
				break
		}
		
	}




	$(function(){

            $('#register').click(function(e){

				var valid = this.form.checkValidity();

                if(valid){

                var firstname   = $('#firstname').val();
                var lastname    = $('#lastname').val();
                var email       = $('#email').val();
                var phonenumber = $('#phonenumber').val();
				var password    = $('#password').val();
				var password2 	= $('#password2').val();
                

                    e.preventDefault(); 

                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
						data: {firstname: firstname,lastname: lastname,email: email, phonenumber:phonenumber, 
							password: password, password2:password2},
                        success: function(data){
                        Swal.fire({
                                    'title': 'Note',
                                    'text': data,
                                    'type': 'warning'
                                    })
									
                                
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