<?php
use Species\SpeciesAdapter;

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

    public function seedSpecies(){
        $adapter = new SpeciesAdapter();
        $species = new Species($adapter);
        $species->seedSpecies();
    }


}
