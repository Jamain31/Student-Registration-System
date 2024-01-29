<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "tuska_university_database";

/* Attempt to connect to MySQL database */
$db = new PDO('mysql:host=localhost:3307;dbname=' . $DB_NAME . ';charset=utf8', $DB_USERNAME, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check connection

?>
