<html>
 <head>
   <title>How to send AJAX request in Codeigniter</title>
 </head>
 <body>
 
  Select Username : <select id='sel_user'>
   <option value='1'>1</option>
   <option value='2'>2</option>
   <option value='3'>3</option>
   <option value='4'>4</option>
  </select>

  <!-- User details -->
  <div >
   Username : <span id='suname'></span><br/>
   Name : <span id='sname'></span><br/>
   Email : <span id='semail'></span><br/>
  </div>

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var username = $(this).val();
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
   });
  });
 });
 </script>
 </body>
</html>\