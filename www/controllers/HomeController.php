<?php
class HomeController extends Controller {

    public function displayForests(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $list = $forest->getAllForests();
        $this->view->displayForests($list);
    }

    public function newForest(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        //dont ever do form input like this
        //validate and sanitize first
        //but we have to finish project
        $forest->insertForest(  $_POST['newForestName'],
                                $_POST['newForestLocation'],
                                $_POST['nlat'],
                                $_POST['slat'],
                                $_POST['elong'],
                                $_POST['wlong']
        );
    }

    /*public function seedTrees(){
        $cellAdapter = new CellAdapter();
        $cell = new Cell($cellAdapter);
        $cell->cellConatains('Canada');
    }*/

    public function forestArea(){

    }

}
