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
    }

    

   
  </style>
</head>
<body>
  <?php

  include 'admin_sidebar.php';

  ?>

    <!-- View Fixture -->
    <div class="zone-card fixture">
      <h2>Fixtures</h2>

      <?php
        include 'db_connect.php';
        $sql = "SELECT home_team, away_team FROM add_fixture";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
          die("Connection failed: ");
        }

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $home = $row['home_team'];
            $away = $row['away_team'];
            echo "<div class='match'>
                    <span class='teams'>{$home} vs {$away}</span>
                  </div>";
          }
        } else {
          echo "<p>No fixtures scheduled yet.</p>";
        }

  mysqli_close($conn);
?>


    </div>
  </div>
</body>
</html>
