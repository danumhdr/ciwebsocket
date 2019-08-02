<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/home.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/modal.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<h3 id="welcome" style="margin-left: 39%;; color: white; display: none;">Welcome, username1234 <a onclick="modal();"><i style="margin-left: 20px; transform: scaleX(-1);" class="fa fa-sign-out"></i> Logout</a></h3>
	<div class="login-page">
	  <div class="form" align="center">
	  	<h2 id="title">Site Title</h2>
	    <form class="login-form" id="myForm" method="post">
	      <h5>USERNAME</h5>
	      <input type="text" id="username"/>
	      <span style="float: right; margin-top: -15px;" id="notifuser"></span>
	      <h5>PASSWORD</h5>
	      <input type="password" id="password"><i class="fa fa-eye errspan" onmousedown="tes();" onmouseup="tes2();"></i>
	      <span style="float: right; margin-top: -15px;" id="notifpassword"></span>
	      <br/>
	      <input class="button" type="submit" value="Login">
	    </form>
	    <form class="login-form" id="myForm2" method="post" style="display: none;">
	      <h5>INPUT RFID SERVER</h5>
	      <input type="text" id="server"/>
	      <input class="button" type="submit" value="Connect RFID Server">
	    </form>
	    <form class="login-form" id="myForm3" method="post" style="display: none;">
	      <h5>RFID SERVER</h5>
	      <input type="text" id="rfid" readonly />
	      <h5>INPUT BIB NUMBER</h5>
	      <input type="text" id="bib"><i class="fa fa-eye errspan" onmousedown="tes();" onmouseup="tes2();"></i>
	      <span style="float: right; margin-top: -15px;" id="notifpassword"></span>
	      <br/>
	      <input class="button" type="submit" value="Insert BIB">
	    </form>
	  </div>
	</div>

	<div id="myModal" class="modal">

  	<!-- Modal content -->
	  <div class="modal-content">
	    <p>Are You Sure want To Log Out ?</p>
	  </div>

	</div>
</body>
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/md5.min.js"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
<script type="text/javascript">
	function tes() {
		console.log('assas');
	}

	function tes2() {
		console.log('dasdsdsd');
	}

	function modal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "block";
	}

	$(function() {
		var modal = document.getElementById("myModal");
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
		$('#myForm').show();
		$('#myForm2').hide();
		$('#myForm3').hide();
		$('#welcome').hide();
       // bind 'myForm' and provide a simple callback function
       	$('#myForm').submit(function(event) {
       		event.preventDefault();
   //     		var form_data = {
   //     			"mode":"login",
   //     			"username":$('#username').val(),
   //     			"password": md5($('#password').val())
   //     		};
   //     		console.log(form_data);
   //     		$.ajax({
			// 	url : "https://timing.lari.id/agent",
			// 	type: "post",
			// 	data : form_data
			// }).done(function(response){ //
				//console.log(response);
				$('#myForm').hide();
	           	$('#title').hide();
	           	$('#myForm2').show();
	           	$('#myForm3').hide();
	           	$('#welcome').show();
			//});
       	});

       	$('#myForm2').submit(function(event) {
       		event.preventDefault();
   //     		var form_data = {
   //     			"mode":"login",
   //     			"username":$('#username').val(),
   //     			"password": md5($('#password').val())
   //     		};
   //     		console.log(form_data);
   //     		$.ajax({
			// 	url : "https://timing.lari.id/agent",
			// 	type: "post",
			// 	data : form_data
			// }).done(function(response){ //
				//console.log(response);
				$('#myForm').hide();
	           	$('#title').hide();
	           	$('#myForm2').hide();
	           	$('#myForm3').show();
	           	$('#welcome').show();
			//});
       	});

     });
</script>
</html>