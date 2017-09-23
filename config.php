<?php
/**
 * Owner: IEEE Student Branch - TEI of Central Macedonia
 * Developer: Jordan Kostelidis
 * Date: 23/9/2017
 * License: MIT License
 */

// Turn off all PHP error reporting
// Set 0 for production, set -1 for development
error_reporting(-1);

// Set MySQL Connection Info
define("Host", "localhost");
define("Port", "3306");
define("Username", "root");
define("Password", "");
define("Database", "quizdatabase");

// Set App Info
define("AppName", "Quiz Manager and Builder");
define("AppDesc", "The Back-End for our Quiz Engine !");
define("BuildTime", date("Y/m/d"));

// Try connect with MySQL Server, if can't print a JSON message and exit
try {
    // Try connect with mySQL Server and Database
    $mySQLConnection = mysqli_connect(Host, Username, Password, Database, Port);

    // Set Charset as utf8 for this connection
    mysqli_set_charset($mySQLConnection, "utf8");

    // Check if connection failed
    if (!$mySQLConnection) {
        die("ERROR");
    }

} catch (Exception $ex) {
    die("ERROR");
}

if (!isset($_GET['download'])) {
    require_once("header.php");
}

/**
 * Close passed MySQL connection
 * @param $mySQLConnection
 */
function closeMySQLConnection($mySQLConnection)
{
    mysqli_close($mySQLConnection);
}