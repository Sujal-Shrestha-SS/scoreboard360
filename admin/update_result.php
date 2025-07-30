<?php


include 'db_connect.php';

$fixture_id = $_POST['fixture_id'];
$home_score = $_POST['home_score'];
$away_score = $_POST['away_score'];



//Update new score
$sql = "UPDATE results SET home_score = $home_score , away_score = $away_score WHERE fixture_id = $fixture_id";
$result = mysqli_query($conn, $sql);

if($result){
    echo "Update Successful";
    

    $statusSql = "
    UPDATE results r
    JOIN add_fixture af ON r.fixture_id = af.fixture_id
    SET r.status = 
      CASE
        WHEN r.home_score > r.away_score THEN af.home_team
        WHEN r.home_score < r.away_score THEN af.away_team
        ELSE 'Draw'
      END
    WHERE r.fixture_id = '$fixture_id'
  ";

  if (mysqli_query($conn, $statusSql)) {
    // echo "Match status updated successfully!";
    header("Location: admin_update_results.php");
  } else {
    echo "Error updating status: " . mysqli_error($conn);
  }
}

else{
    echo "Update failed";
}


mysqli_close($conn);
?>
