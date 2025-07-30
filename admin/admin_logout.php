<?php

include 'admin_sessionCheck.php';
session_unset();
header('location: ../index.html');

?>
