<?php
class HomeController extends Controller {

    public function displayForests(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $list = $forest->getAllForests();
        $this->view->displayForests($list);
    }

    public function newForest(){
        if(isset($_POST['ForestName'])){
            $forestAdapter = new ForestAdapter();
            $forest = new Forest($forestAdapter);
            //dont ever do form input like this
            //escape stuff
            //but we have to finish project
            $forest->insertForest(  $_POST['ForestName'],
                                    $_POST['ForestLocation'],
                                    $_POST['nlat'],
                                    $_POST['slat'],
                                    $_POST['elong'],
                                    $_POST['wlong']
            );
        }
        header("Location: /");
    }

}
