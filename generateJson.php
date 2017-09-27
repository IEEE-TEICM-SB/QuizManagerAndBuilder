<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

require_once("config.php");

if(isset($_GET['download'])) {
    header('Content-disposition: attachment; filename=document.json');
    header('Content-type: application/json;charset=utf-8;');
}

$Semesters = "SELECT * FROM semesters";
$Semesters = $mySQLConnection->query($Semesters);

$jsonResponse = new stdClass();

$jsonResponse->title = AppName;
$jsonResponse->desc = AppDesc;
$jsonResponse->ver = BuildTime;

if(!isset($_GET['download'])) {
    // Save version file
    $fp = fopen('.\public\version.json', 'w');
    fwrite($fp, json_encode($jsonResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fclose($fp);
}

$semesterIndex = 0;

// For all semesters
while ($rowSemester = $Semesters->fetch_assoc()) {
    $jsonResponse->semesters[$semesterIndex] = new stdClass();
    $jsonResponse->semesters[$semesterIndex]->title = $rowSemester['name'];

    $Lessons = "SELECT * FROM lessons WHERE semesterId = '" . $rowSemester['id'] . "'";
    $Lessons = $mySQLConnection->query($Lessons);

    $lessonIndex = 0;

    // For all lessons
    while($rowLesson = $Lessons->fetch_assoc()) {
        $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex] = new stdClass();
        $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->title = $rowLesson['name'];

        $Questions = "SELECT * FROM questions WHERE lessonId = '" . $rowLesson['id'] . "'";
        $Questions = $mySQLConnection->query($Questions);

        $questionIndex = 0;

        // For all questions
        while($rowQuestion = $Questions->fetch_assoc()) {

            $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->questions[$questionIndex] = new stdClass();
            $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->questions[$questionIndex]->question = $rowQuestion['question'];
            $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->questions[$questionIndex]->correct = $rowQuestion['correctAnswer'];

            $Answers = "SELECT * FROM answers WHERE questionId = '" . $rowQuestion['id'] . "'";
            $Answers = $mySQLConnection->query($Answers);

            $answersIndex = 0;

            // For all answers
            while($rowAnswer = $Answers->fetch_assoc()) {
                $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->questions[$questionIndex]->answers[$answersIndex] = new stdClass();
                $jsonResponse->semesters[$semesterIndex]->lessons[$lessonIndex]->questions[$questionIndex]->answers[$answersIndex]->answer = $rowAnswer['answer'];

                $answersIndex++;
            }
            $questionIndex++;
        }
        $lessonIndex++;
    }
    $semesterIndex++;
}

if(isset($_GET['download'])) {
    echo json_encode($jsonResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo "<code class=\"prettyprint\"><pre>";
    echo json_encode($jsonResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "</pre></code>";


    // Save document file
    $fp = fopen('.\public\document.json', 'w');
    fwrite($fp, json_encode($jsonResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fclose($fp);
}
