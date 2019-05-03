<?php

class CellAdapter extends Adapter{

    public function QinsertCells($name, $xval, $yval){
      $stmt = $this->conn->prepare("INSERT INTO cell (Forest_name, X_coordinate, Y_coordinate) VALUES (?, ?, ?, ?)");
      $stmt->execute([$name, $xval, $yval]);
    }


    public function QcellContains($id){
      $species = array('Oak', 'Pine', 'Maple');
      $stmt = $this->conn->prepare("INSERT INTO Contains_species (Species_name, cell_id, numTrees) VALUES (?, ?, ?)");
      $m = count($id);
      $n = count($species);
      for ($i = 0; $i < m; $i++){
        for ($j = 0; $j < n; $j++){
          $count = mt_rand(1, 100);
          $stmt->execute([$species[i], $id[j], $count]);
        }
      }
    }

    public function QgetIDs(){
      $stmt = $this->conn->prepare("SELECT id FROM Cell WHERE Forest_name = 'Canada'");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;

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

  public function cellConatains(){
    $id = $this->adapter->QgetIDs();
    $this->adapter->QcellContains($id);
  }
}
?>
