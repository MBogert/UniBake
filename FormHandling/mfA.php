<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Make Request Page</title>
  <!-- Include the navbar file -->

</head>
<style>
  body {
    background-color: #cc0000;
  }
  img {
    height: 150px;
    width: 150px;
  }
  .options-box {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 10px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin-top: 50px;
    /*margin-left: 50px;*/
  }
  .container {
    height: 100%;
    position: relative;
  }
  .matchContainer {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 30px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin: auto;
    /*margin-left: 50px;*/
  }
  .row{
    background-color: #FAEBD7;
    width: 95%;
    position: center;
    padding: 10px 10px 10px 10px;
    /*padding-left: 200px;*/
    margin: auto;
  }
  .col-md-6 {
    border: 1px solid #2e2e1f;
    border-radius: 2px;
  }


</style>
<body slyle="color:#b3000">

    <div class="container">

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.html">Cook4Two</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li  class="active"><a href="matches.html">My Matches</a></li>
            <li><a href="recipies.html">Recipies</a></li>
            <li><a href="bio.html">My Bio</a></li>
            <li><a href="LogOut.php" style="margin-left:800px">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>
<?php

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

                echo $_SESSION['userID'];
                $prepared1 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category1) ");
                //$prepared1->bindParam(':userID', $_COOKIE['userID']);
                $prepared1->bindParam(':userID', $_SESSION['userID']);
                $prepared1->bindParam(':category1', $_POST['category1']);
                $prepared1->execute();

                //Triplicate fix code?
                $prepared1->bindParam(':category1', $_POST['category2']);
                $prepared1->execute();
                $prepared1->bindParam(':category1', $_POST['category3']);
                $prepared1->execute();

                //To make sure the unique constraint is satisfied, delete their previous request if any

                $deleteRequest1 = $db->prepare("DELETE from BakeRequest where (userID = :userDR1)");
                $deleteRequest1->bindParam('userDR1', $_SESSION['userID']);
                $deleteRequest1->execute();

                $bakeRequest = $db->prepare("INSERT into BakeRequest (userID, startTime, endTime) VALUES (:userID1, :start, :endT)");
                $bakeRequest->bindParam(':userID1', $_SESSION['userID']);
                $bakeRequest->bindParam(':start', $_POST['startTime']);
                $bakeRequest->bindParam(':endT', $_POST['endTime']);
                $bakeRequest->execute();

                $prepared = $db->prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
                  FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
                  select distinct userID from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime <= endTime AND :inputEndTime >= startTime AND userID != :inputUserID)");
                //Bind the parameters for SQL Injection

                //$prepared->bindParam(':inputUserID', $_COOKIE['userID']);
                $prepared->bindParam(':inputUserID', $_SESSION['userID']);

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
                    $getCategory->bindParam(':mainUser', $_SESSION['userID']);

                    //$getCategory->bindParam(':mainUser', $_COOKIE['userID']);
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
<body>
    <h1 styles="margin-left:200px"> Select a user you want to bake with! </h1>

<form action="shinyRecipies.php" method="post">
 <?php foreach($matched as $key=>$value): ?>
    <tr>

    <td><?php
         $db1 = new PDO('sqlite:./../Database/unibake.db');
                $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //$pair = $db1->prepare("Select email, name, phone from Login NATURAL JOIN UserLogin where (userID = $key)");
                    $pair = $db1->prepare("Select email, name, phone, userID from Login NATURAL JOIN UserLogin where (userID = $key)");

                    $pair->execute();
                    //$result = $db->query($stmt);
                    $result = $pair->fetch();
                    $db =null;
                    ?>

                    <?php
                    echo "</div>
                      <div class=\"container\">
                        <div class=\"options-box\">
                            <div class=\"row\">
                              <div class=\"col-md-6\">
                                   <ul styles=\"display: text-align\">
                                     <li>You matched with:" .$result['name']. "</li>
                                     <li> Your 'Bakeability' with ".$result['name']." is {($value / 3)} </li>
                                     <li> Their phone number:" .$result['phone']. "</li>
                                   </ul>
                              </div>
                              <div class=\"col-md-6\">
                                  <img src=\"../AvatarImgs/homer.jpg\">
                                  <input type =\"hidden\" name=\"pairID\" value =" .$result['userID'].">
                                  <input type =\"hidden\" name=\"name\" value=" .$result['name'].">
                                  <input type =\"hidden\" name=\"email\" value=" .$result['email'].">
                                  <input type =\"hidden\" name=\"phone\" value=" .$result['phone'].">
                                  <input type=\"submit\" name=\"select\" value=\"I choose this dude\">
                              </div>
                           </div>

                        </div>";
                    ?>

<!--                     <input type ="hidden" name="pairID" value ="<?php $result['userID']; ?>">
 -->


 </td>
</tr>

<?php endforeach; ?>

</form>
</p>


</html>
