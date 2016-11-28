<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Make Request Page</title>
  <!-- Include the navbar file -->
  <?php include navbar.php ?>
</head>
<style>

</style>
<body>



<?php

	try{

		//Open database
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Obtain all possible categories
		$stmt = "SELECT DISTINCT category FROM Category;";
		$result = $db->query($stmt);

		//Close database
		$db = null;
	}
	catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

	} 

?>



	<h2> Please submit your request for when you would like to bake </h2>
	<div>
		<form action="finalMatch.php" method="post">
		<input type="hidden" name="userID" value="$_COOKIE[userID]"<br>
		Start Time:<input type="time" name="startTime"<br>
		End Time:<input type="time" name="endTime"<br>
		Preference 1: <select name = "category1">
							<?php 
								foreach($result as $tuple){
									echo "<option>$tuple['category']</option>";
								}
							?>
					  </select>
		Preference 2: <select name = "category2">
							<?php 
								foreach($result as $tuple){
									echo "<option>$tuple['category']</option>";
								}
							?>
					  </select>
		Preference 3: <select name = "category3">
							<?php 
								foreach($result as $tuple){
									echo "<option>$tuple['category']</option>";
								}
							?>		
					  </select>
		<input type="submit">
		</form>
	</div>

</body>

