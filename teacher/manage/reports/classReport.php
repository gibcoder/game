<?php
session_start();
include '../../../db.php';
include '../../../functions.php';
tcheck();
sqCheck();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 



$ClassCode  = $_POST["classSelect"];
$_SESSION["classcode"] =$ClassCode ;
$counter = $conn->prepare("SELECT classCode, COUNT(student_id) AS NOS FROM studentclass WHERE classCode = ?");
$counter->bind_param("i", $ClassCode);
$counter->execute();
$result = $counter->get_result();
if ($row = $result->fetch_assoc()) {
    echo "Number of students: ". $row['NOS'];
}
echo'<br>';
$avscore = $conn->prepare("SELECT classCode, AVG(student.AvS) AS avs FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avscore->bind_param("i", $ClassCode);
$avscore->execute();
$result = $avscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Score: ". $row['avs'];
}
echo'<br>';
$avhscore = $conn->prepare("SELECT classCode, AVG(student.HS) AS HS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avhscore->bind_param("i", $ClassCode);
$avhscore->execute();
$result = $avhscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average High Score: ". $row['HS'];
}
echo'<br>';
$avtscore = $conn->prepare("SELECT classCode, AVG(student.TS) AS TS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avtscore->bind_param("i", $ClassCode);
$avtscore->execute();
$result = $avtscore->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Total Score: ". $row['TS'];
}
echo'<br>';
$avgp = $conn->prepare("SELECT classCode, AVG(student.GP) AS GP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$avgp->bind_param("i", $ClassCode);
$avgp->execute();
$result = $avgp->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Average Games Played: ". $row['GP'];
}
echo'<br>';
$higheststudent = $conn->prepare("SELECT classCode, MAX(student.HS) AS maxHS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudent->bind_param("i", $ClassCode);
$higheststudent->execute();
$result = $higheststudent->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student High Score: ". $row['maxHS'];
}
echo'<br>';
$higheststudentav = $conn->prepare("SELECT classCode, MAX(student.AvS) AS maxAV FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudentav->bind_param("i", $ClassCode);
$higheststudentav->execute();
$result = $higheststudentav->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Average Score: ". $row['maxAV'];
}
echo'<br>';
$higheststudenttotal = $conn->prepare("SELECT classCode, MAX(student.TS) AS maxTS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudenttotal->bind_param("i", $ClassCode);
$higheststudenttotal->execute();
$result = $higheststudenttotal->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Total Score: ". $row['maxTS'];
}
echo'<br>';
$higheststudentGP = $conn->prepare("SELECT classCode, MAX(student.GP) AS maxGP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$higheststudentGP->bind_param("i", $ClassCode);
$higheststudentGP->execute();
$result = $higheststudentGP->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Highest Student Games Played: ". $row['maxGP'];
}
echo'<br>';
$loweststudent = $conn->prepare("SELECT classCode, MIN(student.HS) AS minHS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudent->bind_param("i", $ClassCode);
$loweststudent->execute();
$result = $loweststudent->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowerst Student High Score: ". $row['minHS'];
}
echo'<br>';
$loweststudentav = $conn->prepare("SELECT classCode, MIN(student.AvS) AS minAV FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudentav->bind_param("i", $ClassCode);
$loweststudentav->execute();
$result = $loweststudentav->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Average Score: ". $row['minAV'];
}
echo'<br>';
$loweststudenttotal = $conn->prepare("SELECT classCode, MIN(student.TS) AS minTS FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudenttotal->bind_param("i", $ClassCode);
$loweststudenttotal->execute();
$result = $loweststudenttotal->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Total Score: ". $row['minTS'];
}
echo'<br>';
$loweststudentGP = $conn->prepare("SELECT classCode, MIN(student.GP) AS minGP FROM studentclass JOIN student ON studentclass.student_id = student.student_id WHERE classCode = ?");
$loweststudentGP->bind_param("i", $ClassCode);
$loweststudentGP->execute();
$result = $loweststudentGP->get_result();
if ($row = $result->fetch_assoc()) {
    echo " \n Lowest Student Games Played: ". $row['minGP'];
}
echo'<br><br>';
$sql="SELECT account.name, studentclass.classCode, student.HS,student.GP, student.AvS, student.TS FROM account
JOIN student ON account.account_id = student.account_id
JOIN studentclass ON student.student_id = studentclass.student_id
WHERE studentclass.classCode='$ClassCode'
ORDER BY HS desc";
$leaderboardfetch = $conn->query($sql);
echo '<table>';
echo '<tr>
  <th>Name</th>
  <th>Class Code</th>
  <th>High Score</th>
  <th>Games Played</th>
  <th>Average Score</th>
  <th>Total Score</th>
</tr>';
while($row = $leaderboardfetch->fetch_assoc()) {
  echo '<tr>';
  echo '<td>'.$row['name'] . '</td>';
  echo '<td>'.$row['classCode'] . '</td>';
  echo '<td>'.$row['HS'] . '</td>';
  echo '<td>'.$row['GP'] . '</td>';
  echo '<td>'.$row['AvS' ] . '</td>';
  echo '<td>'.$row['TS'] . '</td>'.'</tr>';
  
}

$sql="SELECT student_id FROM studentclass where classcode=?";
$seeclass = $conn->prepare($sql);
$seeclass->bind_param("i", $ClassCode);
$seeclass->execute();
$list = $seeclass->get_result();
echo '</table>';
echo "<br><br>";
echo "<form action='studentspecificresult.php' method='POST'>";
echo "<label for='student'>Select a Student:  </label>";
echo "<select id='student' name='student'>";
if ($list->num_rows > 0) {
    while ($row = $list->fetch_assoc()) {
        echo "<option value=".$row['student_id'].">".$row['student_id']."</option>";//htmlcode in the php creating a dropdown menu
    }
} else {
    header("Location: teachreport.php?status=grapherror");
}

echo "</select>";echo"    ";
echo "<input type=submit value=Submit>";  //submit box
echo "</form>";

$classData = [['Name', 'High Score', 'Average Score']]; 
$chartSQL = "SELECT account.name, AVG(student.AvS) AS avs, MAX(student.HS) AS hs
             FROM studentclass
             JOIN student ON studentclass.student_id = student.student_id
             JOIN account ON student.account_id = account.account_id
             WHERE classCode = ?
             GROUP BY student.student_id";
$chart = $conn->prepare($chartSQL);
$chart->bind_param("i", $ClassCode);
$chart->execute();
$result = $chart->get_result();
while ($row = $result->fetch_assoc()) {
  
    $classData[] = [$row['name'], (float)$row['hs'], (float)$row['avs']];
}
$jsonData = json_encode($classData);
} else     header("Location: teachreport.php?status=notMainPage");

?>
<!DOCTYPE html>
<html>

<head><link rel="icon" href="../../../student/gameplay/images/favicon.png" type="image/png">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
#printbtn {
    background-color:white;
    color: black;
    padding: 12px 20px;
    font-family: 'Times New Roman', Times, serif;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<script>
function printPage() {
    window.print();
}
</script>
<title>MathsMax</title>
<link rel="stylesheet" href="../../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="backButton">
  <a href="teachReport.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i>  Back
</a>
<div id="chart_div"></div>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);
        var options = {
            title: 'Students\' Performance: Average Score vs High Score',
            hAxis: {title:'Average Score'},
            vAxis: {title:'High Score'},
            legend: 'none'
        };
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(data, options);}
</script>
<button id=printbtn onclick="printPage()">Print this page</button>
