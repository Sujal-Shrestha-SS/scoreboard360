<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin' && $password === 'admin123') {
  $_SESSION['admin_logged_in'] = true;
  header("Location: admin_fixture.php");
  exit();
} else {
  echo "<script>alert('Invalid credentials'); window.location.href='admin_login.html';</script>";
}
?>
