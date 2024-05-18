<?php 
//student2_id-->is the studentid and student_id is account id
session_start();
include '../../../db.php';
include '../../../functions.php';
scheck();
sqCheck();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $code = $_POST["JC"];}
$SID=$_SESSION['student_id'];

$sqlcheck = "SELECT * FROM studentclass WHERE student_id = ? AND classCode = ?";
$check = $conn->prepare($sqlcheck);
$check->bind_param("is", $SID, $code);
$check->execute();
$checkResult = $check->get_result();
if($checkResult->num_rows > 0){
  header("Location: ../../studentpage.php?status=already_joined");
} else {
$sql = "SELECT * FROM class WHERE classCode = ?";
$find = $conn->prepare($sql);
$find->bind_param("s", $code);//https://www.w3schools.com/php/php_mysql_prepared_statements.asp
$find->execute();
$result = $find->get_result();
if ($row = $result->fetch_assoc()) {
  $insertsql = "INSERT INTO studentclass (student_id, classCode) VALUES (?, ?)";
  $insert = $conn->prepare($insertsql);
  $insert->bind_param("is", $SID, $code);
  $insert->execute();
  header("Location: ../../studentpage.php?status=joined_success");
  exit;
}else {
  header("Location: ../../studentpage.php?status=class_not_found");
  exit;
}
$find->close();

$conn->close();
$check->close();
}



?>
<!DOCTYPE html>
<html>

<head>
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="icon" href="../../gameplay/images/favicon.png" type="image/png">
<link rel="stylesheet" href="../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div id="backButton">

  <a href="../../studentpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Return To Main Page
</a>
