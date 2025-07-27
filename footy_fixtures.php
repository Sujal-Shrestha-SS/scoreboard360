<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - View Fixtures</title>

  <link rel="stylesheet" href="arenaStyles.css">
 
  <style>
    

    .fixture {
      margin: 20px;
      flex: 1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #26355D;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .update-btn {
    background-color: #1e90ff;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    font-weight: bold;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: background-color 0.3s ease;
  }

  .update-btn:hover {
    background-color: #005bb5;
  }

    

 
  </style>
</head>
<body>
  

    <!-- Fixture Viewer -->
    <div class="zone-card fixture">
      <h2>Match Results</h2>


  <table>
    <tr>
      <th>Home Team</th>
      <th>Score</th>
      <th>Away Team</th>
    </tr>

    <?php
      include 'admin/db_connect.php';

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT f.home_team, f.away_team, r.home_score, r.away_score 
              FROM add_fixture f 
              LEFT JOIN results r ON r.fixture_id = f.fixture_id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $home = htmlspecialchars($row['home_team']);
          $away = htmlspecialchars($row['away_team']);
          $home_score = $row['home_score'];
          $away_score = $row['away_score'];

          echo "<tr>
                  <td>{$home}</td>
                  <td>{$home_score} - {$away_score}</td>
                  <td>{$away}</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No match results available.</td></tr>";
      }

      $conn->close();
  
      ?>
      </table>

     
      


      
    
  </div>
</body>
</html>