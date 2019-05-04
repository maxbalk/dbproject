<?php

class ForestPage extends View{

    public function displayForestInfo($forestInfo){
        ?>
        <?= $forestInfo['Forest_location']; ?>
        <!--html goes here--> 
        <?
        $this->pagetitle = $forestInfo['Official_name']."Information";
        $this->getContent();
    }

}