<?
class SpeciesAdapter extends Adapter{

    public function QseedSpecies(){
        $stmt = $this->conn->prepare("INSERT INTO Tree_species (Scientific_name, lifespan, Dispersal_distance, Fire_tolerance, DBH) VALUES (?, ?, ?, ?, ?);");
        $speciesName = ["Red Maple","White Oak","Pine","Black Willow","Quaking Aspen","Red Wood"];
        $lifeSpan =["90","300","150","65","55","600"];
        $Disperal = ["100.00","150.00","200.00","120.00","100.00","300.00"];
        $Fire = ["6.00","9.00","3.00","7.00","3.50","5.00"];
        $DBH = ["2.00","4.00","2.00","3.00","2,00","5.00"];
        for($i=0; $i<sizeof($speciesName); $i++){
            $stmt->execute([$speciesName[$i], $lifeSpan[$i], $Disperal[$i],$Fire[$i],$DBH[$i]]);  
        }
    }

    public function  QgetSpecies(){
        $stmt = $this->conn->prepare("select * from Tree_species");
        $stmt->execute();
        $species = array();
        while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($species, $results);
        }
        foreach($species as $tree){
            print_r($tree);
        }
    }
}

class Species {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function seedSpecies(){
        $this->adapter->QseedSpecies();
    }

    public function getSpecies(){
        $this->adapter->QgetSpecies();
    }
    
}
