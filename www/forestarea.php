<?php

$config = parse_ini_file("dbconfig.ini");
$host = $config['servername'];
$db = $config['dbname'];
$user = $config['username'];
$pass = $config['password'];
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

try{
    $sql = "SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west FROM forest";
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Official Name</th>";
                echo "<th>Area</th>";
            echo "</tr>";
        while($row = $result->fetch()){
            $name = $row['Official_name'];
            $nlat = $row['Lat_north'];
            $slat = $row['Lat_south'];
            $elong = $row['Long_east'];
            $wlong = $row['Long_west'];

            $area = (abs($nlat - $slat)/180)*(abs($wlong - $elong)/360)*4*M_PI*pow(3959, 2);

            echo "<tr>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $area . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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
