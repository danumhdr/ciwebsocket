<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/message.css">
	<script src="<?php echo base_url()?>public/js/message.js"></script>
	<script src="<?php echo base_url()?>public/js/jquery.min.js"></script>
	<script src="<?php echo base_url()?>public/websocket/fancywebsocket.js"></script>
	<script>
		var Server;

		Server = new FancyWebSocket('ws://127.0.0.1:9300');

		//tangkap apakah ada action dr client manapun
		Server.bind('message', function( payload ) {
		    switch (payload) {
		        case 'tobingmsg':
		           $('#1').val('tobingmsg');
		           break;
		        case 'tobingerror':
		           $('#1').val('tobingerror');
					break;   
		    }
		});
		 
		Server.connect();


		//kirim pesan tobingmsg
		function send() {
			//munculkan pesan buat diri sendiri
			dhtmlx.message({
				'text': "From you at "+new Date().toLocaleString(),
				'expire': -1
			});

			//sampaikan ke server bahwa telah terjadi action
			Server.send( 'message', 'tobingmsg' );
		}

		//kirim pesan tobingerror
		function senderror() {
			//munculkan pesan buat diri sendiri
			dhtmlx.message({
				'text': "From you at "+new Date().toLocaleString(),
				'expire': -1,
				'type' : 'error'
			});

			//sampaikan ke server bahwa telah terjadi action
			Server.send( 'message', 'tobingerror' );
		}

		function senduser(){
			var username = $('#1').val();
		    $.ajax({
		     url:'<?=base_url()?>User/userDetails',
		     method: 'post',
		     data: {username: username},
		     dataType: 'json',
		     success: function(response){
		      var len = response.length;

		      if(len > 0){
		       // Read values
		       var uname = response[0].username;
		       var name = response[0].name;
		       var email = response[0].email;
		 
		       $('#suname').text(uname);
		       $('#sname').text(name);
		       $('#semail').text(email);
		 
		      }else{
		       $('#suname').text('');
		       $('#sname').text('');
		       $('#semail').text('');
		      }
		 
		     }
		   })
		}
	</script>
</head>
<body>
	<button id="send" onclick="send()">Send</button>
	<button id="error" onclick="senderror()">Send Error</button>
	<button id="error" onclick="senduser()">Send Error</button>
	<input type="text" id="1" name="">
	<div >
	   Username : <span id='suname'></span><br/>
	   Name : <span id='sname'></span><br/>
	   Email : <span id='semail'></span><br/>
	  </div>
</body>
</html>


<?php
/*

$autoload['helper'] = array('url');

$config['base_url'] = 'http://localhost/ci-websocket/';

*/



?>