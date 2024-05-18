<?php 
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();

$ClassCode = $_SESSION['code']; 
$counter = $conn->prepare("SELECT classCode, COUNT(student_id) AS NOS FROM studentclass WHERE classCode = ?");
$counter->bind_param("i", $ClassCode);
$counter->execute();
$result = $counter->get_result();
if ($row = $result->fetch_assoc()) {
    echo "Number of students: ". $row['NOS'];
}
echo'<br>';
$avscore = $conn->prepare("SELECT classCode, AVG(student.AvS) AS avs FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avscore->bind_param("i", $ClassCode);
$avscore->execute();
$result = $avscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Score: ". $row['avs'];
}
echo'<br>';
$avhscore = $conn->prepare("SELECT classCode, AVG(student.HS) AS HS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avhscore->bind_param("i", $ClassCode);
$avhscore->execute();
$result = $avhscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average High Score: ". $row['HS'];
}
echo'<br>';
$avtscore = $conn->prepare("SELECT classCode, AVG(student.TS) AS TS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avtscore->bind_param("i", $ClassCode);
$avtscore->execute();
$result = $avtscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Total Score: ". $row['TS'];
}
echo'<br>';
$avgp = $conn->prepare("SELECT classCode, AVG(student.GP) AS GP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avgp->bind_param("i", $ClassCode);
$avgp->execute();
$result = $avgp->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Games Played: ". $row['GP'];
}
echo'<br>';
$higheststudent = $conn->prepare("SELECT classCode, MAX(student.HS) AS maxHS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudent->bind_param("i", $ClassCode);
$higheststudent->execute();
$result = $higheststudent->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student High Score: ". $row['maxHS'];
}
echo'<br>';
$higheststudentav = $conn->prepare("SELECT classCode, MAX(student.AvS) AS maxAV FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudentav->bind_param("i", $ClassCode);
$higheststudentav->execute();
$result = $higheststudentav->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Average Score: ". $row['maxAV'];
}
echo'<br>';
$higheststudenttotal = $conn->prepare("SELECT classCode, MAX(student.TS) AS maxTS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudenttotal->bind_param("i", $ClassCode);
$higheststudenttotal->execute();
$result = $higheststudenttotal->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Total Score: ". $row['maxTS'];
}
echo'<br>';
$higheststudentGP = $conn->prepare("SELECT classCode, MAX(student.GP) AS maxGP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudentGP->bind_param("i", $ClassCode);
$higheststudentGP->execute();
$result = $higheststudentGP->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Games Played: ". $row['maxGP'];
}
echo'<br>';
$loweststudent = $conn->prepare("SELECT classCode, MIN(student.HS) AS minHS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudent->bind_param("i", $ClassCode);
$loweststudent->execute();
$result = $loweststudent->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowerst Student High Score: ". $row['minHS'];
}
echo'<br>';
$loweststudentav = $conn->prepare("SELECT classCode, MIN(student.AvS) AS minAV FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudentav->bind_param("i", $ClassCode);
$loweststudentav->execute();
$result = $loweststudentav->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Average Score: ". $row['minAV'];
}
echo'<br>';
$loweststudenttotal = $conn->prepare("SELECT classCode, MIN(student.TS) AS minTS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudenttotal->bind_param("i", $ClassCode);
$loweststudenttotal->execute();
$result = $loweststudenttotal->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Total Score: ". $row['minTS'];
}
echo'<br>';
$loweststudentGP = $conn->prepare("SELECT classCode, MIN(student.GP) AS minGP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudentGP->bind_param("i", $ClassCode);
$loweststudentGP->execute();
$result = $loweststudentGP->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Games Played: ". $row['minGP'];
}











?><!DOCTYPE html>
<html>
<link rel="stylesheet" href="../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
<head>
<link rel="icon" href="../gameplay/images/favicon.png" type="image/png">
<div id="backButton">
  <!--figure out how to make entire button work-->
  <a href="leaderboard.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>
