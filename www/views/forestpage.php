<?php

class ForestPage extends View{

    public function displayForestInfo($forestInfo, $treeInfo){ 
        ?>
        <form action="/"method="post">
            <button type="submit">Return to homepage</button>
        </form>
        <div style="display: inline-block">
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
        <div style="display: inline-block">
            <button form="updateForm" type="submit">Update Forest Information</button>
            <button form="deleteForm" type="submit">Delete this forest</button>
        </div>
        <?php
        $this->pagetitle = $forestInfo['Official_name']." Information";

      ?>
      <br>
      <div style="display: table">
        <label>Enter Species name to search for cell with the greatest amount</label>
        <form id="speciesSearch" action="?route=forest&do=species-search" method="post">
            <input type="text" name="speciesSearch" placeholder="species name">
            <input type="hidden" name="fname" value="<?= $forestInfo['Official_name']?>">
            <input type="submit" value="search">
        </form>
        <form action="?route=climates" method="post">
            <input type="submit" value="display list of species">
        </form>
      </div>
      <table>
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

    public function speciesSearchResult($results){
        foreach($results as $result){
            ?>Cell(s) with greatest number of trees<?php
        }
    }
}
