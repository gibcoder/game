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
<link rel="icon" href="images/favicon.png" type="image/png">
    <p id=selectpara>ALL POINTS SCORED AFTER THE YELLOW FLASH WILL BE COUNTED AS DOUBLE<br>
    USE WASD OR THE ARROW KEYS TO MOVE AND JUMP, AS WELL AS SPACE TO JUMP<p>
    <link rel="stylesheet" href="../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
    background: linear-gradient(to right, #b3d9ff 0%, #80bfff 100%);}
    .level-selection { 
        align-items: center; 
        height: 100vh; 
        display: flex;
        justify-content: center;
       }
    .level-button:hover {
    transform: scale(1.1);
    transition: transform 0.3s ease;
    }/*https://www.w3schools.com/css/css3_transitions.asp*/
    .level-button{
        border: none;
        border-radius: 5px;
        font-size: 20px;
        padding: 10px 20px;
        margin: 10px;
        cursor: pointer;/* need to add to all buttons */}
        #selectpara {
            text-align: center;
            font-family: 'Arial', sans-serif; 
            font-size: 18px; 
            border: 2px solid black; 
            padding: 5px;
            margin: 10px; 
            background-color: red;
            width: 50%;
            margin: auto;}
    #level-button1{ background-color: orange;}
    #level-button2{ background-color: red;}
    #level-button3{ background-color: green;}
    #levelForm {
           display: flex;
           flex-direction: column;
       }
    </style>
</head>
<body>
    <div class="level-selection">
    <form id="levelForm" action="game.php" method="POST">
    <button type="submit" name="level" value="1" class="level-button" id="level-button1">Level 1 (1x Multiplier)(7-10)</button>
    <button type="submit" name="level" value="2" class="level-button" id="level-button2">Level 2 (1.5x Multiplier)(11-13)</button>
    <button type="submit" name="level" value="3" class="level-button" id="level-button3">Level 3 (2x Multiplier)(14+)</button>
</form>
    </div>
    <a href="../studentpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back
</body>
</html>