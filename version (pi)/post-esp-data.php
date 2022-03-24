<?php
$servername ="localhost";
$username ="kaiser";
$password = "";
$api_key_value = "tPmAT5Ab3j7F9";
$dbname = "testee";

$api_key= $sensor = $table = $value1 = $value2 =$ip= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $table = test_input($_POST["table"]);
        $sensor = test_input($_POST["sensor"]);
        $ip = test_input($_POST["ip"]);
        $value1 = test_input($_POST["value1"]);
        $value2 = test_input($_POST["value2"]);
        

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO esp32_1 (sensor, ip, value1, value2)
        VALUES ('" . $sensor . "', '" . $ip . "', '" . $value1 . "', '" . $value2 . "')";
        
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