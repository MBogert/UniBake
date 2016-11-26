<?php
   $db = new PDO('sqlite:./../Database/unibake.db');
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $prepared =$db->prepare("SELECT userID FROM Login WHERE (email = :userEmail AND password = :userPassword)");
      $prepared->bindParam(':userEmail', $_POST['email']);
      $prepared->bindParam(':userPassword', $_POST['password']);

      $result = $prepared->execute();
      //$row = $result->fetch(PDO::FETCH_ASSOC);
      //$active = $row['active'];
      $user = $prepared->fetch(PDO::FETCH_ASSOC);
      //$count = $result->rowCount(PDO::);
      //echo $user;
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if(count($result) == 1) {
         //session_register("email");
         //$_SESSION['login_user'] = email;

         setcookie('email', $_POST['email'], time() + (86400 * 30));
         setcookie('password', $_POST['password'],time() + (86400 * 30));
         setcookie('userID', $result, time() + (86400 * 30));
         //It was successful so go to next page
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
<!--                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
 -->					
                <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>

            </div>
				
         </div>
			
      </div>

   </body>
</html>