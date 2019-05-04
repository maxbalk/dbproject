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
             LIMIT 1"
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

    private function generateCells($name){
        $parent = $this->adapter->QGetForestInfo($name);

        $name = $parent['Official_name'];
        $nlat = $parent['Lat_north'];
        $slat = $parent['Lat_south'];
        $elong = $parent['Long_east'];
        $wlong = $parent['Long_west'];
        $xrange = (int)(($wlong - $elong)/5);
        $yrange = (int)(($nlat - $slat)/5);

        $adapter = new CellAdapter();
        $cell = new Cell($adapter);

        /*this calls a ton of INSERT queries on the database, 
          might be cool to eventually refactor into string concatentation 
          or at least make a data structure of cells */
        for ($x = 0; $x < $xrange; $x += 1){
           for ($y = 0; $y < $yrange; $y += 1){
               $cell->newCell($name, $x, $y);
           }
        }

        echo "Forests have been divided into coordinates<br>";
        // Free result set
        unset($result);
    }

    public function calculateArea(){

        unset($result);
    }

}
