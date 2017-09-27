<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

$Query = "SELECT * FROM semesters";
$Result = $mySQLConnection->query($Query);


echo "<ul class=\"breadcrumb\">";
echo "<li><a href=\".\">Αρχική</a></li>";
echo "</ul>";


echo "<form action='index.php' method='get'>";
echo "<table class='table'>";
echo "<tr>";
echo "<td><input class=\"form-control\" placeholder='Όνομα εξαμήνου' type=\"text\" name=\"semesterName\" value=\"\"></td>";
echo "<td><button class='btn btn-primary' name=\"action\" type=\"submit\" value=\"addSemester\">Προσθήκη εξαμήνου</button></td>";
echo "</tr>";
echo "</table>";
echo "</form>";


echo "<table class=\"table\" style=\"width:100%\">";
echo "<tr align='center'>";
echo "<th>Αναγνωριστικό</th>";
echo "<th>Όνομα εξαμήνου</th>";
echo "<th>Ενέργειες</th>";
echo "</tr>";
while($Row = $Result->fetch_assoc()) {
    printASemesterObject($Row['id'], $Row['name']);
}
echo "</table>";

function printASemesterObject($id, $name) {
    echo "<form action='index.php' method='get'>";
    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . "<input class=\"form-control\" placeholder='Όνομα εξαμήνου' type=\"text\" name=\"semesterName\" style='width:100%' value=\"$name\">" . "</td>";

    echo "<td>";
    echo "<input type=\"hidden\" name=\"semesterId\" value=\"$id\">";
    echo "<div class=\"btn-group\">";
    echo "<button class='btn btn-primary' name=\"action\" type=\"submit\" value=\"showLessons\">Εμφάνιση μαθημάτων</button>";
    echo "<button class='btn btn-success' name=\"action\" type=\"submit\" value=\"updateSemesterName\">Ενημέρωση ονόματος</button>";
    echo "<button class='btn btn-danger' name=\"action\" type=\"submit\" value=\"deleteSemester\">Διαγραφή</button>";
    echo "</div>";
    echo "</td>";

    echo "</tr>";
    echo "</form>";
}

require_once ("footer.php");