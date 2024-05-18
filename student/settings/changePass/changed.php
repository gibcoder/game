<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
scheck();
sqCheck();
  
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $oldp= $_POST["Old_Password"];
    $newp= $_POST["New_Password"];
    $AID= $_SESSION['account_id'];
    $submittedSQ = $_POST["SQ"];
    $SQA= $_POST["SQA"];
// add the sqa checker here   
$sql2 = "SELECT SQ,SQA FROM account WHERE account_id=?";
$sqaCheck = $conn->prepare($sql2);
$sqaCheck->bind_param("i", $AID);
$sqaCheck->execute();
$sqa= $sqaCheck->get_result();
$sqarow = $sqa->fetch_assoc();
if ($SQA != $sqarow['SQA']) {
    header("Location: ../../studentpage.php?status=WRONG_SECURITY_ANSWER");
    exit;
}
if ($submittedSQ != $sqarow['SQ']) {
    header("Location: ../../studentpage.php?status=WRONG_SECURITY_QUESTION");
    exit;
}

$sql = "SELECT `password` FROM account WHERE account_id=?";
$pcheck = $conn->prepare($sql);
$pcheck->bind_param("i", $AID);
$pcheck->execute();
$ans = $pcheck->get_result();
$row = $ans->fetch_assoc();}


//executing sql statements this way to avoid injects advice from w3 schools//was having issues as i pposted to the wrong page on change.php


if (password_verify($oldp, $row["password"])) {
    $newhash = password_hash($newp, PASSWORD_BCRYPT);//rehashes new password
    $sqlUpdate = "UPDATE account SET `password`=? WHERE account_id=?";
    $P_update = $conn->prepare($sqlUpdate);
    $P_update->bind_param("si", $newhash, $AID);//s means string datatype,i means integer--? means it needs a bind
    if ($P_update->execute()) {
        header("Location: ../../studentpage.php?status=UPDATED/Successful");
    } 
    else {
        header("Location: ../../studentpage.php?status=NOTUPDATED/WRONGPASSWORD");
}
    }
else {
    header( "Location: ../../studentpage.php?status=NOTUPDATED/ERROR");
}
    


?>
<!DOCTYPE html>
<html>

<head>
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
