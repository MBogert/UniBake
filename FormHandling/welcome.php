
<?php 
session_start();
//do we know this user?
// if (isset($_COOKIE['email'])){
//  $email = $_COOKIE['email']; //get the value of the cookie from browser
//  $password = $_COOKIE['password'];
//  //logUserIn($email, $password);
// } else {
//  //don't know this person (or cookie expired)
// 	echo $_COOKIE['email'];

// 	echo "Don't know you!";
// }
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_SESSION['userID'];
      // echo $_COOKIE['password'];
      // echo $_COOKIE['userID'];
       ?>
       	
       </h1> 
      <h2><a href = "LogOut.php">Sign Out</a></h2>
   </body>
   
</html>