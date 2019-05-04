<?php
require_once(ROOT.'/views/forestpage.php');
require_once(ROOT.'/controllers/ForestController.php');
require_once(ROOT.'/models/Forest.php');
require_once(ROOT.'/models/cell.php');

//initializes controller and builds dependencies for the homepage view.
//its possible a lot will be happening here
//one controller per view but possibly several entities
class ForestRouter {

    public function __construct(){
        $view = new ForestPage();
        $this->controller = new ForestController($view);
    }

    public function processRequest($action){
        if($action == 'inspect'){
            $this->controller->inspectForest();
        }
    }
}