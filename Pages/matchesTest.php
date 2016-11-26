<!DOCTYPE html>
<?php

//find the school that the student belongs to 
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Need a dropdown 
                //This is the query that filters out feasible users that could be possible matches
                $prepared = $db-> prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
									FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
									select * from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime >= startTime OR :inputEndTime <= endTime)");
                //Bind the parameters for SQL Injection
                $prepared->bindParam(':inputStartTime', $_POST[startTime]);
                $prepared->bindParam(':inputEndTime', $_POST[endTime]);
                $prepared->bindParam(':inputUserID', $_POST[userID]);
                $result=$prepared->execute();

                foreach($result as $tuple){
                    //$data = array($tuple);
                    $userID = $tuple[0];
                    $start = $tuple[1];
                    //Find the common categories
                    $userData = $db->prepare("select * from BakeRequest Natural Join RequestCategory where ()")
                }


    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school


— Need php to sort the elements or another sql query to get their category preferences

$prepared = $db->prepare(“select * from Category where (studentID = inputStudentID)”);
$prepared->bindParam(‘:inputStudentID’, $_POST[userID]);
?>

</html>