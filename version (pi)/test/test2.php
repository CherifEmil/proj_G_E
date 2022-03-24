<?php
ob_start();
$dbServername ="127.0.0.1:3306";
$dbUsername ="kaiser";
$dbPassword ="";
$dbName = "testee";
$old_rows_nb=0;
header("refresh: 0.2;");
$mysqli = new mysqli($dbServername,$dbUsername,$dbPassword,$dbName );
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
  $sql = "SELECT Nom, Prenom, age, mess FROM info";
  $result = $mysqli -> query($sql);
  $row_cnt = $result->num_rows;
  printf("Le  résultats a %d lignes.\n", $row_cnt);

  if($old_rows_nb!=$row_cnt){
    $row = $result->fetch_array(MYSQLI_NUM);
  while($row = $result->fetch_array(MYSQLI_NUM))
    { 
     echo "<br>";
     printf("%s %s %s %s (%s) %s\n", $row[0],"-------- ", $row[1],"-------- ", $row[2], $row[3]);

    };
  
  }
?>