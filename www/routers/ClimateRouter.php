<?php
require_once(ROOT.'/views/climatepage.php');
require_once(ROOT.'/controllers/ClimateController.php');
require_once(ROOT.'/models/Climate.php');
require_once(ROOT.'/models/Species.php');

//initializes controller and builds dependencies for the homepage view. 
//its possible a lot will be happening here 
//one controller per view but possibly several entities
class router{

    private $controller;
    public function __construct(){
        $view = new ClimatePage();
        $this->controller = new ClimateController($view);
    }

    public function processRequest($action){
        if($action==''){
            $this->controller->displayClimates();
        }
        elseif($action=='seed-species'){
            $this->controller->seedSpecies();
        }

    }
}