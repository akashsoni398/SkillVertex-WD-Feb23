<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpasswd = "";
$dbdatabase = "music_hub";

$conn = mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbdatabase);

if(!$conn) {
    $dbmessage = mysqli_connect_error();
}
?>