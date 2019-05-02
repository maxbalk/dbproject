<?php
require_once(ROOT.'/views/climatepage.php');
require_once(ROOT.'/controllers/ClimateController.php');
require_once(ROOT.'/models/Climate.php');

//initializes controller and builds dependencies for the homepage view. 
//its possible a lot will be happening here 
//one controller per view but possibly several entities
class router{

    private $controller;
    //the feature's router will handle dependencies for the mvc components.
    public function __construct(){
        $view = new ClimatePage();
        $this->controller = new ClimateController($view);
    }

    public function processRequest($action){
        if($action==''){
            $this->controller->displayClimates();
        } 
    }
}