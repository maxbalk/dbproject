<?php
class ForestController extends Controller{

    public function inspectForest(){
        $forestName = $_POST['inspectName'];
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $forestInfo = $forest->getForestInfo($forestName);
        $this->view->displayForestInfo($forestInfo);
    }


    public function updateForest(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $forest->updateForest(  $_POST['newForestName'],
                                $_POST['newForestLocation'],
                                $_POST['oldName']
        );
        /*redirects to home because I dont want to mess
          with session variables right now */
        header("Location: /");
    }

    public function deleteForest(){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $forest->deleteForest($_POST['toDelete']);
        header("Location: /");
    }
    
}