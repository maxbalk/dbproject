<?
abstract class Adapter{

    public $conn;

    function __construct(){
        $this->conn = $this->connect();
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

}
