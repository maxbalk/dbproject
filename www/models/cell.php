<?php

class CellAdapter extends Adapter{

    public function QinsertCells($name, $xval, $yval){
        $stmt = $this->conn->prepare(
            "INSERT INTO cell (Forest_name, X_coordinate, Y_coordinate)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $xval, $yval]);
    }


    public function QcellContains($name, $x, $y){
        //these species names HAVE to match the entries in the species table
        //cause this is all hand coded data generation
        $species = array("Red Maple","White Oak","Pine","Black Willow","Quaking Aspen","Red Wood");

        $stmt = $this->conn->prepare(
            "INSERT INTO contains_species (Species_name, numTrees, cell_id)
             VALUES (?, ?, (SELECT id FROM cell
             WHERE Forest_name=? AND X_coordinate=? AND Y_coordinate=?))"
           );
        for ($i=0; $i<count($species); $i++){
            $count = mt_rand(0, 100);
            $stmt->execute([$species[$i], $count, $name, $x, $y]);
        }
    }
}

    /*public function QgetIDs($forestNames){
        $stmt = $this->conn->prepare("SELECT id FROM Cell WHERE Forest_name = ?");
        for ($i =0; $i < count($forestNames); $i++){}
            $stmt->execute([$forestNames[i]);
        $cells = array();
        while($result = $stmt->fetch(PDO::FETCH_COLUMN)){
            array_push($cells, $result);
        }
        return $cells;
    }*/

class Cell{

    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function newCell($name, $xval, $yval){
        $this->adapter->QinsertCells($name, $xval, $yval);
    }

    public function cellContains($name, $xval, $yval){
        $this->adapter->QcellContains($name, $xval, $yval);
    }
}
?>