<?php
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();
?>
<!DOCTYPE html>
<html>

<head>
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
 <style>.container {
    display: flex;
    justify-content: space-around;
    align-items: center; 
    padding: 10px;
}</style> 
<link rel="icon" href="../gameplay/images/favicon.png" type="image/png">      
</head>
<body>
<h1>MathsMax!</h1>
<div id="settings1">
    <div id="settings2">Settings</div>
    </div>

    <div class="setting">
        <a class=sbutton1 type="button" href="changePass/change.php"><div>Change Password</div></a>
        <a class=sbutton2 type="button" href="joinClass/join.php"><div>Join Class</div></a>
        <a class=sbutton3 type="button" href="accountManagement/accInfo.php"><div>Account Info</div></a>
        </div>
    </div>
    <div id="backButton">
  <!--figure out how to make entire button work-->
  <a href="../studentpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
<br><br><br><br><br><br><br>
<p>CREDIT:<p>
<a href="http://www.freepik.com">For the artwork in the background of the main game:Designed by upklyak / Freepik and the door art:For the dog sprite:<a href="https://www.freepik.com/free-vector/cartoon-dog-animation-frames_13816153.htm#query=game%20sprite%20character%20png&position=10&from_view=search&track=ais&uuid=3a7967b9-18a8-4046-a3d9-b89cbc92c028">Image by pikisuperstar</a> on Freepik <a href="https://www.freepik.com/free-vector/wooden-door-medieval-style_13832366.htm#query=door%20png&position=49&from_view=search&track=ais&uuid=4f338fc0-d913-43bd-a02e-c8e9b4d9317a">Image by brgfx</a> on Freepik</a>
</div>   





















</body>
</html>