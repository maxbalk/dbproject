<?
require_once(ROOT.'/Adapter.php');

class ClimateAdapter extends Adapter{
    public function __construct(){
        echo "created adapter <br>";
    }
    public function Qintialclimate(){
        $stmt = $pdo->prepare("INSERT INTO Climate (Climate_name, Avg_rainfall) VALUES (?, ?);");
        $climateName = ["Dry","Temperate","Tropical","Continental"]
        $climateRain =["14","6","100","24"]
            for($i=0; $i<sizeof($climateName) $i++){
                $stmt->execute([$climateName[i], $climateRain[i]]);  
            }
       
    }
        public function QgetClimate(){
        $stmt = $pdo->prepare("select * from Climate");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($result['Climate_name']);
        }

}

class Climate {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        echo "created model <br>";
    }
    public function initalclimate($adapter){
        $this->adapter->Qinitalclimate();
    }
}
