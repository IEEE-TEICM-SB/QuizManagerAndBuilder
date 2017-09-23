<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

require_once ("config.php");

if(!isset($_GET['semesterId'])) {
    echo "<script>window.location = \"index.php\";</script>";
}

require_once ("lessons-ui.php");



// Do backend stuff
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "addLesson" : {
            addLesson($mySQLConnection);
            break;
        }
        case "showQuestions": {
            showQuestions();
            break;
        }
        case "updateLessonName": {
            updateName($mySQLConnection);
            break;
        }
        case "deleteLesson": {
            deleteLesson($mySQLConnection);
            break;
        }
        default: {
            die();
        }
    }
}

function addLesson($mySQLConnection) {
    $semesterId = $_GET['semesterId'];
    $name = $_GET['lessonName'];
    $Query = "INSERT INTO lessons (id, semesterId, name) VALUES (NULL, '$semesterId', '$name')";
    $mySQLConnection->query($Query);

    echo "<script>window.location = \"lessons.php?semesterId=$semesterId\";</script>";
}

function showQuestions() {
    $lessonId = $_GET['lessonId'];
    echo "<script>window.location = \"questions.php?lessonId=$lessonId\";</script>";
}

function updateName($mySQLConnection) {
    $semesterId = $_GET['semesterId'];
    $id = $_GET['lessonId'];
    $newName = $_GET['lessonName'];
    $Query = "UPDATE lessons SET name = '$newName' WHERE id = '$id'";
    $mySQLConnection->query($Query);

    echo "<script>window.location = \"lessons.php?semesterId=$semesterId\";</script>";
}

function deleteLesson($mySQLConnection) {
    $semesterId = $_GET['semesterId'];
    $id = $_GET['lessonId'];
    $Query = "DELETE FROM lessons WHERE id = '$id'";
    $mySQLConnection->query($Query);

    echo "<script>window.location = \"lessons.php?semesterId=$semesterId\";</script>";
}