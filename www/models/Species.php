<?
require_once(ROOT.'/Adapter.php');

class ClimateAdapter extends Adapter{
    public function __construct(){
        echo "created adapter <br>";
    }
    Qintialspecies(){
        $stmt = $pdo->prepare("INSERT INTO Tree_species (Scientific_name, lifespan, Dispersal_distance, Fire_tolerance, DBH) VALUES (?, ?, ?, ?, ?);");
        $speciesName = ["Red Maple","White Oak","Pine","Black Willow","Quaking Aspen","Red Wood"]
        $lifeSpan =["90","300","150","65","55","600"]
        $Disperal = ["100.00","150.00","200.00","120.00","100.00","300.00"]
        $Fire = ["6.00","10.00","3.00","7.00","3.50","5.00"]
        $DBH = ["2.00","4.00","2.00","3.00","2,00","5.00"]
            for($i=0; $i<sizeof($speciesName) $i++){
                $stmt->execute([$speciesName[i], $climateRain[i]]);  
            }
       
    }


}

class Climate {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        echo "created model <br>";
    }
    public function initalclimate($adapter){
        $this->adapter->Qinitalspecies();
    }
}
