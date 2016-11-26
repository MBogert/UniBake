<?php
//do we know this user?
if (isset($_COOKIE['email'])){
 $email = $_COOKIE['email']; //get the value of the cookie from browser
 $password = $_COOKIE['password'];
 //logUserIn($email, $password);
} else {
 //don't know this person (or cookie expired)
	echo "Don't know you!";
}
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_COOKIE['email']; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
