<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");

    if($_POST){
        
        $email = $_POST['email'];
        $selectquery = mysqli_query($connection, "SELECT * FROM Users WHERE Email = '{$email}'") or die(mysqli_error($connection));
        $count = mysqli_num_rows($selectquery);
        $row = mysqli_fetch_array($selectquery);
        $id = $row['ID'];
        
        
        

        if($count>0){
            // Import PHPMailer classes into the global namespace
            // These must be at the top of your script, not inside a function
            
            $token = uniqid(md5(time()));
            $query = "INSERT INTO Password_reset(ID,Email, Token) VALUES (NULL,'$email','$token')";
            if(mysqli_query($connection, $query)){
                $url = 'http://'.$_SERVER['SERVER_NAME'].'/resetpassword.php?token='.$token;
                $message = 'Hi there! This is the link for rest your password!.<br>'.$url; 
                require 'Mail/vendor/autoload.php';
            
                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);
                
                try {
                    //Server settings
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'mailhub.eait.uq.edu.au';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = FALSE;                                   // Enable SMTP authentication
                    $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                    //Recipients
                    $mail->setFrom('noreply@infs3202-2da4f03e.uqcloud.net');
                    $mail->addAddress($email, $email);     // Add a recipient
                
                    $password = sha1($row['Password']);
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Forgot Password - LifeStream';
                    $mail->Body    = $message;
                    $mail->AltBody = $message;
                
                    $mail->send();
                    echo "<script>alert('Reset link has been sent to your Email ID')</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
                }
            }
            // Load Composer's autoloader
            
        } else {
            echo "<script>alert('Email Not Found')</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.container{
			color:#fff;
		}

		#content {
			background-color: #333;
			padding: 60px;
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
	<form method="post">
		<div class="container">
				<div class="col-lg-3"></div>

				<div class="col-lg-6">
					<div id ="content"> 
						<h1>Forgot Password</h1>

						<hr class="mb-3">

						<label for="email"><b>User Email</b></label>
                        <input class="form-control" id="email"  type="email" name="email" placeholder="Enter Your User Email" /> 
                        <br/>
                        <?php  if(isset($msg)){echo $msg;} ?>
                        <input type="submit" class="btn btn-info btn-block" id="login" name="create" value="Submit">

                        <hr class="mb-3">
						
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

    </body>
    </html>