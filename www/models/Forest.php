<?php
require_once('cell.php');

class ForestAdapter extends Adapter{

    public function QinsertForest($name, $n, $s, $e, $w){
        $stmt = $this->conn->prepare(
            "INSERT INTO Forest (Official_name, Lat_north, Lat_south, Long_east, Long_west)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$name, $n, $s, $e, $w]);
    }

    public function QinsertForestLocation($name, $loc){
        $stmt = $this->conn->prepare(
            "INSERT INTO Forest_location (Forest_name, Forest_location)
             VALUES (?, ?)"
        );
        return $stmt->execute([$name, $loc]);
    }

    public function QgetForestInfo($forestName){
        $stmt = $this->conn->prepare(
            "SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west, Forest_location
             FROM Forest, Forest_location
             WHERE Forest.Official_name = ?
             AND Forest_location.Forest_name = Forest.Official_name"
        );
        $stmt->execute([$forestName]);
        $parent = $stmt->fetch(PDO::FETCH_ASSOC);
        return $parent;
    }

    public function QgetAllForests(){
        $stmt = $this->conn->prepare(
            "SELECT  Official_name, Lat_north, Lat_south, Long_east, Long_west, Forest_location
             FROM Forest, Forest_location
             WHERE Forest.Official_name = Forest_location.Forest_name"
        );
        $stmt->execute();
        $forests = array();
        while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($forests, $results);
        }
        return $forests;
    }

    public function QcountTrees($forestName){
        $stmt = $this->conn->prepare(
          "SELECT Species_name, SUM(numTrees) FROM Cell C, Contains_species S
          WHERE C.id = S.cell_id AND C.Forest_name = ? GROUP BY Species_name"
        );
        $stmt->execute([$forestName]);
        $trees = array();
        while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($trees, $results);
        }
        return $trees;
    }
    
    public function QdeleteForest($name){
        $stmt = $this->conn->prepare(
            "DELETE FROM Forest
             WHERE Official_name =?"
        );
        return $stmt->execute([$name]);
    }

    public function QupdateForest($name, $oldName){
        $stmt = $this->conn->prepare(
           "UPDATE Forest
            SET Official_name  = ?
            WHERE Official_name = ?" 
        );
        return $stmt->execute([$name, $oldName]);
    }

    public function QupdateForestLocation($name, $loc){
        $stmt = $this->conn->prepare(
            "UPDATE Forest_location
             SET Forest_location  = ?
             WHERE Forest_name = ?" 
         );
         return $stmt->execute([$loc, $name]);
    }

}



class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function getForestInfo($forestName){
        return $this->adapter->QgetForestInfo($forestName);
    }

    public function getAllForests(){
        return $this->adapter->QgetAllForests();
    }

    public function updateForest($name, $loc, $oldName){
        if($this->adapter->QupdateForest($name, $oldName)){
            $this->updateForestLocation($name, $loc);
        } else {
            echo "could not update forest ".$oldName;
        }
    }

    public function deleteForest($name){
        if($this->adapter->QdeleteForest($name)){
            return;
        } else {
            echo "could not delete forest ". $name;
        }
    }

    public function insertForest($name, $loc, $n, $s, $e, $w){
        if($this->adapter->QinsertForest($name, $n, $s, $e, $w)){
            $this->insertForestLocation($name, $loc);
            $this->generateCells($name);
        } else {
            echo "could not insert new forest";
        }
        /*if we're generating the cells only once each time we
          make a new forest we can just pass these function params
          to generateCells but for right now this is chill */
    }

    private function insertForestLocation($name, $loc){
        if($this->adapter->QinsertForestLocation($name, $loc)){
            return;
        } else {
            echo "could not insert forest location";
        }
    }

    private function updateForestLocation($name, $loc){
        if($this->adapter->QupdateForestLocation($name, $loc)){
            return;
        } else {
            echo "could not update forest location";
        }
    }

    private function generateCells($name){
        $parent = $this->adapter->QGetForestInfo($name);

        $name = $parent['Official_name'];
        $nlat = $parent['Lat_north'];
        $slat = $parent['Lat_south'];
        $elong = $parent['Long_east'];
        $wlong = $parent['Long_west'];
        $xrange = (int)(abs($wlong - $elong)/5);
        $yrange = (int)(abs($nlat - $slat)/5);

        $adapter = new CellAdapter();
        $cell = new Cell($adapter);

        /*this calls a ton of INSERT queries on the database,
          might be cool to eventually refactor into string concatentation
          or at least make a data structure of cells */
        for ($x = 0; $x < $xrange; $x += 1){
           for ($y = 0; $y < $yrange; $y += 1){
               $cell->newCell($name, $x, $y);
               $cell->cellContains($name, $x, $y);
           }
        }
    }

    public function countTrees($forestName){
      return $this->adapter->QcountTrees($forestName);
    }

}
