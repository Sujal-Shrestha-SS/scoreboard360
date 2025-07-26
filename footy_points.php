<!-- points_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Full Points Table</title>
  <link rel="stylesheet" href="arenaStyles.css">
  <style>
    .points-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      border: 1px solid #ccc;
    }

    .points-table th, 
    .points-table td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ccc;
    }

    .points-table thead {
      background-color: #26355D;
      color: white;
    }

    .points-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .points-table td strong {
      color: #1e90ff;
    }

    .points {
      margin: 30px;
    }

    h2 {
      color: #26355D;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="zone-card points">
    <h2>Full Points Table</h2>
    <table class="points-table">
      <thead>
        <tr>
          <th>Team</th>
          <th>Played</th>
          <th>Wins</th>
          <th>Draws</th>
          <th>Losses</th>
          <th>Points</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include 'admin/db_connect.php';

          $sql = "SELECT team, played, win, draw, loss, points FROM points ORDER BY points DESC, win DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . htmlspecialchars($row['team']) . "</td>
                      <td>{$row['played']}</td>
                      <td>{$row['win']}</td>
                      <td>{$row['draw']}</td>
                      <td>{$row['loss']}</td>
                      <td><strong>{$row['points']}</strong></td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='6'>No data available.</td></tr>";
          }

          $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
