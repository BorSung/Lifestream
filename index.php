<?php
    require_once('config.php');
    session_start();

  
?>
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
      <a href="index.php?"><img src="logo2.png" class="img-responsive" alt="Responsive image"></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
		<li><a href="registration.php?Sign Up=true"><span class="glyphicon glyphicon-bullhorn"></span> About Us</a></li>
      	<li><a href="registration.php?Sign Up=true"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      	<li><a href="login.php?login=true"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
  </div>
</nav>
  
	<div class="container">
		<p>Welcome</p>  
	</div>

<?php 
	require_once("footer.php")
?>