<?php
include 'db_connect.php';

// Step 1: Clear existing points table
mysqli_query($conn, "DELETE FROM points");

// Step 2: Re-insert all teams from current fixtures
$getFixtures = mysqli_query($conn, "SELECT home_team, away_team FROM add_fixture");
$teamsAdded = [];

while ($fixture = mysqli_fetch_assoc($getFixtures)) {
  foreach ([$fixture['home_team'], $fixture['away_team']] as $team) {
    if (!in_array($team, $teamsAdded)) {
      mysqli_query($conn, "
        INSERT INTO points (team, win, draw, loss, points, played)
        VALUES ('$team', 0, 0, 0, 0, 0)
      ");
      $teamsAdded[] = $team;
    }
  }
}

// Step 3: Update WIN count
mysqli_query($conn, "
  UPDATE points 
  SET win = (
    SELECT COUNT(*) FROM results WHERE status = points.team
  )
");

// Step 4: Update DRAW count
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

// Step 5: Update LOSS count
mysqli_query($conn, "
  UPDATE points 
  SET loss = (
    SELECT COUNT(*) 
    FROM results r 
    JOIN add_fixture af ON r.fixture_id = af.fixture_id
    WHERE (af.home_team = points.team OR af.away_team = points.team)
  ) - win - draw
");

// Step 6: Update POINTS (3 for win, 1 for draw)
mysqli_query($conn, "
  UPDATE points 
  SET points = win * 3 + draw * 1
");

// Step 7: Update PLAYED matches
mysqli_query($conn, "
  UPDATE points 
  SET played = (
    SELECT COUNT(*) 
    FROM results r 
    JOIN add_fixture af ON r.fixture_id = af.fixture_id
    WHERE af.home_team = points.team OR af.away_team = points.team
  )
");

echo "Points table recalculated successfully!";
mysqli_close($conn);
?>
