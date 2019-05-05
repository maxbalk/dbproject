<?php

class ForestPage extends View{

    public function displayForestInfo($forestInfo){
        ?>
        <form action="/"method="post">
            <button type="submit">Return to homepage</button>
        </form>

            <form id="updateForm" action="?route=forest&do=update" method="post">
                <input type="text" name="newForestName" value=<?= $forestInfo['Official_name'];?>>
                <input type="text" name="newForestLocation" value=<?= $forestInfo['Forest_location'];?>>
                <input type="text" name="newNlat" value="<?= $forestInfo['Lat_north'];?>" readonly="true">
                <input type="text" name="newSlat" value="<?= $forestInfo['Lat_south'];?>" readonly="true">
                <input type="text" name="newElong" value="<?= $forestInfo['Long_east'];?>" readonly="true">
                <input type="text" name="newWlong" value="<?= $forestInfo['Long_west'];?>" readonly="true">
                <input type="hidden" name="oldName" value="<?= $forestInfo['Official_name']?>">
                <input type="hidden" name="oldLoc" value="<?= $forestInfo['Forest_location']?>">
            </form>
            <form id="deleteForm" action="?route=forest&do=delete" method="post">
                <input type="hidden" name="toDelete" value="<?= $forestInfo['Official_name']?>">
            </form>
        </div>
        <br>
        <div style="display: inline">
            <button form="updateForm" type="submit">Update Forest Information</button>
            <button form="deleteForm" type="submit">Delete this forest</button>
        </div>
        <?php
        $this->pagetitle = $forestInfo['Official_name']." Information";
        //$this->getContent();
    }

    public function displayTreeInfo($treeInfo){
      ?><table>
      <tr>
          <th scope="col">Species Name</th>
          <th scope="col">Total Number</th>
      </tr><?php
      for($i=0; $i<count($treeInfo); $i++){
        ?><tr>
          <td><?= $treeInfo[$i]['Species_name']; ?></td>
          <td><?= $treeInfo[$i]['SUM(numTrees)']; ?></td>
        </tr><?php
      }
      //$this->getContent();
    }
}
