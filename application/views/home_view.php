<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/snackbar.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/home.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/modal.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<h3 id="welcome" style="text-align: center; color: white; display: none;">Welcome, <a id="uname"></a> <a onclick="modal();"><i style="margin-left: 20px; transform: scaleX(-1);" class="fa fa-sign-out"></i> Logout</a></h3>
	<div class="login-page">
	  <div class="form" align="center">
	  	<h2 id="title" style="display: none;">Site Title</h2>
	    <form class="login-form" id="myForm" method="post">
	      <h5>USERNAME</h5>
	      <input type="text" id="username"/>
	      <span style="float: right; margin-top: -15px; font-weight: bold; color: red;" id="notifuser"></span>
	      <h5>PASSWORD</h5>
	      <input type="password" id="password"><i class="fa fa-eye errspan" onmousedown="tes();" onmouseup="tes2();"></i>
	      <span style="float: right; margin-top: -15px; font-weight: bold; color: red;" id="notifpassword"></span>
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
	      <span style="float: right; margin-top: -15px;" id="notifbib"></span>
	      <br/>
	      <input class="button" type="submit" value="Insert BIB">
	    </form>
	  </div>
	</div>

	<div id="myModal" class="modal">

  	<!-- Modal content -->
	  <div class="modal-content">
	    <p style="font-size: 23px;">Are You Sure want To Log Out ?</p>
	    <button style="background: #BFBFBF; color: black;" class="buttons" onclick="dismis();">Cancel</button>
	    <button class="buttons" onclick="logout();">Yes, Logout</button>
	  </div>

	</div>

	<div id="snackbar"><p class="text">Success Added BIB <a id="bibnumber" style="font-weight: bold;"></a> <i class="fa fa-check circle"></i></p></div>
</body>
<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/md5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script>

  	var socket = io('http://192.168.98.105:8090');
	const EVENT_CODE = {
		ON_CONNECT: "ON_CONNECT",
		NEW_CONNECTION: "join_chat",
		NEW_USER_JOIN: "on_join_chat",
	 	CHAT: "chat",	
	  	RESP_CHAT: "on_chat",	
		UNDEFINED: "UNDEFINED"
	};
	const PARAM_CODE = {
        MESSAGE: "message",
        TOKEN: "token", 
        USERID: "userId",
        TO_USERID: "to_userId",
        TYPE: "user_type", 
        TIME: "time",
        NAME: "username",
        ROOM: "roomid",
        ROOM_USERS_COUNT: "n_users"
    };
        //send message
    $('#myForm3').submit(function(){

		var msgOut = {};
		msgOut[PARAM_CODE.MESSAGE] = $('#m').val();

		socket.emit(EVENT_CODE.CHAT, JSON.stringify(msgOut) );  

		return false;
    });
    

    socket.on(EVENT_CODE.ON_CONNECT, function(){
    	console.log('connected');

		var msgOut = {};

		msgOut[PARAM_CODE.USERID] = sessionStorage.getItem("username");
		msgOut[PARAM_CODE.TOKEN] = sessionStorage.getItem("token");
		msgOut[PARAM_CODE.TYPE] = "1";
		console.log(msgOut);
		socket.emit(EVENT_CODE.NEW_CONNECTION, JSON.stringify(msgOut) );  
      
    });

    socket.on(EVENT_CODE.NEW_USER_JOIN, function(paramJson){
    	console.log(EVENT_CODE.NEW_USER_JOIN);
    });

    socket.on('disconnect', function(){
      console.log('disconnected');
    });

    
    socket.on(EVENT_CODE.RESP_CHAT, function(paramJson){
      console.log(paramJson);      
    });
	

</script>
<script type="text/javascript">
	function tes() {
		var x = document.getElementById("password");
    	x.type = "text";
	}

	function tes2() {
		var x = document.getElementById("password");
    	x.type = "password";
	}

	function logout(){
		sessionStorage.clear();
		window.location.reload();
	}

	function dismis(){
		var modal = document.getElementById("myModal");
		modal.style.display = "none";
	}

	function modal(){
		var modal = document.getElementById("myModal");
		modal.style.display = "block";
	}

	function myFunction() {
	  var x = document.getElementById("snackbar");
	  x.className = "show";
	  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

	$(function() {
		
		var modal = document.getElementById("myModal");
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
		if (sessionStorage.getItem("username") !== null) {
			console.log(sessionStorage.getItem("username"));
			//sessionStorage.setItem("username", uname);
			document.getElementById("uname").innerHTML = sessionStorage.getItem("username");
			$('#myForm').hide();
	       	$('#title').hide();
	       	$('#myForm2').show();
	       	$('#myForm3').hide();
	       	$('#welcome').show();
		} else {
			$('#title').show();
			$('#myForm').show();
			$('#myForm2').hide();
			$('#myForm3').hide();
			$('#welcome').hide();
		}
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
			// 	url : "https://timing.lari.id/agent/",
				// type: "post",
				// dataType: 'json',
				// contentType: "application/json",
				// data : JSON.stringify(form_data)
			// }).done(function(response){ //
				//if (response.token) {
   					sessionStorage.setItem("username", "agent1");
  					sessionStorage.setItem("token", "cc4394379bc72c00bfd46e910da189d1");
  					document.getElementById("uname").innerHTML = sessionStorage.getItem("username");
   					$('#myForm').hide();
		           	$('#title').hide();
		           	$('#myForm2').show();
		           	$('#myForm3').hide();
		           	$('#welcome').show();
   				/*} else {
   					var len = document.getElementById("username").value; 
		   			console.log(len);
	   				if (len.length < 6) {
	   					$('#username').css('background-color','#FFCED3');
	   					document.getElementById("notifuser").textContent="at least 6 character";
	   				} else {
	   					$('#username').css('background-color','');
	   					document.getElementById("notifuser").textContent="";
	   				}
   					document.getElementById("notifpassword").textContent="wrong password";
   					$('#password').css('background-color','#FFCED3');
   				}*/
	   				
			//});
       	});

       	$('#myForm2').submit(function(event) {
       		event.preventDefault();
       		sessionStorage.setItem("server", $('#server').val());
			$('#myForm').hide();
           	$('#title').hide();
           	$('#myForm2').hide();
           	document.getElementById("rfid").value = sessionStorage.getItem("server");
           	$('#myForm3').show();
           	$('#welcome').show();
       	});

       	$('#myForm3').submit(function(event) {
       		event.preventDefault();
       		/*var form_data = {
       			"mode":"update_bib",
       			"ua":"",
       			"username":sessionStorage.getItem("username"),
       			"token":sessionStorage.getItem("token"),
       			"bib":$('#bib').val(),
       			"rfid":"23"
       		};
       		console.log(form_data);
       		$.ajax({
				url : "https://timing.lari.id/agent/",
				type: "post",
				dataType: 'json',
				contentType: "application/json",
				data : JSON.stringify(form_data)
			}).done(function(response){
				console.log(response);
				if (response.result === 1) {*/
					$('#myForm').hide();
		           	$('#title').hide();
		           	$('#myForm2').hide();
		           	$('#myForm3').show();
		           	$('#welcome').show();
		           	myFunction();
		           	document.getElementById("bibnumber").textContent = $('#bib').val();
		           	document.getElementById("notifbib").textContent="";
   					$('#bib').css('background-color','');
   					document.getElementById("bib").value = '';
				// } else {
				// 	document.getElementById("notifbib").textContent="wrong input text";
   	// 				$('#bib').css('background-color','#FFCED3');
				// }
				
			//});
       	});

     });
</script>
</html>