<?php
$fixture_id = $_POST['fixture_id'];
$home_score = $_POST['home_score'];
$away_score = $_POST['away_score'];

$conn = mysqli_connect("localhost", "root", "", "scoreboard360");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO results (fixture_id, home_score, away_score) VALUES ('$fixture_id', '$home_score', '$away_score')";

if (mysqli_query($conn, $sql)) {
  echo "✅ Score saved successfully!";
} else {
  echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
