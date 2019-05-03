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

    public function QGetForestInfo($forestName){
        $stmt = $this->conn->prepare(
            "SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west 
             FROM Forest
             WHERE Official_name = ?"
        );
        $stmt->execute([$forestName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}



class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function insertForest($name, $n, $s, $e, $w){
        if($this->adapter->QinsertForest($name, $n, $s, $e, $w)){
            echo "inserted new forest";
            $this->generateCells($name);
        } else {
            echo "could not insert new forest";
        }
        /*if we're generating the cells only once each time we
          make a new forest we can just pass these function params
          to generateCells but for right now this is chill */
    }

    private function generateCells($name){
        $row = $this->adapter->QGetForestInfo($name);

        $name = $row['Official_name'];
        $nlat = $row['Lat_north'];
        $slat = $row['Lat_south'];
        $elong = $row['Long_east'];
        $wlong = $row['Long_west'];
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
