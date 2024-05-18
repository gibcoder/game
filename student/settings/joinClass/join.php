<?php 
//defensive programming put i
session_start();
include '../../../db.php';
include '../../../functions.php';
scheck();
sqCheck();

?>
<!DOCTYPE html>
<html>

<head>
<style>
  body {
    padding-top: 50px;
}
    </style>
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="icon" href="../../gameplay/images/favicon.png" type="image/png">
<link rel="stylesheet" href="../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id=jc1>
    <div id=jc2>Join Class</div></div>
<div class="joinClass">
<div id="textJC">Join Class Below:</div>
<form action="joined.php" method="POST">
    <div class="adjusterJoin" >
<label for=JC id=jc3>Enter Class Code:</label>
        <input type="" class="inputs" id="jc" name="JC" minlength="15" maxlength="15" required ><!--defensive programming need to add interger only-->

</div> <br>
<input type="submit" ></div>


</form>


<div class="header">
        <a href="../changePass/change.php">Change Password</a>
        <a href="../settings.php">Settings</a>
        <a href="../joinClass/join.php">Join Class</a>
        <a href="../accountManagement/accInfo.php">Account Info</a>



</body>
</html>