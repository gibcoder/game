<?php
session_start();
include '../../db.php';
include '../../functions.php';
tcheck();//tested
sqCheck();

//need a way to get student id and to see owned classes
?>
<!DOCTYPE html>
<html>



<head><link rel="icon" href="../../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
<!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="backButton">
  <a href="../teacherpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
<form id="delete" class="delete" action="sdelete/delete.php" method="POST">
<label for=id id=SID>Delete Student from class: <br><br>Enter Student ID:</label>
        <input name="SID" required><br>
<label for=code id=code> Enter ClassCode:</label>
    <input name="code" required><br>
<input type=submit></form>
<br>
<form id="classdel" class="classdel" action="cdelete/deleteclass.php" method="POST">
<label for=id id=SID>Delete Class: <br><br>
<label for=codedel id=codedel> Enter ClassCode:</label>
    <input name="codedel" required><br>
<input type=submit></form>
<br><br>
<form id="idcheck" class="idcheck" action="idcheck/id.php" method="POST">
<label>See Student ID's in your class: <br><br></label>
<label for=code id=code> Enter ClassCode:</label>
    <input name="code" required><br>
    <input type=submit></form>
<br><br>
    <a href=classes/seeclasses.php id="seeclass">See Your Classes and How They Are Peforming.
    </a>

    <a href=reports/teachreport.php id="teachreport">Student Class Report</a>
    <?php 
    $error = errorCheck();
    if (!empty($error)): ?>
    <div id="errorPopup" class="errorPopup2">
        <p ><?= $error ?></p>
        <button onclick="document.getElementById('errorPopup').style.display = 'none';">I Understand</button>
    </div><?php endif?>
</div>
