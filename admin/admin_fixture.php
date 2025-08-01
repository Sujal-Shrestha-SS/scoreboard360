<?php

include 'admin_sessionCheck.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

  <link rel="stylesheet" href="../arenaStyles.css">
  <link rel="stylesheet" href="../sidebar.css">


    <style>
        

.fixture {
      margin: 20px;
      
    }
.form{
    padding: 20px;
}

.form label{
    display: inline-block;
    width: 100px;
}

    </style>
</head>
<body>
    <div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <nav>
        <ul>
          <li><a href="admin_fixture.php">Add Fixtures</a></li>
          <li><a href="admin_view_fixture.php">View Fixtures</a></li>
          <li><a href="admin_insert_results.php">Insert Results</a></li>
          <li><a href="admin_view_results.php">View Results</a></li>
          <li><a href="admin_manage_stats.php">Manage Player Stats</a></li>
          <li><a href="admin_view_stats.php">View Player Stats</a></li>
          <li><a href="admin_view_points.php">View Points Table</a></li>

          <li><a href="../index.html">Back to Home</a></li>
          <li><a href="admin_logout.php">Logout</a></li>
        </ul>
      </nav>
    </aside>
    

    <!-- Add fixture -->

    <div class="zone-card fixture">
      <div class="form">
        <h1>Fixture List</h1>

    <form action="insert_fixture.php" method="POST">

  <label for="">Match No: </label>
  <input type="text" id="match" name="match" placeholder="Enter match no."><br><br>
  <label for="home">Home Team: </label>
  <input type="text" id="home" name="home_team" placeholder="Enter home team" required><br><br>
  
  <label for="away">Away Team: </label>
  <input type="text" id="away" name="away_team" placeholder="Enter away team" required><br><br>

  <button type="submit" onclick = "return alert('Fixture inserted');">Enter</button>
</form>


      </div>
        
    </div>
    </div>

    
</body>
</html>