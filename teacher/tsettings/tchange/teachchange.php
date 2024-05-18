<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();

?><!DOCTYPE html>
<html>
<style>body {
    padding-top: 50px;
}</style>
<head>
<link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id=jc1>
    <div id=jc2>Change Password</div></div>
<div class="joinClass">
<div id="textJC">Change Password Below:</div>
<form action="teachchanged.php" method='POST'><!--method posts needed throughout-->
    <div class="adjusterJoin" >
<label for=oldP id=jc3>Old Password:</label>
        <input type="password" class="inputs" id="oldP" name="Old_Password" required><br>
<label for=newP id=jc3>New Password:</label>
        <input type="password" class="inputs" id="newP" name="New_Password" pattern='(?=.*[A-Z]).{8,}' title="Eight or more Characters and one capital letter" required>
</div> <br>
<label for="SQ">Security Question:</label>
    <select class="inputs" id="sq" name="SQ" required>
      <option value="1">What was the name of your first pet?</option>
      <option value="2">Whats the First School you attended called?</option>
      <option value="3">Whats Your mothers maiden name?</option>
        <option value="4">What is your fathers middle name?</option>
        <option value="5">What is the make of your mothers first car?</option>
        <option value="6">What is the name of the place you were born?</option>
        <option value="7">What is the name of your first stuffed animal?</option>
<label for="SQA">Security Question Answer:</label>
    <input type="text" class="inputs" id="sqa" name="SQA" required>
<input type="submit" id=sub2></div>


</form>
</div>



<div class="header">
        <a href="../tchange/teachchange.php">Change Password</a>
        <a href="../tsettings.php">Settings</a>
        <a href="../accData/accdata.php">Account Info</a>


</body>
</html>