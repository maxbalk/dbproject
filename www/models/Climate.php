<?php
require_once(ROOT.'/Adapter.php');

class ClimateAdapter extends Adapter{

    public function Qintialclimate(){
        $stmt = $this->conn->prepare("INSERT INTO Climate (Climate_name, Avg_rainfall) VALUES (?, ?);");
        $climateName = ["Dry","Temperate","Tropical","Continental"];
        $climateRain =["14","6","100","24"];
            for($i=0; $i<sizeof($climateName); $i++){
                $stmt->execute([$climateName[i], $climateRain[i]]);  
            }
       
    }
    public function QgetClimate(){
        echo "qgclimate<br>";
        $stmt = $this->conn->prepare("select * from Climate");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($result);
    }

}

class Climate {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }
    public function initalclimate(){
        $this->adapter->Qinitalclimate();
    } 
    public function getClimates(){
        echo "getting climates<br>";
        $this->adapter->QgetClimate();
        /*
        $climates = $this->adapter->QgetClimates();
        foreach($climates as $climate){

        }
        */
    }
}

class Climates1 {
    public $name;
    public $rainfall;
}
