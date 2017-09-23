<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

$semesterId = $_GET['semesterId'];

$Query = "SELECT name FROM semesters WHERE id = '$semesterId'";
$Result = $mySQLConnection->query($Query);
$Result = $Result->fetch_assoc();


echo "<ul class=\"breadcrumb\">";
echo "<li><a href=\".\">Portal</a></li>";
echo "<li><a href=\"./lessons.php?semesterId=" . $semesterId ."\">" . $Result['name'] . "</a></li>";

echo "</ul>";


$Query = "SELECT * FROM lessons WHERE semesterId='$semesterId'";
$Result = $mySQLConnection->query($Query);

echo "<form action='lessons.php' method='get'>";
echo "<table class='table'>";
echo "<tr>";
echo "<input type=\"hidden\" name=\"semesterId\" value=\"$semesterId\">";
echo "<td><input class=\"form-control\" placeholder='Name of Lesson' type=\"text\" name=\"lessonName\" value=\"\"></td>";
echo "<td><button class='btn btn-primary' name=\"action\" type=\"submit\" value=\"addLesson\">Add Lesson</button></td>";
echo "</tr>";
echo "</table>";
echo "</form>";


echo "<table class='table'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Actions</th>";
echo "</tr>";
while($Row = $Result->fetch_assoc()) {
    printALessonObject($Row['id'], $Row['name']);
}
echo "</table>";

function printALessonObject($id, $name) {

    $semesterId = $_GET['semesterId'];

    echo "<form action='lessons.php' method='get'>";
    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . "<input class=\"form-control\" placeholder='Name of Lesson' type=\"text\" name=\"lessonName\" style='width:100%' value=\"$name\">" . "</td>";

    echo "<td>";
    echo "<input type=\"hidden\" name=\"semesterId\" value=\"$semesterId\">";
    echo "<input type=\"hidden\" name=\"lessonId\" value=\"$id\">";
    echo "<button class='btn btn-primary' name=\"action\" type=\"submit\" value=\"showQuestions\">Show Questions</button>";
    echo "<button class='btn btn-success' name=\"action\" type=\"submit\" value=\"updateLessonName\">Update Name</button>";
    echo "<button class='btn btn-danger' name=\"action\" type=\"submit\" value=\"deleteLesson\">Delete</button>";
    echo "</td>";

    echo "</tr>";
    echo "</form>";
}

require_once ("footer.php");