<?php

require_once('config.php');
session_start();

if(isset($_SESSION['email'])){
  if((time() - $_SESSION['last_login_timestamp'])> 900) {
      session_destroy();
      unset($_SESSION);
      header("Location: login.php");
  } 
} else {
  header("Location: Vupload.php");
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html>

  <head>
    <title>Video Upload and Editing Info</title>
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

    <br />
    <div class="container">
      <h3 align="center">Video Upload and Editing Info</h3>
      <br/>

      <div align="right">
        <input class="btn btn-danger btn-block" type="file" name="multiple_files" id="multiple_files" multiple><br/>

      
        <div class="progress" style="height: 20px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" id= "progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
            <h3 id="status"></h3>
            <p id="loaded_total"></p>
  
        
        <span class="text-muted">Only AVI FLV WMV MOV MP4 file allowed</span>
        <span id="error_multiple_files"></span>
      </div>

      

      <br/>

      <div class="table-responsive" id="video_table">
        
    </div>
    </div>

 </body>
</html>

<div id="videoModal" class="modal fade" role="dialog">
  
    <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" id="edit_video_form">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Video Details</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label>Video Name</label>
                <input type="text" name="video_name" id="video_name" class="form-control" />
              </div>
              
              <div class="form-group">
                <label>Video Description</label>
                <input type="text" name="video_description" id="video_description" class="form-control" />
              </div>

            </div>

            <div class="modal-footer">
              <input type="hidden" name="video_id" id="video_id" value=""/>
              <input type="submit" name="submit" class="btn btn-info" value="Edit" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

          </form>

        </div>

    </div>

</div>

<script>
$(document).ready(function(){

  load_video_data();
  
  function load_video_data(){

    $.ajax({
    url:"fetch.php",
    method:"POST",
    success:function(data) {
      $('#video_table').html(data);
    }
    });
  }


  $('#multiple_files').change(function(){
  var error_videos = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;

  if(files.length > 3) {

   error_videos += 'You can not select more than 3 video';

  } else {

   for(var i=0; i<files.length; i++) {

    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();

    if(jQuery.inArray(ext, ['avi','flv','wmv','mov','mp4']) == -1) {
      error_videos += '<p>File '+ (i+1) +'- Invalid format</p>';
    }

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
    var fsize = f.size||f.fileSize;

    if(fsize > 20000000) {
      error_videos += '<p> File' + (i+1) + ' Size is very big</p>';
    } else {
      form_data.append("file[]", document.getElementById('multiple_files').files[i]);
    }

   }

  }

  if(error_videos == '') {

   $.ajax({

    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#error_multiple_files').html('<br /><label class="text-primary">Starting</label>');
    }, 
    xhr: function (){
      var jqXHR = null;
      if ( window.ActiveXObject ){
        jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
      } else {
        jqXHR = new window.XMLHttpRequest();
      }
      //Upload progress
      jqXHR.upload.addEventListener( "progress", function ( evt ){
        if ( evt.lengthComputable ) {
          var percentageComplete = Math.round( (evt.loaded * 100) / evt.total);
          $('#error_multiple_files').html('<br /><label class="text-primary">Uploading</label>');
          //Do something with upload progress
          console.log('Uploaded percent', percentageComplete);
          $('#progress-bar').animate({
            width: percentageComplete + '%'
          });
  
          $('#loaded_total').html("Uploaded"+percentageComplete+"%... please wait");
        }
      }, false);
      
      //Dowload progress
      jqXHR.addEventListener( "progress", function ( evt ){
        if ( evt.lengthComputable ) {
          var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
          //Do something with download progress
          console.log( 'Downloaded percent', percentComplete );   
          document.getElementById("progress-bar").style.width = "300px";              
        }
      }, false );
      return jqXHR;
      },
      success: function ( data ){
        //Do something success-ish
        $('#loaded_total').html("Done! Uploaded! 100%");
        $('#error_multiple_files').html("<span class='text-danger'>Thanks For Waiting.</span>");
        console.log('Completed.');
        load_video_data();
      }
    });
  } else {
    $('#multiple_files').val('');
    $('#error_multiple_files').html("<span class='text-danger'>"+error_video+"</span>");
    return false;
  }

}); 

$(document).on('click', '.edit', function(){

  var video_id = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"post",
   data:{video_id:video_id},
   dataType:"json",
   success:function(data)
   {
    $('#videoModal').modal('show');
    $('#video_id').val(video_id);
    $('#video_name').val(data.video_name);
    $('#video_description').val(data.video_description);
   }
  });
 }); 

 $(document).on('click', '.delete', function(){
  var video_id = $(this).attr("id");
  var video_name = $(this).data("video_name");
  if(confirm("Are you sure you want to remove it?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{video_id:video_id, video_name:video_name},
    success:function(data)
    {
     load_video_data();
     alert("Video has been removed!");
    }
   });
  }
 }); 

 $('#edit_video_form').on('submit', function(event){
  event.preventDefault();
  if($('#video_name').val() == ''){
   alert("Please Enter Video Name");
  } else {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:$('#edit_video_form').serialize(),
    success:function(data)
    {
     $('#videoModal').modal('hide');
     load_video_data();
     alert('Video Details updated');
    }
   });
  }

 });

});
</script>

