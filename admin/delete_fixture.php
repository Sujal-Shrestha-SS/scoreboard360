<?php
include 'db_connect.php';

$fixture_id = $_POST['fixture_id'];

// Step 1: Delete match result
mysqli_query($conn, "DELETE FROM results WHERE fixture_id = '$fixture_id'");

// Step 2: Delete the fixture itself
mysqli_query($conn, "DELETE FROM add_fixture WHERE fixture_id = '$fixture_id'");

mysqli_query($conn, "DELETE FROM goal_details WHERE fixture_id = '$fixture_id'");

// Step 3: Trigger points recalculation
include 'recalculate_points.php';

// Optional: Redirect back to fixture list
header("Location: admin_view_fixture.php");
exit;
?>
