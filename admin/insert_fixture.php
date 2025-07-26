<?php
// Get submitted form data
$matchNo = $_POST['match'];
$home = $_POST['home_team'];
$away = $_POST['away_team'];

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "scoreboard360");

// Check connection
if (!$conn) {
    die("Connection failed: ");
}

// Insert data into fixtures table
$sql = "INSERT INTO add_fixture (fixture_id, home_team, away_team) VALUES ('$matchNo', '$home', '$away')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Fixture added successfully!";
}

mysqli_close($conn);
?>
