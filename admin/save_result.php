<?php
$fixture_id = $_POST['fixture_id'];
$home_score = $_POST['home_score'];
$away_score = $_POST['away_score'];

$conn = mysqli_connect("localhost", "root", "", "scoreboard360");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// 1️⃣ Insert new score
$sql = "INSERT INTO results (fixture_id, home_score, away_score) VALUES ('$fixture_id', '$home_score', '$away_score')";
if (mysqli_query($conn, $sql)) {
  echo "✅ Score saved successfully!<br>";

  // 2️⃣ Update status based on score comparison
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
    echo "🏆 Match status updated successfully!";
  } else {
    echo "Error updating status: " . mysqli_error($conn);
  }

} else {
  echo "Error saving score: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
