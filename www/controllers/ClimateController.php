<?
require_once(ROOT.'/models/Species.php');
require_once(ROOT.'/models/Climate.php');
class ClimateController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayClimate(){
        $climate = new Climate();
        $this->view->getContent();
    }
    
    public function displaySpecies(){
        $species = new Species();
        $this->view->getContent();
    }


}
