<?php 
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();
//USE JOINS HER AND OTHER ADDING/averaging querys
?><!DOCTYPE html>
<html>
<style>

</style>
<head>
<link rel="icon" href="../gameplay/images/favicon.png" type="image/png">
<!--sets title and references the css style sheet to style my page-->
<title>MathsMax</title>
<link rel="stylesheet" href="../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
</head>
<?php
$sql = "SELECT account.name, 
GROUP_CONCAT(DISTINCT studentclass.classCode SEPARATOR ', ') AS classCodes, 
student.HS AS HS,
student.GP AS GP, 
student.AvS AS AvS, 
student.TS AS TS
FROM account 
JOIN student ON account.account_id = student.account_id
JOIN studentclass ON student.student_id = studentclass.student_id
GROUP BY account.account_id
ORDER BY HS DESC";


$fetch = $conn->query($sql);
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
  echo '<td>'.$row['classCodes'] . '</td>';
  echo '<td>'.$row['HS'] . '</td>';
  echo '<td>'.$row['GP'] . '</td>';
  echo '<td>'.$row['AvS' ] . '</td>';
  echo '<td>'.$row['TS'] . '</td>'.'</tr>';
  
}

echo '</table>';echo '</div>';

?>
<link rel="stylesheet" href="../../full.css">
<body>
 
  <br>
  <label id=ccSearch>ENTER CLASS CODE TO FIND SCORES OF ALL IN A CLASS</label>
  <br>
  <br>
<form action="leaderboardsearch.php" method="post">
  <input type="text" placeholder="Class Code.." name="classCode", minlength="15", maxlength="15">
    <input type="submit" value="Search"/>
</form>
<br><br><br>
<form action="leaderboardsearchfilter.php" method="post">
<label for="wanted">Select a Filter:</label>

  <select id="wanted" name="searchSelect">
    <option value="average">Sort By Average Score for each class</option>
    <option value="HSsort">Sort By Average High Score for each class</option>
    <option value="GamesPlayed">Sort by Average Games Played for each class</option>
    <option value="TSsort">Sort by Average total score for each class</option>
    <br>
    <input type="submit" value="View">

  </select>

  <a href="../studentpage.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back
  </a>
  <div id="teachreport">
  <a href="classesin.php" id="inclass">See classes your in
  </a></div>














<!--<table>-->
<!--  <tr>-->
<!--    <th>Name</th>-->
<!--    <th>Class</th>-->
<!--    <th>High Score</th>-->
<!--    <th>Average Score</th>-->
<!--    <th>Total Score</th>-->
<!--    <th>Games Played</th>-->
<!-- copy all this and echo via php so the sql can be displayed/part of testing-->