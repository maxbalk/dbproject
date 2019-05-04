<?php
require_once(ROOT.'/views/homepage.php');
require_once(ROOT.'/controllers/HomeController.php');
require_once(ROOT.'/models/Forest.php');
require_once(ROOT.'/models/cell.php');

//initializes controller and builds dependencies for the homepage view.
//its possible a lot will be happening here
//one controller per view but possibly several entities
class HomeRouter {

    public function __construct(){
        $view = new Homepage();
        $this->controller = new HomeController($view);
    }

    //route to views not functions.
    //views' forms should call the same route again 
    public function processRequest($action){
        if($action==''){
            if(isset($_POST['newForestName'])){
                $this->controller->newForest();
            }
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
