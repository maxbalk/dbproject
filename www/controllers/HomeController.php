<?php
class HomeController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayForests(){
        $this->view->getContent();
    }

    public function newForest($forests){

    }

    public function forestArea(){
        $adapter = new ForestAdapter();
        $forest = new Forest($adapter);
        $forest->generateCells();
    }

}
