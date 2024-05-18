<?php
session_start();
include '../../db.php';
include '../../functions.php';
scheck();
sqCheck();
$selectedcode = $_POST['classCode'] ??'x';
$selectedSort = $_POST['sortOption'] ?? 'HS'; 
$_SESSION['code']=$selectedcode;
$sql = "SELECT account.name, studentclass.classCode, student.HS, student.GP, student.AvS, student.TS 
        FROM account 
        JOIN student ON account.account_id = student.account_id
        JOIN studentclass ON student.student_id = studentclass.student_id
        WHERE studentclass.classCode = ? 
        ORDER BY ";

switch ($selectedSort) {
    case 'HS':
        $sql .= "student.HS DESC";
        break;
    case 'GP':
        $sql .= "student.GP DESC";
        break;
    case 'AvS':
        $sql .= "student.AvS DESC";
        break;
    case 'TS':
        $sql .= "student.TS DESC";
        break;
}

$fetchscore = $conn->prepare($sql);
$fetchscore->bind_param("s", $selectedcode);
$fetchscore->execute();
$leaderboardfetch = $fetchscore->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../gameplay/images/favicon.png" type="image/png">
    <title>MathsMax</title>
    <link rel="stylesheet" href="../../full.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form action="leaderboardsearch.php" method="post">
        <input type="hidden" name="classCode" value="<?= $selectedcode ?>">
        <label for="sortOption">Sort By:</label>
        <select id="sortOption" name="sortOption">
            <option value="HS" <?= $selectedSort == 'HS' ? 'selected' : '' ?>>High Score</option>
            <option value="GP" <?= $selectedSort == 'GP' ? 'selected' : '' ?>>Games Played</option>
            <option value="AvS" <?= $selectedSort == 'AvS' ? 'selected' : '' ?>>Average Score</option>
            <option value="TS" <?= $selectedSort == 'TS' ? 'selected' : '' ?>>Total Score</option>
        </select><br>
        <input type="submit" value="Sort"><br><br>
    </form>
<div class="tableContainer">
    <table>
        <tr>              
        <th>Name</th>
        <th>Class Code</th>
        <th>High Score</th>
        <th>Games Played</th>
        <th>Average Score</th>
        <th>Total Score</th>
        </tr>
        <?php while($row = $leaderboardfetch->fetch_assoc()): ?>
            <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['classCode'] ?></td>
            <td><?= $row['HS'] ?></td>
            <td><?= $row['GP'] ?></td>
            <td><?= $row['AvS'] ?></td>
            <td><?= $row['TS'] ?></td><!--This is the best way i could figure oput how to do this cosw, not sure its the most efficient-->
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div id="backButton">
        <a href="leaderboard.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
    </div>
    <div id="teachreport">
  <a href="report.php" id="inclass">Report
  </a></div>