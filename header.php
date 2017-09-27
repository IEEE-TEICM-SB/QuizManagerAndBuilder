<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */


echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<title>Quiz Manager and Builder</title>";
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"/icon.ico\"/>";
echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"icon.ico\"/>";
echo "</head>";
echo "<body>";
echo '<nav class="navbar navbar-inverse">';
echo '<div class="container-fluid">';
echo '<div class="navbar-header">';
echo '<a class="navbar-brand" href="./">Διαχειριστής και Κατασκευαστής Quiz</a>';
echo '</div>';
echo '<ul class="nav navbar-nav">';
if(isset($_COOKIE['season_id'])) {
    echo '<li><a href="./">Αρχική</a></li>';
    echo '<li><a href="./generateJson.php">Δημοσίευση JSON</a></li>';
    echo '<li><a href="./generateJson.php?download">Λήψη JSON</a></li>';
    echo '<li><a href="./auth.php?logout">Αποσύνδεση</a></li>';
} else {

}
echo '</ul>';
echo '</div>';
echo '</nav>';
echo '';
echo '<div class="container">';

?>