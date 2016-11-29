<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Make Request Page</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>
<style>

</style>
<body>

<?php
    session_start();

    function compare2($list1, $list2){
    //Hashmap of users to the amount of matches they have
    $counter =0;
    for($i=0; $i<sizeof($list1); $i++){
        //The counter that says how many matches they have
            //if($list1['category'][$i] == $list2['category'][$i]){
        if($list1[$i] == $list2[$i]){

            $counter++;
            }   
    }
return $counter;
    }

//find the school that the student belongs to 
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Need a dropdown 
                //This is the query that filters out feasible users that could be possible matches

                //First do the insert queries
                // echo "This is category1".$_POST['category1'];
                // echo "This is category2".$_POST['category2'];
                // echo "This is category3".$_POST['category3'];

                $prepared1 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category1) ");
                $prepared1->bindParam(':userID', $_COOKIE['userID']);
                $prepared1->bindParam(':category1', $_POST['category1']);
                $prepared1->execute();

                $prepared2 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category2) ");
                $prepared2->bindParam(':category2', $_POST['category2']);
                $prepared2->bindParam(':userID', $_COOKIE['userID']);
                $prepared2->execute();


                $prepared3 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category3) ");
                $prepared3->bindParam(':category3', $_POST['category3']);
                $prepared3->bindParam(':userID', $_COOKIE['userID']);
                $prepared3->execute();



                $prepared = $db->prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
									FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
									select userID from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime <= endTime AND :inputEndTime >= startTime AND userID != :inputUserID)");
                //Bind the parameters for SQL Injection

                $prepared->bindParam(':inputUserID', $_COOKIE['userID']);
                $prepared->bindParam(':inputEndTime', $_POST['endTime']);
                $prepared->bindParam(':inputStartTime', $_POST['startTime']);
                $prepared->execute();

                $matched = array();
                $result = $prepared->fetchAll();


                foreach($result as $tuple){
                    //$data = array($tuple);
                    //$otherPerson = $tuple['userID'];
                    $otherPerson = $tuple['userID'];
                    //echo "This is the tuple[0]".$tuple[0];
                    //Get the preference categories
  
                    $userData1 = $db->prepare("select category from RequestCategory where (userID = $otherPerson)");
                    $userData1->execute();
                    $getCategory = $db->prepare("select category from RequestCategory where (userID = :mainUser)");
                    $getCategory->bindParam(':mainUser', $_COOKIE['userID']);
                    //$otherUser = $prepared2->execute();
                    $getCategory->execute();
                    $results1 = $getCategory->fetchAll();
                    $results2 = $userData1->fetchAll();

                    $similar = compare2($results2, $results1);

                    //Add the user and their similar categories to the array
                    $matched[$otherPerson] = $similar;

                }
                //Close the db
                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>

<p>
<body>
<td>Here are your results</td>

<body>
    <h1> Select a user you want to bake with! </h1>
    <p>(Need to figure out a way to delete their request if they decide to not choose)</p>

<form action="pairPeople.php" method="post">
 <?php foreach($matched as $key=>$value): ?> 
    <tr>

    <td><?php 
         $db1 = new PDO('sqlite:./../Database/unibake.db');
                $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pair = $db1->prepare("Select email, name, phone from Login NATURAL JOIN UserLogin where (userID = $key)");
                    $pair->execute();
                    //$result = $db->query($stmt);
                    $result = $pair->fetch();
                    ?>
                    <?php echo "This is the other userID {$key} => and this is how many things you have in common {$value}";?>

                    <?php echo "Their email: ".$result['email']."<br/>";
                    echo "Their name: ".$result['name']."<br/>";
                    echo "Their phone number: ".$result['phone']."<br/>";
                    ?>
                    <input type ="hidden" name="name" value="<?php $result['name']; ?>">
                    <input type ="hidden" name="email" value="<?php $result['email']; ?>">
                    <input type ="hidden" name="phone" value="<?php $result['phone']; ?>">
                      <input type="submit" name="select" value="Submit">  

               
 </td>
</tr>

<?php endforeach; ?>

</form>
</p>
</html>