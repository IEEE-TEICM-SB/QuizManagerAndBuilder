<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

require_once("header.php");
require_once ("user.php");

if(isset($_GET['logout'])) {
    setcookie("season_id", md5(""), time()-3600);  /* expire in 1 hour */
    echo "<script>window.location = \"index.php\";</script>";
}

if(isset($_POST['backLink'])) {
    $backLink = $_POST['backLink'];
} else {
    $backLink = "index.php";
}

echo "<table class='table'>";
echo "<form action='auth.php' method='post'>";
echo "<tr>";
echo "<td><input class=\"form-control\" placeholder=\"Όνομα χρήστη\" type=\"text\" name=\"username\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input class=\"form-control\" placeholder=\"Κωδικός\" type=\"password\" name=\"password\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td><button class='btn btn-primary' style='width: 100%' name=\"action\" type=\"submit\">Login</button></td>";
echo "</tr>";
echo "</form>";
echo "</table>";

if(isset($_POST['username'], $_POST['password'])) {
    // Logic

    if($_POST['username'] == $username) {
        if($_POST['password'] == $password) {
            setcookie("season_id", md5($_POST['username'].$_POST['password']), time()+3600);  /* expire in 1 hour */
            echo "<script>window.location = \"$backLink\";</script>";
        } else {
            echo "Λάθος κωδικός";
        }
    } else {
        echo "Λάθος όνομα χρήστη";
    }

}

require_once("footer.php");