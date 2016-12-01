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

<?php
//This code will pair the user, then delete their previous bake request and Request Category information

//1. Get each user's information
//User1 is the user making the request, User2 is the paired person
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "This is you".$_SESSION['userID']."<br/>";

		echo "This is the other user".$_SESSION['pairUser']."<br/>";
		 $pair = $db->prepare("INSERT into Pair (user1, user2, recipe) VALUES (:user1, :user2, :recipe)"); 
         //$recipe1->bindParam(':inputUserID', $_COOKIE['userID']);
         $pair->bindParam(':user1', $_SESSION['userID']);
         $pair->bindParam(':user2', $_SESSION['pairUser']);
         $pair->bindParam(':recipe', $_GET['filePath']);
         $pair->execute();

         //2. Delete their BakeRequest

         $delete1 = $db->prepare("DELETE from BakeRequest where (userID = :userID1)");
         $delete1->bindParam('userID1', $_SESSION['userID']);
         $delete1->execute();

         $delete2 = $db->prepare("DELETE from BakeRequest where (userID = :userID2)");
         $delete2->bindParam('userID2', $_SESSION['pairUser']);
         $delete2->execute();

         //3. Delete their RequestCategory


         $deleteRequest1 = $db->prepare("DELETE from RequestCategory where (userID = :userDR1)");
         $deleteRequest1->bindParam('userDR1', $_SESSION['userID']);
         $deleteRequest1->execute();


         $deleteRequest2 = $db->prepare("DELETE from RequestCategory where (userID = :userDR2)");
         $deleteRequest2->bindParam('userDR2', $_SESSION['pairUser']);
         $deleteRequest2->execute();

		$db =null;


?>
<body>

	<h1>Thank you for baking with us</h1><br/>
	<?php
		echo "<a href ='../Recipes/$_GET[filePath]' download>Download</a>";
	?>
	<br/><a href = "cleanSession.php">Return Home</a>

</body>