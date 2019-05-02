<?php

class CellAdapter extends Adapter{

    public function __construct(){
      echo "created adapter <br>";
    }

    public function QinsertCells($id, $name, $xval, $yval){
      $stmt = $this->conn->prepare("INSERT INTO cell (id, Forest_name, X_coordinate, Y_coordinate) VALUES (?, ?, ?, ?)");
      $stmt->execute([$id, $name, $xval, $yval]);
    }



  }


class Cell{

  private $adapter;

  public function __construct($adapter){
    $this->adapter = $adapter;
  }

  

  public function newCell($id, $name, $xval, $yval){
    $this->adapter->QinsertCells($id, $name, $xval, $yval);

  }
}
?>
