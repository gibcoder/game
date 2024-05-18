<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();
$teach=$_SESSION['teacher_id'];
$sql="SELECT classcode FROM class where teacher_id=?";
$seeclass = $conn->prepare($sql);
$seeclass->bind_param("i", $teach);
$seeclass->execute();
$list = $seeclass->get_result();


if ($list->num_rows > 0) {
    while ($row = $list->fetch_assoc()) {
      echo'Class:';
        echo $row['classcode'] . "<br>";
    }
} else {
    echo "You curently have no classes created , If you want to create one click the button in the bottom left of the screen.";
}
echo' Use these codes to obtain reports and more from other areas of the class management'


?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../../../full.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
<head>
<link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
<div id="backButton">
  <a href="../manageclass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>
<div id="backButton">
  <a href="../../classcreate/genClass.php" id="seeclass"> Create New Class
  </a>
  <a href=../reports/teachreport.php id="teachreport">Student Class Report</a>
  <a href=tleaderboard/teacherboard.php id="teachld">Your Students Leaderboard Searcher</a>