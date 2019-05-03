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
        $forest->insertForest("Canada", 100, 50, 50, 100);
    }

    public function forestArea(){

    }

}
