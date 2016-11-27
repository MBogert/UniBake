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

	<h2> Please submit your request for when you would like to bake </h2>
	<div>
		<form action="matchesTest.php" method="post">
		<input type="hidden" name="userID" value="$_COOKIE[userID]"<br>
		Start Time:<input type="time" name="startTime"<br>
		End Time:<input type="time" name="endTime"<br>
		<input type="submit">
		</form>
	</div>

</body>