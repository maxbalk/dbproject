<?php
abstract class Adapter{

    protected $conn;

    function __construct(){
        $this->conn = $this->connect();
        echo "adapter constructor";
    }

    private function connect(){
        $config = parse_ini_file(ROOT.'/config/dbconfig.ini');
        $host = $config['servername'];
        $db = $config['dbname'];
        $user = $config['username'];
        $pass = $config['password'];
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        return $pdo;
    }

    public function crud($stmt){
        if($stmt->execute() == TRUE) {
            return 1;
        }
        return 0;
    }
}

    