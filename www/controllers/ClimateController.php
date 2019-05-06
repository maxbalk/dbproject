<?php
class ClimateController extends Controller{

    public function displayClimates(){
        $adapter = new ClimateAdapter();
        $climate = new Climate($adapter);
        $specadapter = new SpeciesAdapter();
        $species = new Species($specadapter);
        $this->view->displayClimates($climate->getClimates(), $species->getSpecies());
    }

    public function seedSpecies(){
        $adapter = new SpeciesAdapter();
        $species = new Species($adapter);
        $species->seedSpecies();
    }

    public function seedClimate(){
        $adapter = new ClimateAdapter();
        $climate = new Climate($adapter);
        $climate->seedClimates();
    }
}
