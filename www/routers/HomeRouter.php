<?php
require_once(ROOT.'/views/Homepage.php');
require_once(ROOT.'/controllers/HomeController.php');
require_once(ROOT.'/models/Forest.php');
require_once(ROOT.'/models/cell.php');

//initializes controller and builds dependencies for the homepage view.
//its possible a lot will be happening here
//one controller per view but possibly several entities
class router {

    private $controller;
    public function __construct(){
        $view = new Homepage();
        $this->controller = new HomeController($view);
    }

    public function processRequest($action){
        if($action==''){
            $this->controller->displayForests();
        }
        elseif($action=='new-forest'){
            $this->controller->newForest();
        }
        elseif($action == 'cell'){
            $this->controller->forestArea();
        }
        elseif($action == 'seed-trees'){
            $this->controller->seedTrees();
        }
    }
}
