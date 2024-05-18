<?php
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();
//get the studentid from accountid

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['score'])) {
      $_SESSION['Score'] = (int)$_POST['score'];
      error_log("Received score: " . $_SESSION['Score']); 
  } else {
      error_log("error;not recieved");
  }
}//random num for now need to change when game is coded
$row = aToS($conn);
$student_id = $row["student_id"];
$updatesql = "UPDATE student SET GP = ? WHERE student_id = ?";
$update = $conn->prepare($updatesql);
$update->bind_param("ii", $_SESSION['GP'], $student_id);
$update->execute();

//av score section and total


$row = aToS($conn);
$student_id = $row["student_id"];
$updatesqlboth = "UPDATE student SET TS = ?,AvS = ?,HS =? WHERE student_id = ?";
$updateboth = $conn->prepare($updatesqlboth);
$updateboth->bind_param("iiii",$_SESSION['TS'], $_SESSION['AvS'],$_SESSION['HS'], $student_id);
$updateboth->execute();

//copy leaderboards code and alter it tp fit
//need to code a new select sql here
$row = aToS($conn);
$student_id = $row["student_id"];
$sql3="SELECT HS,GP,AvS,TS  FROM student WHERE student_id=$student_id";
$select = $conn->query($sql3);//no need for other method, no need for secuirty
echo '<table>';
echo '<tr>
  <th>Score</th>
  <th>High Score</th>
  <th>Games Played</th>
  <th>Average Score</th>
  <th>Total Score</th>
</tr>';
while($row = $select->fetch_assoc()) {//finish this//finish this//finish this
echo '<tr>';
echo '<td>'.$_SESSION['Score'] .'</td>';
echo '<td>'.$row['HS'] . '</td>';
echo '<td>'.$row['GP'] . '</td>';
echo '<td>'.$row['AvS' ] . '</td>';
echo '<td>'.$row['TS'] . '</td>'.'</tr>';
}

echo '</table>'
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>body {
    background: linear-gradient(to right, #b3d9ff 0%, #80bfff 100%);}
    


</style>

</head>
<body>
<div id="backButton">
  <a href="../studentpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Main menu
  </a></div>
  <div id="ldbrbtn">
  <a href="../leaderboard/leaderboard.php" id="ldbrbtn">Go to the leaderboard
  </a></div>