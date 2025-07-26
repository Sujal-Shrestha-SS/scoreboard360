<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Fixtures – Admin Panel</title>

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6fa;
      color: #333;
    }
    .dashboard { 
      display: flex; 
      min-height: 100vh; 
    }
    .sidebar {
      width: 240px;
      background: #26355D;
      color: white;
      padding: 20px;
    }
    .sidebar h2 { 
      font-size: 1.3em; 
      margin-bottom: 20px; 
      color: #FFDC60; 
    }
    .sidebar ul { 
      list-style: none; 
      padding: 0; 
    }
    .sidebar li { 
      margin-bottom: 15px; 
    }
    
    .sidebar a {
      color: white;
      text-decoration: none;
      font-weight: 500;
    }
    .sidebar a:hover {
      text-decoration: underline;
      color: #FFDC60;
    }

    .zone-card.fixture { 
      flex: 1; 
      padding: 30px; 
    }

    .match {
      background: white;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .score-entry {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 6px;
    }
    .score-input {
      width: 50px;
      padding: 6px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-weight: bold;
    }
    .teams {
      font-weight: bold;
      color: #26355D;
      min-width: 140px;
      text-align: center;
    }
    
    .save-btn {
      background-color: #1e90ff;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      display: block;
      margin: 0 auto;
    }
    .save-btn:hover , .update-btn:hover {
      background-color: #005bb5;
    }

    .update-btn {
      background-color: #1e90ff;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      
      
    }
    .details-link {
      display: inline-block;
      margin-top: 10px;
      font-weight: bold;
      color: #1e90ff;
      text-decoration: none;
    }
    .details-link:hover {
      text-decoration: underline;
      color: #26355D;
    }
  </style>
</head>

<body>
  <div class="dashboard">
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <nav>
        <ul>
          <li><a href="admin_fixture.html">Add Fixtures</a></li>
          <li><a href="admin_view_fixture.php">View Fixtures</a></li>
          <li><a href="admin_update_results.php">Update Results</a></li>
          <li><a href="admin_view_results.php">View Results</a></li>
          <li><a href="#">Manage Player Stats</a></li>
          <li><a href="../index.html">Back to Home</a></li>
      </nav>
    </aside>

    <div class="zone-card fixture">
      <h2>📅 Fixtures</h2>

      <?php
  $conn = mysqli_connect("localhost", "root", "", "scoreboard360");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT fixture_id, home_team, away_team FROM add_fixture";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['fixture_id'];
      $home = htmlspecialchars($row['home_team']);
      $away = htmlspecialchars($row['away_team']);

      echo "
        <form action='save_result.php' method='POST' class='match'>
          <div class='score-entry'>
            <input type='hidden' name='fixture_id' value='$id'>
            <input type='number' name='home_score' placeholder='Home' class='score-input left' required />
            <span class='teams'>{$home} vs {$away}</span>
            <input type='number' name='away_score' placeholder='Away' class='score-input right' required />
          </div>
          
          <button type='submit' class='save-btn'>Save</button>
          <button type='submit' class='update-btn'>Update</button>
        </form>
      ";
    }
  } else {
    echo "<p>No fixtures available.</p>";
  }

  mysqli_close($conn);
?>


      <a href="fixtures.html" class="details-link">View all fixtures →</a>
    </div>
  </div>
</body>
</html>