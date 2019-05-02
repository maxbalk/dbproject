<?
require_once(ROOT.'/Adapter.php');

class ForestAdapter extends Adapter{
    public function __construct(){
        echo "created adapter <br>";
    }

    public function QinsertForest($name){
        $stmt = $this0->conn->prepare("
            INSERT INTO Forest (Forest_name)
            VALUES (?)
        ");

    }


}

class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        echo "created model <br>";
    }

    public function insertForest($name){
        $this->adapter->QinsertForest($name);
    }
}