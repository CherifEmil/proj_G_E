<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <title>Document</title>
</head>
<body>
<?php
$servername ="127.0.0.1:3306";


$dbname = "testee";

$username ="kaiser";

$password = "";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, admin_id, admin_comment, c_rssi, r_rssi, c_jrssi, r_jrssi, 'time'  FROM pram_admi ORDER BY id DESC limit 1";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $admin_id = $row["admin_id"];
        $admin_comment =$row["admin_comment"];
        $c_rssi = $row["c_rssi"];
        $r_rssi = $row["r_rssi"];
        $c_jrssi = $row["c_jrssi"];
        $r_jrssi =$row["r_jrssi"];
        echo(
            '<script>  
            var alerte=0;
            var delta_alerte=0;
            var warn=0;
            var delta_warn=0;
            if((parseInt(window.localStorage.getItem("c_rssi")) != '. $c_rssi .')
            ||(parseInt(window.localStorage.getItem("r_rssi")) != '. $r_rssi .')
            ||(parseInt(window.localStorage.getItem("c_jrssi")) != '. $c_jrssi .')
            ||(parseInt(window.localStorage.getItem("r_rssi")) != '. $r_jrssi .')){
                         localStorage.setItem("admin_id","'. $admin_id . '");
                        localStorage.setItem("admin_comment","'. $admin_comment .'");
                        localStorage.setItem("c_rssi",'. $c_rssi .');
                        localStorage.setItem("r_rssi",'. $r_rssi  .');
                        localStorage.setItem("c_jrssi",'. $c_jrssi .');
                        localStorage.setItem("r_jrssi" ,'. $r_jrssi .');
                        
             alerte='. $c_rssi .';
             delta_alerte= '. $r_rssi .';
             warn= '. $c_jrssi .';
             delta_warn='. $r_jrssi .';
             else{
    
            }
             </script>
             <label for="nb_crit_alert">RSSI critique pour lallert:</label>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id="nb_crit_alert" ><br><br>
             <label for="nb_incert_crit_alert">Incertitude de cette allerte:</label>
             &nbsp;&nbsp;<input type="number" id="nb_incert_crit_alert"><br><br>
             <label for="nb_crit_war">RSSI critique pour la zone jaune:</label>
             <input type="number" id="nb_crit_war"><br><br>
             <label for="nb_incert_crit_war">Incertitude de la zone jaune:</label>
             &nbsp; &nbsp;&nbsp;<input type="number" id="nb_incert_crit_war"><br><br>
             <label for="admin_api_key">Admin ID:</label>
             &nbsp; &nbsp;&nbsp;<input type="text" id="admin_api_key"><br><br>
             <button id="set_Param">Changer les paramètres</button>
            }
           
            
        ');
    }
    $result->free();
}

$conn->close();
?>
</body>
</html>