<?php
session_start();
include '../../db.php';
include '../../functions.php';
tcheck();
sqCheck();

function classCode() {
    $random = rand(100000000000000,999999999999999);
    $code= substr("$random",0, 15); 
    

    return $code;
    
}
function isCodeUnique($conn, $code) {
  $sql = "SELECT COUNT(*) FROM class WHERE classCode = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $code);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_array();
  return $row[0] == 0; 
}
$cc = classCode();
while (!isCodeUnique($conn, $cc)) {
  $cc = classCode();
}
$sql="INSERT INTO class (classCode, teacher_ID) VALUES (?, ?)";
$teacher_id = $_SESSION['teacher_id'];
$codeinsert = $conn->prepare($sql);
$codeinsert->bind_param("ii", $cc, $teacher_id);
$codeinsert->execute();
echo $cc;
$codeinsert->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
  <style>
body {
font-family: Arial, sans-serif;
text-align: center;
padding: 20px;
}</style>


<head>
<link rel="icon" href="../../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<p>THIS IS YOUR NEW CLASS CODE</p>

<div id="backButton">

  <a href="../teacherpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>