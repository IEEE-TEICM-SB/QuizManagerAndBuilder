<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */


require_once ("config.php");
require_once ("index-ui.php");


// Do backend stuff
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "addSemester" : {
            addSemester($mySQLConnection);
            break;
        }
        case "showLessons": {
            showLessons();
            break;
        }
        case "updateSemesterName": {
            updateName($mySQLConnection);
            break;
        }
        case "deleteSemester": {
            deleteSemester($mySQLConnection);
            break;
        }
        default: {
            die();
        }
    }
}

function addSemester($mySQLConnection) {
    $name = $_GET['semesterName'];
    $Query = "INSERT INTO semesters(id, name) VALUES (NULL, '$name')";
    $mySQLConnection->query($Query);

    refreshCurrentView();
}

function showLessons() {
    $semesterId = $_GET['semesterId'];
    echo "<script>window.location = \"lessons.php?semesterId=$semesterId\";</script>";
}

function updateName($mySQLConnection) {
    $id = $_GET['semesterId'];
    $newName = $_GET['semesterName'];
    $Query = "UPDATE semesters SET name = '$newName' WHERE id = '$id'";
    $mySQLConnection->query($Query);

    refreshCurrentView();
}

function deleteSemester($mySQLConnection) {
    $id = $_GET['semesterId'];
    $Query = "DELETE FROM semesters WHERE id = '$id'";
    $mySQLConnection->query($Query);

    refreshCurrentView();
}

function refreshCurrentView() {
    echo "<script>window.location = \"index.php\";</script>";
    die();
}