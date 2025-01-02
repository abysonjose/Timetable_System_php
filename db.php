<?php
$host = 'localhost';
$username = 'root'; // Change if necessary
$password = ''; // Change if necessary
$db_name = 'timetable_system';

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
