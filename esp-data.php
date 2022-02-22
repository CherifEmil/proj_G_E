<!DOCTYPE html>
<html>
  <head>
      <title>sensor</title>
      <link rel="stylesheet" href="style.css">
  </head>
<body>

<div class="table_data">
    <?php

    header("Refresh:3");
    $servername ="localhost:3306";


    $dbname = "testee";

    $username ="pi";

    $password = " ";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT id, sensor, ip, value1, value2, reading_time FROM esp32_s2_1 ORDER BY id DESC";

    echo '<table cellspacing="5" cellpadding="5">
        <tr> 
            <td>ID</td> 
            <td>Sensor</td> 
            <td>Location</td> 
            <td>Value 1</td> 
            <td>Value 2</td>
            <td>Timestamp</td> 
        </tr>';
    
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_sensor = $row["sensor"];
            $row_ip = $row["ip"];
            $row_value1 = $row["value1"];
            $row_value2 = $row["value2"]; 
            $row_reading_time = $row["reading_time"];
    
            echo '<tr> 
                    <td>' . $row_id . '</td> 
                    <td>' . $row_sensor . '</td> 
                    <td>' . $row_ip . '</td> 
                    <td>' . $row_value1 . '</td> 
                    <td>' . $row_value2 . '</td>
                    <td>' . $row_reading_time . '</td> 
                </tr>';
        }
        $result->free();
    }

    $conn->close();
    ?>
</div> 
</table>
</body>
</html>
