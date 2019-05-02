<?
require_once(ROOT.'/Adapter.php');

class ForestAdapter extends Adapter{
    public function __construct(){
        echo "created adapter <br>";
    }


}

class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        echo "created model <br>";
    }
}