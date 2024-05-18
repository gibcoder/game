<?php
session_start();
include '../../db.php';
include '../../functions.php';
tcheck();
sqCheck();
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="../../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
 <style>.container {
    display: flex;
    justify-content: space-around;
    align-items: center; 
    padding: 10px;
}
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    margin: 0;
    padding-top: 60px;
}

h1 {
    color: red;
    margin-bottom: 30px;
}
</style>       
</head>
<body>
<h1>MathsMax!</h1>
<div id="settings1">
    <div id="settings2">Settings</div>
    </div>

    <div class="setting">
        <a class=sbutton1 type="button" href="tchange/teachchange.php"><div>Change Password</div></a>
        <a class=sbutton3 type="button" href="accData/accData.php"><div>Account Info</div></a>
        </div>
    </div>
    <div id="backButton">
  <!--figure out how to make entire button work-->
  <a href="../teacherpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>

</body>
</html>