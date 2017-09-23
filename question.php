<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

require_once ("config.php");
require_once ("question-ui.php");

if(!isset($_GET['lessonId'], $_GET['numberOfAnswers'])) {
    echo "<script>window.location = \"index.php\";</script>";
}


// Do backend stuff
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "addQuestion": {
            addQuestion($mySQLConnection);
            break;
        }
        case "updateQuestion": {
            updateQuestion($mySQLConnection);
            break;
        }
        default: {
            die();
        }
    }
}

function addQuestion($mySQLConnection) {

    $lessonId = $_GET['lessonId'];
    $question = $_GET['question'];
    $correctAnswer = $_GET['correctAnswer'];
    $numberOfAnswers = $_GET['numberOfAnswers'];
    for($i = 1; $i <= $numberOfAnswers; $i++) {
        $answers[$i] = $_GET['answerNo'.$i];
    }

    // Insert Question
    $InsertQuestion = "INSERT INTO questions(`id`, `lessonId`, `question`, `correctAnswer`) VALUES (NULL ,'$lessonId','$question','$correctAnswer')";
    $mySQLConnection->query($InsertQuestion);
    $QuestionID = $mySQLConnection->insert_id;

    // Insert Answers
    for($i = 1; $i <= $numberOfAnswers; $i++) {
        $InsertAnswers = "INSERT INTO answers (id, questionId, answer) VALUES (NULL, '$QuestionID', '$answers[$i]')";
        $mySQLConnection->query($InsertAnswers);
    }

   echo "<script>window.location = \"questions.php?lessonId=$lessonId\";</script>";

}

function updateQuestion($mySQLConnection) {
    $lessonId = $_GET['lessonId'];
    $questionId = $_GET['questionId'];
    $question = $_GET['question'];
    $correctAnswer = $_GET['correctAnswer'];
    $numberOfAnswers = $_GET['numberOfAnswers'];
    for($i = 1; $i < $numberOfAnswers; $i++) {
        $answers[$i] = $_GET['answerNo'.$i];
    }

    // Update Question
    $InsertQuestion = "UPDATE questions SET question = '$question', correctAnswer = '$correctAnswer' WHERE id='$questionId'";
    $mySQLConnection->query($InsertQuestion);

    // Update Answers
    $Answers = "SELECT id FROM answers WHERE questionId = '$questionId'";
    $Answers = $mySQLConnection->query($Answers);

    $i = 1;
    while($Row = $Answers->fetch_assoc()) {
        $InsertAnswers = "UPDATE answers SET answer = '$answers[$i]' WHERE questionId='$questionId' AND id='" . $Row['id'] . "'";
        $mySQLConnection->query($InsertAnswers);
        $i++;
    }

    echo "<script>window.location = \"questions.php?lessonId=$lessonId\";</script>";
}