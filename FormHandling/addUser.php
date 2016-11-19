<?php

	try{

		//Open up database
		$db = new PDO('sqlite:./../Database/unibake.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Check email if it is valid
		$domain = strtok($_POST[email], "@");

		//Query database for school email domains
		$stmt = "SELECT domain FROM School;";
		$result = $db->query($stmt);

		//Check if user's domain is in registered schools
		$verified = False;//This is our verification that the email passes
		foreach($result as $tuple){

			if($tuple[domain] == $domain){
				$verified = True;
				break;
			}

		}

		//If email is not verified, redirect to error
		if(!$verified){
			header("Location: ../Pages/error.html");
		}

		//Add user to database
		//Prepare statements and execute
		//UserLogin
		$prepared1 = $db->prepare("INSERT INTO UserLogin (userID, name, phone) VALUES (:userID, :name, :phone);");
		$prepared1->bindParam(':userID', $_POST[userID]);
		$prepared1->bindParam(':name', $_POST[name]);
		$prepared1->bindParam(':phone', $_POST[phone]);
		$prepared1->execute();

		//Login
		$prepared2 = $db->prepare("INSERT INTO Login (userID, email, password) VALUES (:userID, :email, :password);");
		$prepared2->bindParam(':userID', $_POST[userID]);
		$prepared2->bindParam(':email', $_POST[email]);
		$prepared2->bindParam(':password', $_POST[password]);
		$prepared2->execute();

		catch(PDOException $e){

			//Page Redirect
			die('Exception: '.$e->getMessage());
			//header("Location: ../Pages/error.html");

		} 

	}
?>