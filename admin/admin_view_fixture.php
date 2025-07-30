<?php
include 'admin_sessionCheck.php';
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - View Fixtures</title>

  <link rel="stylesheet" href="../arenaStyles.css">
  <link rel="stylesheet" href="../sidebar.css">

  <style>
    .fixture {
      margin: 20px;
      flex: 1;
    }

    .match {
      background: #fff;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .teams {
      font-weight: bold;
      font-size: 18px;
    }

    button {
      background-color: #e63946;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    button:hover {
      background-color: #d62828;
    }

    button:active {
      background-color: #b51717;
      transform: scale(0.98);
    }
  </style>
</head>
<body>

  <?php include 'admin_sidebar.php'; ?>

  <div class="zone-card fixture">
    <h2>🗓️ Fixtures</h2>

    <?php
    $sql = "SELECT fixture_id, home_team, away_team FROM add_fixture";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      echo "<p>Error fetching fixtures: " . mysqli_error($conn) . "</p>";
    } elseif (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $fixture_id = $row['fixture_id'];
        $home = htmlspecialchars($row['home_team']);
        $away = htmlspecialchars($row['away_team']);

        echo "<div class='match'>
                <span class='teams'>{$home} vs {$away}</span>
                <form action='delete_fixture.php' method='post' style='margin-top: 10px;'>
                  <input type='hidden' name='fixture_id' value='{$fixture_id}'>
                  <button type='submit'>Delete</button>
                </form>
              </div>";
      }
    } else {
      echo "<p>No fixtures scheduled yet.</p>";
    }

    mysqli_close($conn);
    ?>
  </div>
</body>
</html>
