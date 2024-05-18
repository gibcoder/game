<?php 
session_start();
include '../../../../db.php';
include '../../../../functions.php';
tcheck();
sqCheck();
$teacher_id = $_SESSION['teacher_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $selectedfilter = $_POST['searchSelect'];
    }
    if ($selectedfilter == 'average') {
        $sql = "SELECT studentclass.classCode,AVG(student.AvS) as avScore FROM student
                JOIN studentclass ON student.student_id = studentclass.student_id
                JOIN class ON studentclass.classCode = class.classCode
                WHERE class.teacher_id = $teacher_id
                GROUP BY studentclass.classCode
                ORDER BY avScore desc";
        $result = $conn->query($sql);echo '<div class="tableContainer">';
        echo '<table>';
        echo '<tr>
              <th>Class Code</th>
              <th>Average Score</th>
              </tr>';
              while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['classCode'] . '</td>';
                echo '<td>' . $row['avScore'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';echo'</div>';
        }
        if ($selectedfilter == 'HSsort') {
            $sql = "SELECT studentclass.classCode,AVG(student.HS) as HS FROM student
                    JOIN studentclass ON student.student_id = studentclass.student_id
                    JOIN class ON studentclass.classCode = class.classCode
                    WHERE class.teacher_id = $teacher_id
                    GROUP BY studentclass.classCode
                    ORDER BY HS desc";
            $result = $conn->query($sql);echo '<div class="tableContainer">';
            echo '<table>';
            echo '<tr>
                  <th>Class Code</th>
                  <th>Average High Score</th>
                  </tr>';
                  while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['classCode'] . '</td>';
                    echo '<td>' . $row['HS'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>'; echo'</div>';
            }
        if ($selectedfilter == 'GamesPlayed') {
            $sql = "SELECT studentclass.classCode,AVG(student.GP) as GP FROM student
                    JOIN studentclass ON student.student_id = studentclass.student_id
                    JOIN class ON studentclass.classCode = class.classCode
                    WHERE class.teacher_id = $teacher_id
                    GROUP BY studentclass.classCode
                    ORDER BY GP desc";
            $result = $conn->query($sql); echo '<div class="tableContainer">';
            echo '<table>';
            echo '<tr>
                  <th>Class Code</th>
                  <th>Average Games Played</th>
                  </tr>';
                  while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['classCode'] . '</td>';
                    echo '<td>' . $row['GP'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>'; echo'</div>';}
            if ($selectedfilter == 'TSsort') {
                $sql = "SELECT studentclass.classCode,AVG(student.TS) as TS FROM student
                        JOIN studentclass ON student.student_id = studentclass.student_id
                        JOIN class ON studentclass.classCode = class.classCode
                        WHERE class.teacher_id = $teacher_id
                        GROUP BY studentclass.classCode
                        ORDER BY TS desc";
                $result = $conn->query($sql);echo '<div class="tableContainer">';
                echo '<table>';
                echo '<tr>
                      <th>Class Code</th>
                      <th>Average Total Score</th>                          </tr>';
                      while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['classCode'] . '</td>';
                        echo '<td>' . $row['TS'] . '</td>';
                        echo '</tr>';
                    }echo '</table>'; echo'</div>';}                
?><!DOCTYPE html>
<html>
<link rel="stylesheet" href="../../../../full.css">
 <!--links icon style sheet w3schools.com https://www.w3schools.com/howto/howto_css_icon_buttons.asp/fontawesome.com v4.7-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
<head><link rel="icon" href="../../../../student/gameplay/images/favicon.png" type="image/png">
<div id="backButton">
  <a href="teacherboard.php" class="btn back"><i class="fa fa-backward" aria-hidden="true"></i> Back
  </a>
                </head>