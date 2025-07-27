<?php
$fixture_id = $_POST['fixture_id'];
$home_score = $_POST['home_score'];
$away_score = $_POST['away_score'];

include 'db_connect.php';

// 1️⃣ Save match result
$sql = "INSERT INTO results (fixture_id, home_score, away_score) VALUES ('$fixture_id', '$home_score', '$away_score')";
if (mysqli_query($conn, $sql)) {
  echo "✅ Score saved!<br>";

  // 2️⃣ Update match status
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
  mysqli_query($conn, $statusSql);

  // 3️⃣ Insert missing team rows in points table
  $getTeams = mysqli_query($conn, "
    SELECT home_team, away_team FROM add_fixture WHERE fixture_id = '$fixture_id'
  ");
  $teams = mysqli_fetch_assoc($getTeams);
  foreach ([$teams['home_team'], $teams['away_team']] as $team) {
    mysqli_query($conn, "
      INSERT INTO points (team, win, draw, loss, points)
      SELECT '$team', 0, 0, 0, 0
      FROM DUAL
      WHERE NOT EXISTS (
        SELECT team FROM points WHERE team = '$team'
      )
    ");
  }

  // 4️⃣ Update WIN count based on status matches
  mysqli_query($conn, "
    UPDATE points 
    SET win = (
      SELECT COUNT(*) FROM results WHERE status = team
    )
  ");

  // 5️⃣ Update DRAW count using fixture JOIN for accuracy
  mysqli_query($conn, "
    UPDATE points 
    SET draw = (
      SELECT COUNT(*) 
      FROM results r 
      JOIN add_fixture af ON r.fixture_id = af.fixture_id
      WHERE r.status = 'Draw'
      AND (af.home_team = points.team OR af.away_team = points.team)
    )
  ");

  // 6️⃣ Update LOSS count using total matches - win - draw
  mysqli_query($conn, "
    UPDATE points 
    SET loss = (
      SELECT COUNT(*) 
      FROM results r 
      JOIN add_fixture af ON r.fixture_id = af.fixture_id
      WHERE af.home_team = points.team OR af.away_team = points.team
    ) - win - draw
  ");

  // 7️⃣ Update POINTS based on win (3 pts) and draw (1 pt)
  mysqli_query($conn, "
    UPDATE points SET points = win * 3 + draw * 1
  ");

  // 8️⃣ Update matches played count
mysqli_query($conn, "
  UPDATE points 
  SET played = (
    SELECT COUNT(*) 
    FROM results r 
    JOIN add_fixture af ON r.fixture_id = af.fixture_id
    WHERE af.home_team = points.team OR af.away_team = points.team
  )
");


  echo "🏁 Match status and team stats updated!";
} else {
  echo "❌ Error saving score: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
