<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "data";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn) {
    die('Failed to Connect To Database');
}

?>