<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();
?>
<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
<title>MathsMax</title>
<link rel="stylesheet" href="../../../full.css">
    <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<p>DELETION SUCCESSFUL</p>
<div id="backButton">
  <a href="../manageclass.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
</div>