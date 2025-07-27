<?php
include('admin/db_connect.php');

// Top Goal Scorers
$topScorers = mysqli_query($conn, "
  SELECT player_name, COUNT(*) AS goals
  FROM goal_details
  GROUP BY player_name
  ORDER BY goals DESC
  LIMIT 10
");

// Top Assisters
$topAssisters = mysqli_query($conn, "
  SELECT assist_by AS player_name, COUNT(*) AS assists
  FROM goal_details
  WHERE assist_by IS NOT NULL AND assist_by != ''
  GROUP BY assist_by
  ORDER BY assists DESC
  LIMIT 10
");

// Combined Goals + Assists
$combinedStats = mysqli_query($conn, "
  SELECT player_name, 
         COUNT(*) AS goals,
         (SELECT COUNT(*) FROM goal_details WHERE assist_by = gd.player_name) AS assists,
         (COUNT(*) + (SELECT COUNT(*) FROM goal_details WHERE assist_by = gd.player_name)) AS total_contributions
  FROM goal_details gd
  GROUP BY player_name
  ORDER BY total_contributions DESC
  LIMIT 10
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Player Leaderboard</title>

  <link rel="stylesheet" href="arenaStyles.css">
   <link rel="stylesheet" href="sidebar.css">

  <style>
   
    .zone-card.fixture { 
      flex: 1; 
      padding: 30px; 
    }

     .fixture {
      margin: 20px;
      flex: 1;
    }

    h2 {
      color: #26355D;
    }

    table { 
        width: 100%; 
        margin-bottom: 40px; 
        border-collapse: collapse; 
    }

    th, td 
    { padding: 10px; 
        text-align: left; 
        border-bottom: 1px solid #ddd; 
    }

    tr:hover { 
        background-color: #f1f1f1; 
    }

  </style>
</head>
<body>



      <div class="zone-card fixture">
  <h2>Top Goal Scorers</h2>
  <table>
    <tr><th>Player</th><th>Goals</th></tr>
    <?php while($row = mysqli_fetch_assoc($topScorers)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['player_name']) ?></td>
        <td><?= $row['goals'] ?></td>
      </tr>
    <?php } ?>
  </table>

  <h2>Top Assisters</h2>
  <table>
    <tr><th>Player</th><th>Assists</th></tr>
    <?php while($row = mysqli_fetch_assoc($topAssisters)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['player_name']) ?></td>
        <td><?= $row['assists'] ?></td>
      </tr>
    <?php } ?>
  </table>

  <h2>Top G/A Contributers</h2>
  <table>
    <tr><th>Player</th><th>G/A</th></tr>
    <?php while($row = mysqli_fetch_assoc($combinedStats)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['player_name']) ?></td>
        <td><?= $row['total_contributions'] ?></td>
      </tr>
    <?php } ?>
  </table>
    </div>
</body>
</html>
