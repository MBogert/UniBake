<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>HomePage Info</title>
</head>
<style>

</style>
<body>
<?php

//find the school that the student belongs to
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $prepared = $db->prepare("Select * from Pair where (user1 = :inputUserID OR user2 = :inputUserID)");
                $prepared->bindParam(':inputUserID', $_SESSION['userID']);
                $prepared->execute();

//$result = $prepared->fetch();
$result = $prepared->fetchAll();
//$count = $prepared->rowCount();
//$count = $prepared->fetchColumn();

//Can only have a single pair
if($prepared->fetchColumn() == 1){


//Find the other relevant information that you would want to print out like the time that you are baking 
$otherInfo =$db->prepare("Select startTime, endTime from BakeRequest where (userID = :user1)");
$otherInfo->bindParam(':user1', $_SESSION['userID']);
$otherInfo->execute();

//$resultOther = $otherInfo->fetch();
$resultOther = $otherInfo->fetchAll();
$db=null;

//If the first user is the user then print out information relevant to that if not 
if($result['user1'] == $_SESSION['userID']){
//Print out their Pair with their information 
//print_r($tuple);
  echo " There was a result";
echo "This is who you are paired with".$result['user2']."</br>";
//echo "This is the recipe that you are baking".
echo "This is the time you are baking from ".$resultOther['startTime']." to ".$resultOther['endTime']."</br>";
}else{
echo "this is the 2nd loop";
echo "This is who you are paired with".$result['user1']."</br>";
echo "This is the recipe that you are baking".$result['filePath']."</br>";
echo "This is the time you are baking from ".$resultOther['startTime']." to ".$resultOther['endTime']."</br>";

}

}else{
    echo "Sorry, you are not paired with anyone yet, you should submit a BakeRequest";
}

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>

<a href="LogOut.php">Logout</a>

</html>
