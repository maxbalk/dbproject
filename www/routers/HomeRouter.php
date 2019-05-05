<?php
require_once(ROOT.'/views/homepage.php');
require_once(ROOT.'/controllers/HomeController.php');
require_once(ROOT.'/models/Forest.php');
require_once(ROOT.'/models/cell.php');

class HomeRouter {

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
        else {
            Echo "<h2>Page not found</h2>";
        }
    }
}
