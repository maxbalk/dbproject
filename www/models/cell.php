<?php

class CellAdapter extends Adapter{

    public function QinsertCells($id, $name, $xval, $yval){
        $stmt = $this->conn->prepare(
            "INSERT INTO cell (id, Forest_name, X_coordinate, Y_coordinate)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$id, $name, $xval, $yval]);
    }


    public function QcellContains($id){
        //these species names HAVE to match the entries in the species table
        //cause this is all hand coded data generation
        $species = array("Red Maple","White Oak","Pine","Black Willow","Quaking Aspen","Red Wood");

        $stmt = $this->conn->prepare(
            "INSERT INTO contains_species (Species_name, cell_id, numTrees)
             VALUES (?, ?, ?)"
        );
        for ($j = 0; $j < count($species); $j++){
            $count = mt_rand(0, 100);
            $stmt->execute([$species[$j], $id, $count]);
        }
    }
}

class Cell{

    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function newCell($id, $name, $xval, $yval){
        $this->adapter->QinsertCells($id, $name, $xval, $yval);
        $this->adapter->QcellContains($id);
    }
}
?>
