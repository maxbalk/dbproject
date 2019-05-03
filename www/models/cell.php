<?php

class CellAdapter extends Adapter{

    public function QinsertCells($name, $xval, $yval){
        $stmt = $this->conn->prepare(
            "INSERT INTO Cell (Forest_name, X_coordinate, Y_coordinate) 
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $xval, $yval]);
    }


    public function QcellContains($cells){
        //these species names HAVE to match the entries in the species table
        //cause this is all hand coded data generation 
        $species = array('White Oak', 'Pine', 'Red Maple');
        
        $stmt = $this->conn->prepare(
            "INSERT INTO Contains_species (Species_name, cell_id, numTrees) 
             VALUES (?, ?, ?)"
        );
        for ($i = 0; $i < count($cells); $i++){
            for ($j = 0; $j < count($species); $j++){
                $count = mt_rand(1, 100);
                $stmt->execute([$species[$i], $cells[$j], $count]);
            }
        }
    }

    public function QgetIDs($forestName){
        $stmt = $this->conn->prepare("SELECT id FROM Cell WHERE Forest_name = ?");
        $stmt->execute([$forestName]);
        $cells = array();
        while($result = $stmt->fetch(PDO::FETCH_COLUMN)){
            array_push($cells, $result);
        }
        return $cells;
    }
}

class Cell{

    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function newCell($name, $xval, $yval){
        $this->adapter->QinsertCells($name, $xval, $yval);
    }

    //populates a forest's cells with rando trees
    public function cellConatains($forestName){
        $cellIDs = $this->adapter->QgetIDs($forestName);
        //$this->adapter->QcellContains($cellIDs);
    }
}
?>
