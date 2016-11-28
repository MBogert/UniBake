<?php
    session_start();

    function compare2($list1, $list2){
    //Hashmap of users to the amount of matches they have
    $counter =0;
    for($i=0; $i<count($list1); $i++){
        //The counter that says how many matches they have

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
                $prepared = $db->prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
									FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
									select userID from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime <= endTime OR :inputEndTime >= startTime)");
                //Bind the parameters for SQL Injection
                //$prepared->bindParam(':inputUserID', $_POST['userValue']);
                $prepared->bindParam(':inputUserID', $_COOKIE['userID']);
                $prepared->bindParam(':inputEndTime', $_POST['endTime']);
                $prepared->bindParam(':inputStartTime', $_POST['startTime']);
                //$result=$prepared->execute();
                $prepared->execute();

                //$result = $prepared->fetch(PDO::FETCH_ASSOC);
                //$prepared->bind_result($user);
                //$result = $prepared->fetch(PDO::FETCH_ASSOC);
                $matched = array();
                $result = $prepared->fetchAll();
                echo "This is start time".$_POST['startTime'];
                echo "This is end time".$_POST['endTime'];

                echo "This is the user".$_POST['userValue'];
                echo "This is the user".$_COOKIE['userID'];


                echo "This is the result";
                print_r($result);
                foreach($result as $tuple){
                    echo "Printint in the loop";
                    print $tuple['userID'];

                }
                // while($myrow = $result->fetch_assoc()){
                // $otherPerson = $myrow['userID'];


                //     $userData1 = $db->query("select category from RequestCategory where (userID = $otherPerson)");
                //     $prepared2 = $db->prepare("select category from RequestCategory where (userID = :inputUserID");
                //     $prepared2->bindParam(':inputUserID', $_POST['userID']);
                //     $otherUser = $prepared2->execute();

                //     //$userData2 = $db->query("select category from RequestCategory where (userID = :inputUserID");
                //     //Store the number of similar categories
                //     $similar = compare2($userData1, $otherUser);
                //     //Add the user and their similar categories to the array
                //     $matched[$otherPerson] = $similar;
                //     //array_push($matched, '$otherPerson'=>'$similar');

                // }


                foreach($result as $tuple){
                    //$data = array($tuple);
                    //$otherPerson = $tuple['userID'];
                    $otherPerson = $tuple['userID'];
                    //echo "This is the tuple[0]".$tuple[0];
                    //Get the preference categories
                    echo "This is the other person".$otherPerson;
                    $userData1 = $db->prepare("select category from RequestCategory where (userID = $otherPerson)");
                    $userData1->execute();
                    $prepared2 = $db->prepare("select category from RequestCategory where (userID = :mainUser");
                    $prepared2->bindParam(':mainUser', $_COOKIE['userID']);
                    //$otherUser = $prepared2->execute();
                    $prepared2->execute();
                    $results1 = $prepared->fetchAll();
                    $results2 = $userData1->fetchAll();
                    //$userData2 = $db->query("select category from RequestCategory where (userID = :inputUserID");
                    //Store the number of similar categories
                    //$similar = compare2($userData1, $otherUser);
                    $similar = compare2($results2, $results1);

                    //Add the user and their similar categories to the array
                    $matched[$otherPerson] = $similar;
                    //array_push($matched, '$otherPerson'=>'$similar');
                    echo"This is matched";
                    print_r($matched);

                }

                //Sort the matches from high to low

                $finalArr = arsort($matched);
                echo "This is the final array";
                print_r($finalArr);
                $_SESSION['result'] = $finalArr;
                $_SESSION['answer'] = $result;
                //$_POST['result'] = $finalArr;
                //$finalArr = $_POST['result'];
                //Print out these results
                //Close the db
                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>