<?php
abstract class Adapter{

    protected $conn;

    function __construct(){
        $this->conn = $this->connect();
    }

    private function connect(){
        $config = parse_ini_file(ROOT.'/config/dbconfig.ini');
        $host = $config['servername'];
        $db = $config['dbname'];
        $user = $config['username'];
        $pass = $config['password'];
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=$db", $user, $pass);
        return $pdo;
    }

}
