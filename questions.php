<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

require_once ("config.php");

if(!isset($_GET['lessonId'])) {
    echo "<script>window.location = \"index.php\";</script>";
}

require_once ("questions-ui.php");


// Do backend stuff
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "addQuestion": {
            addQuestion();
            break;
        }
        case "updateQuestion": {
            updateQuestion();
            break;
        }
        case "deleteQuestion": {
            deleteQuestion($mySQLConnection);
            break;
        }
        default: {
            die();
        }
    }
}

function addQuestion() {
    $lessonId = $_GET['lessonId'];
    $numberOfAnswers = $_GET['numberOfAnswers'];
    echo "<script>window.location = \"question.php?lessonId=$lessonId&numberOfAnswers=$numberOfAnswers\";</script>";
}

function updateQuestion() {
    $lessonId = $_GET['lessonId'];
    $questionId = $_GET['questionId'];
    echo "<script>window.location = \"question.php?lessonId=$lessonId&questionId=$questionId\";</script>";
}

function deleteQuestion($mySQLConnection) {
    $lessonId = $_GET['lessonId'];
    $questionId = $_GET['questionId'];

    $Query = "DELETE FROM questions WHERE id = '$questionId'";
    $mySQLConnection->query($Query);

    echo "<script>window.location = \"questions.php?lessonId=$lessonId\";</script>";

}