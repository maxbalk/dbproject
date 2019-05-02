<?php
class ClimateController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayClimates(){
        $adapter = new ClimateAdapter();
        $climate = new Climate($adapter);
        $climate->getClimates();
        //$this->view->getContent();
    }
    
    public function displaySpecies(){
        $this->view->getContent();
    }


}
