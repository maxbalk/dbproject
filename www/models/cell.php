<?php

class CellAdapter extends Adapter{

    public function QinsertCells($name, $xval, $yval){
        $stmt = $this->conn->prepare(
            "INSERT INTO Cell (Forest_name, X_coordinate, Y_coordinate)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $xval, $yval]);
    }


    public function QcellContains($name, $x, $y){
        //these species names HAVE to match the entries in the species table
        //cause this is all hand coded data generation
        $species = array("Red Maple","White Oak","Pine","Black Willow","Quaking Aspen","Red Wood");

        $stmt = $this->conn->prepare(
            "INSERT INTO Contains_species (Species_name, numTrees, cell_id)
             VALUES (?, ?, (SELECT id FROM Cell
             WHERE Forest_name=? AND X_coordinate=? AND Y_coordinate=?))"
           );
        for ($i=0; $i<count($species); $i++){
            $count = mt_rand(0, 100);
            $stmt->execute([$species[$i], $count, $name, $x, $y]);
        }
    }

    public function QspeciesSearch($speciesName, $forestName){
      $stmt = $this->conn->prepare(
        "SELECT id, numTrees, X_coordinate, Y_coordinate
         FROM Contains_species, Cell
         WHERE id = cell_id AND Species_name = ? AND Forest_name = ? AND numTrees
         IN (SELECT MAX(numTrees) 
             FROM Contains_species, Cell
             WHERE Species_name = ? AND Forest_name = ? AND cell_id = id)"
      );
      $stmt->execute([$speciesName, $forestName, $speciesName, $forestName]);

      $numTrees = array();
      while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
          array_push($numTrees, $results);
        }
      return $numTrees;
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

    public function speciesSearch($speciesName, $forestName){
      return $this->adapter->QspeciesSearch($speciesName, $forestName);
    }
}
?>
