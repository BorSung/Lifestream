

<!DOCTYPE html>
<html>

  <head>
    <title>Videos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .text-muted{
        margin-top:5px;
      }

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


      #multiple_files{
        padding:20px;
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
  <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="headerimg">
          <a href="index.php?"><img src="logo2.png" class="img-responsive" alt="Responsive image"></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php?Yes=true"><span class="glyphicon glyphicon-bullhorn"></span> Profile</a></li>
            <li><a href="registration.php?Sign Up=true"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php?login=true"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
      </div>
    </nav>

    <div class="container">

    <br/>
      <h3 align="center">Here is some fun videos for you!</h3>
    
    
      <br/>

      <div class="table-responsive" id="video_table"></div>
    </div>
 </body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

$(document).ready(function(){
    
    load_video_data();
  
  function load_video_data(){

    $.ajax({
    url:"fetch_main.php",
    method:"POST",
    success:function(data) {
      $('#video_table').html(data);
    }
    });
  }
});

$(document).on('click', '.download', function(){
    

var video_name = $(this).attr("id");
$.ajax({
 url:"download.php",
 method:"post",
 data:{video_name:video_name},
 dataType:"json",
 success:function(data){
    Swal.fire({
    'title': 'Successful',
		'text': data,
		'type': 'success'
	});
    },
	error: function(data){
		Swal.fire({
			'title': 'Errors',
			'text': data,
			'type': 'error'
		});
	}
  
  
 });
}); 

</script>

