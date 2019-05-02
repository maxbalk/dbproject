<?
namespace homepage;

require_once(ROOT.'/controllers/HomeController.php');
require_once(ROOT.'/models/Forest.php');
require_once(ROOT.'adapter.php');

//initializes controller and builds dependencies for the homepage view.
//its possible a lot will be happening here
//one controller per view but possibly several entities
class router{

    private $homeController;
    //the feature's router will handle dependencies for the mvc components.
    public function __construct(){

    }

    public function processRequest($action){

    }
}
