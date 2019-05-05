<?php
class ForestController extends Controller{

    public function inspectForest($forestName){
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $forestInfo = $forest->getForestInfo($forestName);
        $treeInfo = $forest->countTrees($forestInfo['Official_name']);
        $this->view->displayForestInfo($forestInfo, $treeInfo);
        if(isset($_SESSION['resultantCells'])){
            $this->view->speciesSearchResult($_SESSION['resultantCells'], $_SESSION['speciesName']);
        }
    }

    public function searchSpecies($speciesName, $forestName){
        session_start();
        $cellAdapter = new CellAdapter();
        $cell = new Cell($cellAdapter);
        $_SESSION['resultantCells'] = $cell->speciesSearch($speciesName, $forestName);
        $_SESSION['speciesName'] = $speciesName;
        $this->inspectForest($forestName);
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
