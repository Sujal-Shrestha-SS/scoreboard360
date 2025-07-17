<?php
// Get submitted form data
$matchNo = $_POST['match'];
$home = $_POST['home_team'];
$away = $_POST['away_team'];

// Connect to database
$conn = new mysqli("localhost", "root", "", "scoreboard360");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into fixtures table
$sql = "INSERT INTO add_fixture (fixture_id, home_team, away_team) VALUES ('$matchNo', '$home', '$away')";
if ($conn->query($sql) === TRUE) {
    echo "Fixture added successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
