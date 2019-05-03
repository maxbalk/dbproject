<?php
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
        $stmt = $this->conn->prepare("select * from Climate");
        $stmt->execute();
        $climates = array();
        while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($climates, $results);
        }
        foreach($climates as $climate){
            print_r($climate);
        }
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
