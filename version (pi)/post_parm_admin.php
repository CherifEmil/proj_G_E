<?php
$servername ="localhost";
$username ="kaiser";
$password = "";
$api_key_value = "lecherifamine";
$dbname = "testee";

$api_key= $admin_id = $table = $value1 = $value2 = $admin_comment = $admin_id = $c_rssi = $r_rssi = $c_jrssi = $r_jrssi ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $table = test_input($_POST["table"]);
        $admin_id = test_input($_POST["admin_id"]);
        $admin_comment = test_input($_POST["admin_comment"]);
        $c_rssi = test_input($_POST["c_rssi"]);
        $r_rssi = test_input($_POST["r_rssi"]);
        $c_jrssi = test_input($_POST["c_jrssi"]);
        $r_jrssi = test_input($_POST["r_jrssi"]);
        

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO pram_admi (admin_id, admin_comment, c_rssi, r_rssi, c_jrssi, r_jrssi)
        VALUES ('" . $admin_id . "', '" . $admin_comment . "', '" . $c_rssi . "', '" . $r_rssi . "', '" . $c_jrssi . "', '" . $r_jrssi . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>