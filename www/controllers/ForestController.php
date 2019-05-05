<?php
class ForestController extends Controller{

    public function inspectForest(){
        $forestName = $_POST['inspectName'];
        $forestAdapter = new ForestAdapter();
        $forest = new Forest($forestAdapter);
        $forestInfo = $forest->getForestInfo($forestName);
        $this->view->displayForestInfo($forestInfo);
        $treeInfo = $forest->countTrees($forestInfo['Official_name']);
        $this->view->displayTreeInfo($treeInfo);
    }

}
