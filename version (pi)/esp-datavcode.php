<?php
$servername ="localhost";


$dbname = "testee";

$username ="kaiser";

$password = "";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT   id, sensor, ip, value1, value2, reading_time FROM esp32_1 ORDER BY id DESC limit 3";

echo '<table cellspacing="5" cellpadding="5">
    <tr> 
        <td>ID</td> 
        <td>Sensor</td> 
        <td>Location</td> 
        <td>RSSI wifi</td> 
        <td>RSSI BLE</td>
        <td>Timestamp</td> 
    </tr>';

if ($result = $conn->query($sql)) {
    $counter=1;
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
                <script>localStorage.setItem(' . $counter .','. $row_value2 .')</script>
                <script>localStorage.setItem(' . $counter+2000 .','. $row_value1 .')</script>
                <script>localStorage.setItem(' . $counter+1000 .','. $row_id .')</script>
            </tr>';
            $counter++;
    }
    $result->free();
}

$conn->close();
?>