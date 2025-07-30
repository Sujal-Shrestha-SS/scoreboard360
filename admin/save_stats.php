<?php
include 'db_connect.php';

// Get the action and fixture ID
$action = $_POST['action'] ?? 'save';
$fixture_id = $_POST['fixture_id'];

// If updating, delete all goal records for this fixture once before inserting
if ($action === 'update') {
  $delete_sql = "DELETE FROM goal_details WHERE fixture_id = '$fixture_id'";
  mysqli_query($conn, $delete_sql);
}

// Loop through submitted goal entries and insert them
foreach ($_POST['player_name'] as $i => $player) {
  $assist = $_POST['assist_by'][$i];
  $team = $_POST['team'][$i];

  // Basic check to avoid inserting empty entries
  if (!empty($player) && !empty($team)) {
    $insert_sql = "INSERT INTO goal_details (fixture_id, player_name, assist_by, team) 
                   VALUES ('$fixture_id', '$player', '$assist', '$team')";
    mysqli_query($conn, $insert_sql);
  }
}

// Optional: Return success message or redirect
echo ($action === 'update') 
  // ? "Goals updated for fixture $fixture_id." 
  // : "Goals saved for fixture $fixture_id.";

 ? header("Location: admin_manage_stats.php")
 : header("Location: admin_manage_stats.php");
?>
