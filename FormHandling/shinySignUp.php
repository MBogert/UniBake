<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>UniBake Sign Up</title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="LogInstyle.css">

</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Unibake</span></h1>
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Sign Up</h2>
        	<form action="addUser.php" method="post">
			</div>
      <label for="username">Name</label>
  		<br/>
			<input type="text" ="name">
			<br/>
      <label for="username">Phone Number</label>
  		<br/>
			<input type="text" name="phone">
			<br/>
      <label for="email">Email</label>
  		<br/>
			<input type="email" name="email">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" name="password">
			<br/>
			<button type="submit">Sign Up Now!</button>
			<br/>
			<a href="shinyLogIn.php"><p class="small">Already have an account?</p></a>
		</div>
	</div>
</body>

</html>
