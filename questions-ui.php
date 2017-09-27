<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

if(!isset($_GET['lessonId'])) {
    die();
}

$lessonId = $_GET['lessonId'];

$Query = "SELECT name,semesterId FROM lessons WHERE id = '$lessonId'";
$Result = $mySQLConnection->query($Query);
$Result = $Result->fetch_assoc();

$LessonName = $Result['name'];
$semesterId = $Result['semesterId'];

$Query = "SELECT name FROM semesters WHERE id = '$semesterId'";
$Result = $mySQLConnection->query($Query);
$Result = $Result->fetch_assoc();
$SemesterName = $Result['name'];



echo "<ul class=\"breadcrumb\">";
echo "<li><a href=\".\">Αρχική</a></li>";
echo "<li><a href=\"./lessons.php?semesterId=" . $semesterId ."\">" . $SemesterName . "</a></li>";
echo "<li><a href=\"./questions.php?lessonId=" . $lessonId ."\">" . $LessonName . "</a></li>";
echo "</ul>";

$Query = "SELECT * FROM questions WHERE lessonId='$lessonId'";
$Result = $mySQLConnection->query($Query);


echo "<form action='questions.php' method='get'>";
echo "<table class='table'>";
echo "<tr>";
echo "<input type=\"hidden\" name=\"lessonId\" value=\"$lessonId\">";
echo "<td>Αριθμός απαντήσεων</td><td><input class=\"form-control\" type='number' name='numberOfAnswers' min='4' max='6' value='4'></td>";
echo "<td><button class='btn btn-primary' name=\"action\" type=\"submit\" value=\"addQuestion\">Προσθήκη ερώτησης</button></td>";
echo "</tr>";
echo "</table>";
echo "</form>";


echo "<table class='table'>";
echo "<tr>";
echo "<th>Αναγνωριστικό</th>";
echo "<th>Ερώτηση</th>";
echo "<th>Σωστή απάντηση</th>";
echo "<th>Ενέργειες</th>";
echo "</tr>";
while($Row = $Result->fetch_assoc()) {
    printAQuestionObject($Row['id'], $Row['question'], $Row['correctAnswer']);
}
echo "</table>";

function printAQuestionObject($id, $question, $correctAnswer) {

    $lessonId = $_GET['lessonId'];

    echo "<form action='questions.php' method='get'>";
    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . $question . "</td>";
    echo "<td>" . $correctAnswer . "</td>";

    echo "<td>";
    echo "<input type=\"hidden\" name=\"lessonId\" value=\"$lessonId\">";
    echo "<input type=\"hidden\" name=\"questionId\" value=\"$id\">";
    echo "<div class=\"btn-group\">";
    echo "<button class='btn btn-success' name=\"action\" type=\"submit\" value=\"updateQuestion\">Επεξεργασία</button>";
    echo "<button class='btn btn-danger' name=\"action\" type=\"submit\" value=\"deleteQuestion\">Διαγραφή</button>";
    echo "</div>";
    echo "</td>";

    echo "</tr>";
    echo "</form>";
}

require_once ("footer.php");