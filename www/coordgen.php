<?php

$config = parse_ini_file("dbconfig.ini");
$host = $config['servername'];
$db = $config['dbname'];
$user = $config['username'];
$pass = $config['password'];
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

try{
    $stmt = $pdo->prepare("INSERT INTO cell (id, Forest_name, X_coordinate, Y_coordinate) VALUES (?, ?, ?, ?)");
    $sql = "SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west FROM forest";
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
        while($row = $result->fetch()){
            $name = $row['Official_name'];
            $nlat = $row['Lat_north'];
            $slat = $row['Lat_south'];
            $elong = $row['Long_east'];
            $wlong = $row['Long_west'];

            $xrange = (int)$wlong - $elong;
            $yrange = (int)$nlat - $slat;
            $id = 1;

            for ($x = 0; $x < $xrange; $x += 5){
              for ($y = 0; $y < $yrange; $y += 5){
                $stmt->execute([$id, $name, $x, $y]);
                $id++;
              }
            }
          }

          echo "Forests have been divided into coordinates";
          // Free result set
          unset($result);
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Not able to execute $sql. " . $e->getMessage());
}

unset($pdo);
?>
