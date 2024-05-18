<?php 
session_start();
include '../../../../db.php';
include '../../../../functions.php';
tcheck();
sqCheck();
//USE JOINS HER AND OTHER ADDING/averaging querys
?><!DOCTYPE html>
<html>
<style>

</style>
<head><link rel="icon" href="../../../../student/gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
</head>
<?php
$teacher_id = $_SESSION['teacher_id'];
$sql = 
"SELECT 
  account.name, 
  GROUP_CONCAT(DISTINCT studentclass.classCode SEPARATOR ', ') AS classCode, 
  student.HS, 
  student.GP, 
  student.AvS, 
  student.TS
  FROM account 
  JOIN student ON account.account_id = student.account_id
  JOIN studentclass ON student.student_id = studentclass.student_id
  JOIN class ON studentclass.classCode = class.classCode
  WHERE class.teacher_id = $teacher_id
  GROUP BY account.account_id
  ORDER BY student.HS DESC;";

$fetch = $conn->query($sql);//using this method as i have set it up without parameters
echo '<div class="tableContainer">';
echo '<table>';
echo '<tr>
  <th>Name</th>
  <th>Class Code</th>
  <th>High Score</th>
  <th>Games Played</th>
  <th>Average Score</th>
  <th>Total Score</th>
</tr>';//html code but echod via php
while($row = $fetch->fetch_assoc()) {
  echo '<tr>';
  echo '<td>'.$row['name'] . '</td>';
  echo '<td>'.$row['classCode'] . '</td>';
  echo '<td>'.$row['HS'] . '</td>';
  echo '<td>'.$row['GP'] . '</td>';
  echo '<td>'.$row['AvS' ] . '</td>';
  echo '<td>'.$row['TS'] . '</td>'.'</tr>';
}

echo '</table>';echo '</div">';

?>
<link rel="stylesheet" href="full.css">
<body>
  <br>
  <label id=ccSearch>ENTER CLASS CODE TO FIND SCORES OF ALL IN A CLASS</label>
  <br>
  <br>
<form action="leaderboardsearchteach.php" method="post">
  <input type="text" placeholder="Class Code.." name="classCode", minlength="15", maxlength="15">
    <input type="submit" value="Search"/>
</form>
<br><br><br>
<form action="leaderboardsearchfilterteach.php" method="post">
<label for="wanted">Select a Filter:</label>
  <select id="wanted" name="searchSelect">
    <option value="average">Sort By Average Score for each of your classes</option>
    <option value="HSsort">Sort By Average High Score for each of your classes</option>
    <option value="GamesPlayed">Sort by Average Games Played for each of your classes</option>
    <option value="TSsort">Sort by Average total score for each of your classes</option>
    <br>
    <input type="submit" value="View">

  </select>
  
  <div id="backButton">
  <a href="../seeclasses.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back
  </a>