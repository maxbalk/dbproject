<?php
    $route = $_GET['route'] ?? '';
    if($route == 'test'){
        echo "test route";
    }
    else {
        echo "no route";
    }
    $config = parse_ini_file("dbconfig.ini");
    $host = $config['servername'];
    $db = $config['dbname'];
    $user = $config['username'];
    $pass = $config['password'];
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $cname = "testclimate";
    $rvalue = 44;
    $stmt = $pdo->prepare("insert into Climate Values (?,?)");
    $stmt->execute([$cname, $rvalue]);


    $stmt = $pdo->prepare("select * from Climate");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($result['Climate_name']);
?>
