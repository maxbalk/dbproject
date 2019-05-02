<?
class HomeController {

    private $view;
    public function __construct($view){
        $this->view = $view;
    }

    public function displayForests(){
        $this->view->getContent();
    }

}