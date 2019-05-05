<?php

class ForestPage extends View{

    public function displayForestInfo($forestInfo){ 
        ?>
        <form action="/"method="post">
            <button type="submit">Return to homepage</button>
        </form>
        <form action="?route=forest&do=update" method="post"><br>
            <input type="text" name="newForestName" value=<?= $forestInfo['Official_name'];?>>
            <input type="text" name="newForestLocation" value=<?= $forestInfo['Forest_location'];?>>
            <input type="text" name="newNlat" value="<?= $forestInfo['Lat_north'];?>" readonly="true">
            <input type="text" name="newSlat" value="<?= $forestInfo['Lat_south'];?>" readonly="true">
            <input type="text" name="newElong" value="<?= $forestInfo['Long_east'];?>" readonly="true">
            <input type="text" name="newWlong" value="<?= $forestInfo['Long_west'];?>" readonly="true">
            <input type="hidden" name="oldName" value="<?= $forestInfo['Official_name']?>">
            <input type="hidden" name="oldLoc" value="<?= $forestInfo['Forest_location']?>">
            <br><button type="submit">Update Forest Information</button>
        </form><br>
        <?
        $this->pagetitle = $forestInfo['Official_name']." Information";
        $this->getContent();
    }

}