<?php
class ClimateAdapter extends Adapter{

    public function QseedClimates(){
        $stmt = $this->conn->prepare(
            "INSERT INTO Climate (Climate_name, Avg_rainfall) 
             VALUES (?, ?);"
        );
        $climateName = ["Dry","Temperate","Tropical","Continental"];
        $climateRain =["14","6","100","24"];
        for($i=0; $i<sizeof($climateName); $i++){
            $stmt->execute([$climateName[$i], $climateRain[$i]]);
        }  
    }

    public function QgetClimate(){
        $stmt = $this->conn->prepare("select * from Climate");
        $stmt->execute();
        $climates = array();
        while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($climates, $results);
        }
        return $climates;
    }

}

class Climate {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function seedClimates(){
        $this->adapter->QseedClimates();
    } 

    public function getClimates(){
        return $this->adapter->QgetClimate();
    }
}

class Climates1 {
    public $name;
    public $rainfall;
}
