
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

<style>
  body {
    background-color: #cc0000;
  }
  h1 {
    color: black;
  }
  p {
    color: black;
  }
  img {
    height: 150px;
    width: 150px;
  }
  .options-box {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 10px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin-top: 50px;
    /*margin-left: 50px;*/
  }
  .container {
    height: 100%;
    position: relative;
  }
  .matchContainer {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 30px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin: auto;
    /*margin-left: 50px;*/
  }
  .row{
    background-color: #FAEBD7;
    width: 95%;
    position: center;
    padding: 10px 10px 10px 10px;
    /*padding-left: 200px;*/
    margin: auto;
  }
  .col-md-6 {
    border: 1px solid #2e2e1f;
    border-radius: 2px;
  }


</style>


   <head>
      <title>Welcome</title>
   </head>

   <body>

    <div class="container">

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.html">UniBake</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li  class="active"><a href="matches.html">My Matches</a></li>
            <li><a href="recipies.html">Recipies</a></li>
            <li><a href="bio.html">My Bio</a></li>
            <li><a href="LogOut.php" style="margin-left:800px">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>


      <h1>Welcome user <?php echo $_SESSION['userID'];
      // echo $_COOKIE['password'];
      // echo $_COOKIE['userID'];
       ?>
       <!--<p><a href="makeRequest.php">Go to make request page</a></p>-->
       <p><a href="mfAMake.php">Get Baking!</a></p>

       </h1>
      <h2><a href = "LogOut.php">Sign Out</a></h2>
   </body>

</html>
