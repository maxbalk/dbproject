<?php
class HomeController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayForests(){
        $this->view->getContent();
    }

    public function newForest(){
        //get POST data from input form and pass to new forest 
        $adapter = new ForestAdapter();
        $forest = new Forest($adapter);
        //north south east west
        //my meaningless example data :)
        $forest->insertForest("Canada", 90, 50, 50, 90);
    }

    public function seedTrees(){
        $adapter = new CellAdapter();
        $cell = new Cell($adapter);
        $cell->cellConatains('Canada');
    }

    public function forestArea(){

    }

}
