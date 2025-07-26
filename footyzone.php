<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ScoreBoard360 - Football Zone</title>

  <link rel="stylesheet" href="arenaStyles.css">

  <style>
    .back-home {
  text-align: center;
  margin: 30px 0 10px;
  
}

.back-home a {
  text-decoration: none;
  color: #26355D;
  font-weight: bold;
  font-size: 1em;
  transition: color 0.3s ease;
}

.back-home a:hover {
  color: #1e90ff;
}



  </style>
  
</head>
<body>
  <header>
    <h1>ScoreBoard360: Football Zone</h1>
    <p>NCIT Sports Week 2025 • ⚽ Department League Showdown</p>
  </header>

  <main class="football-zone">
    <div class="zone-card fixture">
      <h2>Results</h2>
    <?php
      $conn = mysqli_connect("localhost", "root", "", "scoreboard360");
      $sql = "SELECT home_team, away_team FROM add_fixture";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        die("Connection failed.");
      }

      $matchCount = 0;
      $maxToShow = 3;

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $matchCount++;
          if ($matchCount > $maxToShow) {
            break;
          }

          $home = htmlspecialchars($row['home_team']);
          $away = htmlspecialchars($row['away_team']);
          echo "<div class='match'><span class='teams'>{$home} vs {$away}</span></div>";
        }
      } else {
        echo "<p>No fixtures available.</p>";
      }

      mysqli_close($conn);
?>

      <a href="footy_fixtures.php" class="details-link">View all results →</a>
    </div>

    <div class="zone-card points">
      <h2>📊 Points Table</h2>
      <table class="points-table">
        <thead>
          <tr>
            <th>Team</th>
            <th>P</th>
            <th>W</th>
            <th>L</th>
            <th>Pts</th></tr>
        </thead>
        <tbody>
          <tr>
            <td>CSE</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>6</td>
        </tr>
          <tr>
            <td>ECE</td>
            <td>3</td>
            <td>2</td>
            <td>1</td>
            <td>6</td>
        </tr>
          <tr>
            <td>Civil</td>
            <td>3</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
        </tr>
        </tbody>
      </table>
      <a href="points.html" class="details-link">Full standings →</a>
    </div>

    <div class="zone-card stats">
      <h2>🎯 Player Stats</h2>
      <ul class="stats">
        <li><strong>Top Scorer:</strong> S. Shrestha - 5 Goals</li>
        <li><strong>Most Assists:</strong> I. Neupane - 3 Assists</li>
        <li><strong>Clean Sheets:</strong> A. Ghimire - 2 Matches</li>
      </ul>
      <a href="stats.html" class="details-link">Explore player stats →</a>
    </div>

     <div class="back-home">
  <a href="index.html">← Back to ScoreBoard360 Home</a>
</div>
  </main>

  <footer>
    <p>&copy; 2025 ScoreBoard360 • Developed for NCIT Sports Events</p>
    
  </footer>
</body>
</html>
