
<?php
	session_start();
	require_once('config.php');

	
?>
<?php

	$email 			= $_POST['email'];
	$password 		= $_POST['password'];
	if(!isset($_POST['remember_me'])){
			$remember = 0;
	}

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
	$_SESSION['remember'] = $remember;



	
	
	$sqlquery = "SELECT * FROM Users WHERE Email = ? AND Password = ? LIMIT 1";
	$stmtselect = $db ->prepare($sqlquery);
	$result = $stmtselect -> execute([$email, sha1($password)]);
	
	if($result){
		$user = $stmtselect->fetch(PDO::FETCH_ASSOC);		
		if($stmtselect->rowCount()>0){
			if ($remember == 'value1') {
				setcookie("email", $email, time()+(60*60*1));
				setcookie("password", $password, time()+(60*60*1));
				setcookie("remember_me", 'value1', time()+(60*60*1));
			}
			
			$_SESSION['userlogin'] = $user;
			$_SESSION['last_login_timestamp'] = time();
			setcookie("ID",$user['ID']);
			$verified = $user['Verified'];
			$date = $user['Create_time'];
			$date = strtotime($date);
			$date = date('M d Y', $date);
			if($verified==1){
				echo "Signed In";
			}else{
				echo "This account has no yet been verified. An email was sent to ".$email." on ".$date;
			}

		}else {
			echo "Incorrect Email/Password!";
		}
	} else {
		echo "There were error to connect to database.";
	}
?>

