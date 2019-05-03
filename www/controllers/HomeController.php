<?php
class HomeController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayForests(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $list = $forest->getAllForests();
        $this->view->displayForests($list);
    }

    public function newForest(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        //get POST data from input form and pass to new forest 
        //north south east west
        //my meaningless example data :)
        $forest->insertForest("Canada", 90, 50, 50, 90);
    }

    public function seedTrees(){
        $cellAdapter = new CellAdapter();
        $cell = new Cell($cellAdapter);
        $cell->cellConatains('Canada');
    }

    public function forestArea(){

    }

}
