<?php
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();




if (isset($_POST['score'])) {
    $_SESSION['Score'] = $_POST['score'];
} else {
    $_SESSION['Score'] = 0;
}



//getting student id section
$row = aToS($conn);
//games played section
if($row) {$student_id = $row["student_id"];}{
$sql2 = "SELECT GP FROM student WHERE student_id = ?";
$temp2 = $conn->prepare($sql2);
$temp2->bind_param("i", $student_id);
$temp2->execute();
$gp = $temp2->get_result();
$row = $gp->fetch_assoc();

$games_played = $row['GP'];
$games_played = $games_played + 1;

$_SESSION['GP']=$games_played;}
$row = aToS($conn);
if($row) {$student_id = $row["student_id"];}
$sql4 = "SELECT TS FROM student WHERE student_id = ?";
$temp3 = $conn->prepare($sql4);
$temp3->bind_param("i", $student_id); 
$temp3->execute();
$total = $temp3->get_result();
$row = $total->fetch_assoc();

$total =$row['TS']+$_SESSION['Score'];
$AvS=$total/$games_played;

$_SESSION['TS']=$total;
$_SESSION['AvS']=$AvS;
$sql5 = "SELECT HS FROM student WHERE student_id = ?";
$temp5 = $conn->prepare($sql5);
$temp5->bind_param("i", $student_id);
$temp5->execute();
$hs = $temp5->get_result();
$row = $hs->fetch_assoc();
if ($row['HS'] < $_SESSION['Score']){
    $_SESSION['HS']=$_SESSION['Score'];
}else $_SESSION['HS']=$row['HS'];
$level = isset($_POST['level']) ? $_POST['level'] : '1';
?><!DOCTYPE html>
<html>
<head>
    
<style>
    body{background:black;
    }
    
    #timer {
        z-index: 1000;  /*makes sure its at front  */     
        border: 3px solid black; 
        font-size: 22px;
        position: absolute;  
        top: 0px;
        right: 20px;
        color: black;           
        background-color: white;
        padding: 0px; 
    }
    #scoreDisplay {
        z-index: 1000;         
        border: 3px solid black; 
        font-size: 22px;
        position: absolute;  
        top: 0px;
        left: 20px;
        color: black;           
        background-color: white;
        padding: 0px; 
    }
    #questionbox {
    z-index: 1000;
    border: 3px solid black;
    font-size: 22px;
    position: absolute;
    top: -10px;
    right: 49%;
    color: black;
    background-color: white;
    text-align: center;
}
/*add qbox cange pixel amount*/

</style>
<link rel="icon" href="images/favicon.png" type="image/png">
</head>
</body>

<canvas id="myCanvas"></canvas>
<script>
    var level = '<?php echo $level; ?>';
</script>

<script src="game.js"></script>
<div id="timer"></div>   
<div id="scoreDisplay"></div> 
<div id="questionbox"></div>
</body>
