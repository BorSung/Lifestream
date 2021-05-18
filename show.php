<?php
	session_start();
    require_once "config.php";
    require_once "google_config.php";

	if (!isset($_SESSION['access_token'])) {
		header('Location: login.php');
		exit();
    }

    if(isset($_GET['logout'])){
        unset($_SESSION['access_token']);
        $gClient -> revokeToken();
        session_destroy();
        header('Location: login.php');
    }

    if(isset($_SESSION['access_token'])){
        if((time() - $_SESSION['last_login_timestamp'])> 900) {
            session_destroy();
            unset($_SESSION);
            header("Location: login.php");
        } 
	} else {
        header("Location: profile.php");
    }
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile Page</title>
  <script src="js/jquery.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
  <script src="js/croppie.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/croppie.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<style type="text/css">
		.container-fluid{
			background-color:#333;
			padding: 20px;
		}
		

		.navbar-header img{
			width:70%;
		}

		.container-fluid span{
			font-size:20px;
			font-weight: bold;
			color: #fff;
			margin-right:10px;
		}

		.container-fluid li{
			font-size:16px;
		}

		.headerimg img{
			width:8%;
			margin-bottom: -50px;
		}

		.container p{
			font-family: 'Lobster', cursive;
			font-size: 100px;
			text-align: center;
			margin:20%;
			margin-top:19%;
			letter-spacing: 5px;
			
		}

		body {
			background: url(DSCF1412.jpg);
  			background-repeat: no-repeat;
			background-size: cover;
		}

		
	</style>
</head>
<body>

    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="headerimg">
        <a href="welcome.php?"><img src="logo2.png" class="img-responsive" alt="Responsive image"></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="show.php?Sign Up=true"><span class="glyphicon glyphicon-bullhorn"></span> About Us</a></li>
            <li><a href="show.php?Sign Up=true"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="show.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>
    </div>
    </nav>

    <h1 class ="header">Welcome come <?php echo $_SESSION['givenName'] ?> !</h1>

    <div class="container" style="margin-top: 50px">

            <div class="col-md-3">
                <img style="width: 70%;" src="<?php echo $_SESSION['picture'] ?>">
            </div>

            <div class="col-md-9">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td><?php echo $_SESSION['id'] ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $_SESSION['givenName'] ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $_SESSION['familyName'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $_SESSION['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo $_SESSION['gender'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</body>
</html>


