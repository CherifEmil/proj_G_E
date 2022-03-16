<!DOCTYPE html>
<html>
  <head>
      <title>sensor</title>
      <link rel="stylesheet" href="style3.css">
      <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
      <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  </head>
<body>
<div class="sidebar">
     <div class="logo_content">
             <div class="logo">
                <a href="#">
                 <i class='bx bxl-gmail bx-tada' ></i>
                 <span class="logo_name">Course Email </span>
                </a>
            </div>
            <i class='bx bx-menu bx-rotate-180' id="btn" ></i>
    </div>
  <ul class="ba">
    <li id="read">
        <a href="#" >
            <i class='bx bx-message-dots'></i>
            <span class="links_name"> La liste de messages</span>
        </a>
        <span class="tooltips"> La liste de messagese</span>
        
    </li>
    <li id="send">
        <a href="#">
            <i class='bx bx-edit-alt' ></i>
            <span class="links_name">Écrire un message</span>
        </a>
        <span class="tooltips">Écrire un message</span>
        
    </li>
    <li id="contacts">
        <a href="#">
            <i class='bx bxs-contact' ></i>
            <span class="links_name">Le carnet d'adresses</span>
        </a>
        <span class="tooltips">Le carnet d'adresses</span>
        
    </li>
  </ul>
</div> 
</div>
<div id="table_data">
    <?php
    $servername ="127.0.0.1:3306";


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
            <td>Value 1</td> 
            <td>Value 2</td>
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
                </tr>';
                $counter++;
        }
        $result->free();
    }

    $conn->close();
    ?>

</table>
</div> 
<div id="optdiv">
    <h6 id="opt" >salut</h6>
</div>

</body>
<script src="./opt.js"></script>
<script src="./slide_B.js"></script>
</html>