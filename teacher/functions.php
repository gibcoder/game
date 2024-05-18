<?php

function tcheck(){
  if ($_SESSION['acc_type']!='teacher'){
    header("Location: TorS.php?error=TIncorrect account type or not logged in");
    exit();
  }//made for the login specifficaly but on all just to double checkin case someone had ealier mad an  account with a teacher and student id before it was fully coded not to let that happen
}
function scheck() {
  if ($_SESSION['acc_type'] != 'student') {
      header("Location: TorS.php?error=SIncorrect account type or not logged in");
      exit();
  }
}

function aToS($conn) {//changes account id to student id
  $account_id = $_SESSION["account_id"];
  $sql = "SELECT student_id FROM student WHERE account_id = ?";
  $temp = $conn->prepare($sql);
  $temp->bind_param("i", $account_id);
  $temp->execute();
  $result = $temp->get_result();
  $row = $result->fetch_assoc();
  return $row;}


function sqCheck(){
  if (isset($_SESSION['needsCheck']) && $_SESSION['needsCheck'] === true) {
    header("Location: check20.php");
    exit();
}
}
