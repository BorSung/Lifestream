<?php
	require_once('config.php');
?>
<?php
 	use PHPMailer\PHPMailer\PHPMailer;
 	use PHPMailer\PHPMailer\SMTP;
 	use PHPMailer\PHPMailer\Exception;
    if(isset($_POST)){

        $firstname      = $_POST['firstname'];
        $lastname       = $_POST['lastname'];
        $email          = $_POST['email'];
        $phonenumber    = $_POST['phonenumber'];
		$password       = $_POST['password'];
		$password2       = $_POST['password2'];
        
    

		

        $sql_e = "SELECT * FROM Users WHERE Email = '$email'";
        $connection = mysqli_connect("localhost", "root", "2fded657f3c77602","Login System");
		$res_e = mysqli_query($connection, $sql_e) or die(mysqli_error($connection));
		
	
		
		

		if (mysqli_num_rows($res_e) > 0) {
			$email_error = "Sorry. This Email already taken";
			echo 'Email Already taken';
				
		} elseif($password != $password2) {
			echo 'Password mismatch!';
			
		} else {
			$vkey = md5(time().phonenumber);
			$password_encrypted       = sha1($_POST['password']); 
			$sqlquery = "INSERT INTO Users (Firstname, Lastname, Email, Phonenumber, Password, V_key) VALUES (?,?,?,?,?,?)";
			$sqlinsert = $db -> prepare($sqlquery);
        	$result = $sqlinsert -> execute([$firstname, $lastname, $email, $phonenumber, $password_encrypted, $vkey]);

			if($result){
				require 'Mail/vendor/autoload.php';
				// Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);
				$url = 'http://'.$_SERVER['SERVER_NAME'].'/verification.php?vkey='.$vkey;
				$message = 'Hi '.$firstname.'! This is the link for verify your email!.<br>'.$url;
				require 'Mail/vendor/autoload.php';
				try {
					//Server settings
					$mail->isSMTP();                                // Send using SMTP
					$mail->Host = 'mailhub.eait.uq.edu.au';         // Set the SMTP server to send through
					$mail->SMTPAuth = FALSE;                        // Enable SMTP authentication
					$mail->Port = 25;                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
					
					//Recipients
					$mail->setFrom('noreply@infs3202-2da4f03e.uqcloud.net');
					$mail->addAddress($email, $email);              // Add a recipient
					
					// Content
					$mail->isHTML(true);                            // Set email format to HTML
					$mail->Subject = 'Verification - LifeStream';
					$mail->Body = $message;
					$mail->AltBody = $message;
					$mail->send();
					echo "Reset link has been sent to your Email ID";
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
				
	
				$sql_e = "SELECT * FROM Users WHERE Email = '$email'";
				$res_e = mysqli_query($connection, $sql_e) or die(mysqli_error($connection));
				if(mysqli_num_rows($res_e)>0) {
					while ($row = mysqli_fetch_assoc($res_e)) {
						$rowID = $row['ID'];
						$imgquery = "INSERT INTO Profileimg (UserID, Status) VALUES (?,?)";
						$sqlinsert2 = $db -> prepare($imgquery);
						$result2 = $sqlinsert2 -> execute([ $rowID, 1]);
					}
				}
			}
		}
	
        

    }else {
        echo "No Data";
    }
?>

