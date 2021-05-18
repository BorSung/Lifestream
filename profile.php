<?php
	session_start();
    require_once('config.php');
    
    if(isset($_SESSION['userlogin'])){
        if((time() - $_SESSION['last_login_timestamp'])> 900) {
            session_destroy();
            unset($_SESSION);
            header("Location: login.php");
        } 
	} else {
        header("Location: profile.php");
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION);
        header("Location: login.php");
    }


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile Page</title>
  <script src="js/jquery.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
  <script src="js/croppie.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/croppie.css" />

  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<style type="text/css">
		.container-fluid{
			background-color:#333;
			padding: 20px;
		}
		
        .col-md-9 {
            margin-left:250px;
        }

		.navbar-header img{
			width:70%;
		}

		.headerimg img{
			width:8%;
			margin-bottom: -50px;
		}
        
        
		
        
        .drag_area {
          border: 3px dashed #0088cc;
				  padding: 50px;
          width: 250px;
          height: 250px;
          margin-top: 20px;
          position: absolute;
          z-index: 15;
          top: 50%;
          left: 36.5%;
         margin: -150px 0 0 -300px;
          background: black;
         background-color: #333;
          border-radius: 20px;
          color: white;
        }

        .drag_over{  
                color:#000;  
                border-color:#000;  
        }  



        .uploadvideo{
            text-align: center;
            margin-top:50px;
        }

        .uploadvideo a {
          padding: 20px;
          margin-top:30px;
          background-color: #333;
          font-size: 20px;
          font-weight:bold;
        }

		body {
			background: url(DSCF1412.jpg);
  			background-repeat: no-repeat;
			background-size: cover;
		}

    #uploaded_image{
      margin-top:-155px;
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
                <li><a href="captcha.php?yes=ture"><span class="glyphicon glyphicon-wrench"></span> Update profile</a></li>
                    <li><a href="registration.php?Sign Up=true"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="profile.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                </ul>
            </div>
        </nav>

        <div class="drag_area">    
		      <h4 id="header1">Drag & Drop your profile pic...</h4><br/><br/><br/><br/>
		      
          <div class="panel-body" align="center">
                  <input type="file" name="upload_image" id="upload_image" accept="image/*" />
                <br />
              <div id="uploaded_image"> </div>
              </div>
          </div>

        <h1 class ="header">Welcome come <?php echo $_SESSION['userlogin']['Firstname']; ?> !</h1>
        <div class = profile_con style="margin-top: 50px">

            
            <div class="col-md-9">
                <table class="table table-hover table-bordered table-proflie">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td><?php echo $_SESSION['userlogin']['ID']; ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $_SESSION['userlogin']['Firstname']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $_SESSION['userlogin']['Lastname']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php  echo $_SESSION['userlogin']['Phonenumber']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $_SESSION['userlogin']['Email']; ?></td>
                        </tr>
                    </tbody>
                </table>
		    </div>

            <br style="clear: both;">

            <div class="uploadvideo">
                <a href="displayvideos.php?display=true" class="btn btn-primary btn-block" id="watch"> Click CheckUp All the Video!</a>
                <a href="Vupload.php?Vupload=true" class="btn btn-primary btn-block" id="upload_link"> Click for Video Upload</a>
            </div>

        </div>
    </body>

<?php 
    require_once("footer.php")
?>

</html>

<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header" style="background-color:#333; color:white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
          <div class="row">
       <div class="col-md-8 text-center">
        <div id="image_demo" style="width:350px; margin-top:30px"></div>
       </div>
       <div class="col-md-4" style="padding-top:30px;">
        <br />
        <br />
        <br/>
        <button class="btn btn-success crop_image">Crop & Upload Image</button>
     </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
     </div>
    </div>
</div>

<script> 

  $(document).ready(function(){

$image_crop = $('#image_demo').croppie({
   enableExif: true,
   viewport: {
     width:250,
     height:250,
     type:'square' //circle
   },
   boundary:{
     width:300,
     height:300
   }
 });

 $('#upload_image').on('change', function(){
   var reader = new FileReader();
   reader.onload = function (event) {
     $image_crop.croppie('bind', {
       url: event.target.result
     }).then(function(){
       console.log('jQuery bind complete');
     });
   }
   reader.readAsDataURL(this.files[0]);
   $('#uploadimageModal').modal('show');
 });

 $('.crop_image').click(function(event){
   $image_crop.croppie('result', {
     type: 'canvas',
     size: 'viewport'
   }).then(function(response){
     $.ajax({
       url:"upload_profilepic.php",
       type: "POST",
       data:{"image": response},
       success:function(data)
       {
         $('#uploadimageModal').modal('hide');
         $('#header1').hide();
         $('#upload_img').hide();
         $('#uploaded_image').html(data);
       }
     });
   })
 });

 


});  
</script>

