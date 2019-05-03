<?php
require_once('cell.php');

class ForestAdapter extends Adapter{

    public function QinsertForest($name, $n, $s, $e, $w){
        $stmt = $this->conn->prepare("
            INSERT INTO Forest (Official_name, Lat_north, Lat_south, Long_east, Long_west)
            VALUES (?, ?, ?, ?, ?)"
        );
        try {
            $stmt->execute([$name, $n, $s, $e, $w]);
        } catch (PDOException $e){
            echo "error: ", $e->getMessage();
        }
    }

    public function QGetForestInfo($forestName){
        /*Official_name is the primary key so there will only be one result anyway
        but I'm array_push ing to stay consistent with the other adapter methods */
        $stmt = $this->conn->prepare(
            "SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west 
             FROM Forest
             WHERE Official_name = ?"
        );
        $stmt->execute([$forestName]);
        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }
}



class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function insertForest($name, $n, $s, $e, $w){
        $this->adapter->QinsertForest($name, $n, $s, $e, $w);
        /*if we're generating the cells only once each time we
          make a new forest we can just pass these function params
          to generateCells but for right now this is chill */
        $this->generateCells($name);
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
