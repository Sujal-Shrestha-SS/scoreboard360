<?php 
include 'db_connect.php';
include 'admin_sessionCheck.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Match Stats</title>

  <link rel="stylesheet" href="../arenaStyles.css">
  <link rel="stylesheet" href="../sidebar.css">
  
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6fa;
      color: #333;
    }

    .zone-card.fixture { 
      padding: 30px;
     }
    .fixture {
       margin: 20px; 
      }
    h2 { color: #26355D; }

    .match-box {
      background: white;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .score-line {
      font-weight: bold;
      margin-bottom: 10px;
      color: #1e90ff;
    }

    .goal-row {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
      align-items: center;
      justify-content: center;
    }

    .goal-row input {
      flex: 1;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btn-group {
      display: flex;
      gap: 10px;
      margin-top: 10px;
      justify-content: center;
    }

    .save-btn, .update-btn {
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      color: white;
    }

    .save-btn { background-color: #28a745; }
    .save-btn:hover { background-color: #218838; }

    .update-btn { background-color: #007bff; }
    .update-btn:hover { background-color: #0056b3; }
  </style>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

  <div class="zone-card fixture">
    <h2>Manage Goal Scorers & Assists</h2>

    <?php
    $sql = "SELECT f.fixture_id, f.home_team, f.away_team, r.home_score, r.away_score
            FROM add_fixture f
            JOIN results r ON f.fixture_id = r.fixture_id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $fixture_id = $row['fixture_id'];
        $home = htmlspecialchars($row['home_team']);
        $away = htmlspecialchars($row['away_team']);
        $home_score = (int) $row['home_score'];
        $away_score = (int) $row['away_score'];
        $total_goals = $home_score + $away_score;

        echo "
        <form action='save_stats.php' method='POST' class='match-box'>
          <div class='score-line'>{$home} {$home_score} - {$away_score} {$away}</div>
          <input type='hidden' name='fixture_id' value='$fixture_id'>
          <input type='hidden' name='total_goals' value='$total_goals'>";

        for ($i = 0; $i < $total_goals; $i++) {
          echo "
            <div class='goal-row'>
              <input type='text' name='player_name[]' placeholder='Scorer' required>
              <input type='text' name='assist_by[]' placeholder='Assist By'>
              <input type='text' name='team[]' placeholder='Team (Home/Away)' required>
            </div>";
        }

        echo "
          <div class='btn-group'>
            <button type='submit' name='action' value='save' class='save-btn'>Save Goal Stats</button>
            <button type='submit' name='action' value='update' class='update-btn'>Update Goal Stats</button>
          </div>
        </form>";
      }
    } else {
      echo "<p>No results found. Insert match scores first.</p>";
    }

    mysqli_close($conn);
    ?>
  </div>
</body>
</html>
