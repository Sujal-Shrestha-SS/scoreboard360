<?php

$host = "localhost";
$user = "root";
$pw = "";
$db = "scoreboard360";

$conn = mysqli_connect($host, $user, $pw, $db);

if(!$conn){
    die("Database not connected");
}