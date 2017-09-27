<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

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

if (isset($_GET['questionId'])) {
    // Update question
    $questionId = $_GET['questionId'];
    $Query = "SELECT * FROM questions WHERE id = '$questionId'";
    $Result = $mySQLConnection->query($Query);
    $Result = $Result->fetch_assoc();

    echo "<form action='question.php' method='get'>";
    echo "<table class='table'>";
    echo "<tr align='right'>";
    echo "<td>Ερώτηση</td><td><input class=\"form-control\" type=\"text\" name=\"question\" style='width:100%' value=\"" . $Result['question'] . "\"></td>";
    echo "</tr>";
    echo "<tr align='right'>";
    echo "<td>Σωστή απάντηση</td><td><input class=\"form-control\" type=\"text\" name=\"correctAnswer\" style='width:100%' value=\"" . $Result['correctAnswer'] . "\"></td>";
    echo "</tr>";

    $Query = "SELECT * FROM answers WHERE questionId = '$questionId'";
    $Result = $mySQLConnection->query($Query);
    $answersIndex = 1;
    while ($Row = $Result->fetch_assoc()) {
        echo "<tr align='right'>";
        echo "<td>Απάντηση νούμερο $answersIndex</td><td><input class=\"form-control\" type=\"text\" name=\"answerNo$answersIndex\" style='width:100%' value=\"" . $Row['answer'] . "\"></td>";
        $answersIndex++;
        echo "</tr>";
    }

    echo "<input type='hidden' name='lessonId' value='" . $_GET['lessonId'] . "'>";
    echo "<input type='hidden' name='questionId' value='" . $_GET['questionId'] . "'>";
    echo "<input type='hidden' name='numberOfAnswers' value='" . $answersIndex . "'>";

    echo "<tr>";
    echo "<td colspan='2'><button class='btn btn-success' name=\"action\" style='width: 100%' type=\"submit\" value=\"updateQuestion\">Ενημέρωση ερώτησης</button></td>";
    echo "</tr>";

    echo "</form>";

    echo "</table>";
} else {
    // Add question
    echo "<form action='question.php' method='get'>";
    echo "<table class='table'>";
    echo "<tr align='right'>";
    echo "<td>Ερώτηση</td><td><input class=\"form-control\" type=\"text\" name=\"question\" style='width:100%' value=\"\"></td>";
    echo "</tr>";
    echo "<tr align='right'>";
    echo "<td>Σωστή απάντηση</td><td><input class=\"form-control\" type=\"text\" name=\"correctAnswer\" style='width:100%' value=\"\"></td>";
    echo "</tr>";

    echo "<input type='hidden' name='lessonId' value='" . $_GET['lessonId'] . "'>";
    echo "<input type='hidden' name='numberOfAnswers' value='" . $_GET['numberOfAnswers'] . "'>";

    for ($i = 1; $i <= $_GET['numberOfAnswers']; $i++) {
        echo "<tr align='right'>";
        echo "<td>Απάντηση νούμερο $i</td><td><input class=\"form-control\" type=\"text\" name=\"answerNo$i\" style='width:100%' value=\"\"></td>";
        echo "</tr>";
    }

    echo "<tr>";
    echo "<td colspan='2'><button class='btn btn-success' name=\"action\" style='width: 100%' type=\"submit\" value=\"addQuestion\">Προσθήκη ερώτησης</button></td>";
    echo "</tr>";

    echo "</table>";
    echo "</form>";
}

require_once ("footer.php");