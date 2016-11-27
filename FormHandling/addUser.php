<!DOCTYPE html>
<html lang = "en">
<head>

  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Sign Up</title> 

</head>
<body>
	<img src = "../Pages/Waiting.jpg"><br/>
	Baking...
</body>
</html>

<?php

	try{

		//Open up database
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Check email if it is valid
		//$domain = strtok($_POST['email'], "@");
		list($fluff, $domain) = explode("@", $_POST['email'], 2);

		//Query database for school email domains
		$stmt = "SELECT domain, schoolID FROM School;";
		$result = $db->query($stmt);

		//Check if user's domain is in registered schools
		$verified = False;//This is our verification that the email passes
		$schoolID = -1;//This is the school the user attends (if verified)
		echo $domain;
		foreach($result as $tuple){

			echo "$tuple[domain]";

			if($tuple['domain'] == $domain){
				$verified = True;
				$schoolID = $tuple['schoolID'];
				break;
			}

		}

		//If email is not verified, redirect to error
		if(!$verified){
			header("Location: ../Pages/error.html");
		}

		//Add user to database
		//Create new UserID, make hash function for phone
		$id = 0;		
		//Check that the userID is a unique value
		while(True){

			$unique = True;
			$id = mt_rand();

			$stmt = "SELECT userID FROM UserLogin;";
			$result = $db->query($stmt);

			foreach($result as $tuple){

				if($tuple['userID'] == $id){
					$unique = False;
					break;
				}

			}

			if($unique){break;}

		}

		//Prepare statements and execute		
		//UserLogin
		$prepared1 = $db->prepare("INSERT INTO UserLogin (userID, name, phone) VALUES (:userID, :name, :phone);");
		$prepared1->bindParam(':userID', $id);
		$prepared1->bindParam(':name', $_POST['name']);
		$prepared1->bindParam(':phone', $_POST['phone']);
		$prepared1->execute();

		//Login
		$prepared2 = $db->prepare("INSERT INTO Login (userID, email, password) VALUES (:userID, :email, :password);");
		$prepared2->bindParam(':userID', $id);
		$prepared2->bindParam(':email', $_POST['email']);
		$prepared2->bindParam(':password', $_POST['password']);
		$prepared2->execute();

		//Attends
		$prepared3 = $db->prepare("INSERT INTO Attends (userID, schoolID) VALUES (:userID, :schoolID);");
		$prepared3->bindParam(':userID', $id);
		$prepared3->bindParam(':schoolID', $schoolID);
		$prepared3->execute();

		//header("Location: ../Pages/error.html"); <--- Some success page
		header("Location: welcome.php");
	}
		catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

		} 
?>