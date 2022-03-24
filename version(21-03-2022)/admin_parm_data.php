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
            '
            <script>  
            if((parseInt(window.localStorage.getItem("c_rssi")) != parseInt("'. $c_rssi .'"))
            ||(parseInt(window.localStorage.getItem("r_rssi")) != parseInt("'. $r_rssi .'"))
            ||(parseInt(window.localStorage.getItem("c_jrssi")) != parseInt("'. $c_jrssi .'"))
            ||(parseInt(window.localStorage.getItem("r_jrssi")) != parseInt("'. $r_jrssi .'"))){
                        localStorage.setItem("o_c_rssi",window.localStorage.getItem("c_rssi"));
                        localStorage.setItem("o_r_rssi",window.localStorage.getItem("r_rssi"));
                        localStorage.setItem("o_c_jrssi",window.localStorage.getItem("c_jrssi"));
                        localStorage.setItem("o_r_jrssi",window.localStorage.getItem("r_jrssi"));
                        localStorage.setItem("admin_id","'. $admin_id . '");
                        localStorage.setItem("admin_comment","'. $admin_comment .'");
                        localStorage.setItem("c_rssi",'. $c_rssi .');
                        localStorage.setItem("r_rssi",'. $r_rssi  .');
                        localStorage.setItem("c_jrssi",'. $c_jrssi .');
                        localStorage.setItem("r_jrssi" ,'. $r_jrssi .');
            
            }
             else{
                localStorage.setItem("o_c_rssi",window.localStorage.getItem("c_rssi"));
                localStorage.setItem("o_r_rssi",window.localStorage.getItem("r_rssi"));
                localStorage.setItem("o_c_jrssi",window.localStorage.getItem("c_jrssi"));
                localStorage.setItem("o_r_jrssi",window.localStorage.getItem("r_jrssi"));
    
            }
             </script>

        ');
    }
    $result->free();
}

$conn->close();
?>