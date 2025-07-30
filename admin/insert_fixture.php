<?php
// Get submitted form data
$matchNo = $_POST['match'];
$home = $_POST['home_team'];
$away = $_POST['away_team'];

// Connect to database
include 'db_connect.php';

// Check connection
if (!$conn) {
    die("Connection failed: ");
}

// Insert data into fixtures table
$sql = "INSERT INTO add_fixture (fixture_id, home_team, away_team) VALUES ('$matchNo', '$home', '$away')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // echo "Fixture added successfully!";
    // echo "<script>alert('Fixture inserted');</script>";
    header("Location: admin_fixture.php");
}
else{
    echo "Error";
}

mysqli_close($conn);
?>
