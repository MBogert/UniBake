<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Thank You</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>

<body>

	<h1>Thank you for baking with us</h1><br/>
	<?php
		echo "<a href ='../Recipes/$_GET[filePath]' download>Download</a>";
	?>
	<br/><a href = "cleanSession.php">Return Home</a>

</body>