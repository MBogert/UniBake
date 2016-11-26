<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Log In Page</title>
</head>
<body>
<div class ="navbar">
<?php include 'navbar.php';?>
</div>

<h2>Enter username and password</h2>
   
        <h4><font color='red'>* required field.</font><br/></h4>

          <form action="LoginPageHandle.php" method="post">
			<table border="1">
			<tr>
        <td>UserID:<font color="red">*</font></td>
        <td><input type ="integer" name="userID" required=""/> <br/></td>
</tr>
		<tr>
        <td>Password:<font color="red">*</font></td>
        <td><input type ="text" name="password" required=""/> <br/></td>
</tr>
<tr>
<tr>
</table>
                <div align="center"><input type="submit" name="submit" value="Log in"></div>
        </form>


</body>
</html>