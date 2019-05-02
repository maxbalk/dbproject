<?
namespace homepage;
require 'model.php';

class router{
    private $model;

    //the feature's router will handle dependencies for the mvc components.
    public function __construct(){
        $this->model = new Forests();
    }

    public function processRequest($action){

    }
}