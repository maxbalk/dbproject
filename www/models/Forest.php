<?php
require_once(ROOT.'/Adapter.php');
require_once('cell.php');

class ForestAdapter extends Adapter{

    public function QinsertForest($name){
        $stmt = $this->conn->prepare("
            INSERT INTO Forest (Forest_name)
            VALUES (?)
        ");

    }

    public function QgenerateCells(){
      $stmt = $this->conn->prepare("SELECT Official_name, Lat_north, Lat_south, Long_east, Long_west FROM forest");
      while($row = $result->fetch()){
          $xrange = (int)(($wlong - $elong)/5);
          $yrange = (int)(($nlat - $slat)/5);
          $id = 1;
        }
        return $row;
    }
}

class Forest {
    //this class handles CRUD operations for Forest and collateral entities.
    private $adapter;

    public function __construct($adapter){
        $this->$adapter = $adapter;
    }

    public function insertForest($name){
        $this->adapter->QinsertForest($name);
    }

    private function generateCells(){

        $result = $pdo->query($sql);
        $row = $this->adapter->QgenerateCells();

        $name = $row['Official_name'];
        $nlat = $row['Lat_north'];
        $slat = $row['Lat_south'];
        $elong = $row['Long_east'];
        $wlong = $row['Long_west'];

        $xrange = (int)(($wlong - $elong)/5);
        $yrange = (int)(($nlat - $slat)/5);
        $id = 1;

        $cell = new Cell($adapter);

        for ($x = 0; $x < $xrange; $x += 1){
           for ($y = 0; $y < $yrange; $y += 1){
               $cell->newCell($id, $name, $x, $y);
               $id++;
           }
        }

        echo "Forests have been divided into coordinates";
            // Free result set
        unset($result);
    }
}
