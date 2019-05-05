<?php

class ForestPage extends View{

    public function displayForestInfo($forestInfo){
        ?>
        <?= $forestInfo['Forest_location']; ?>
        <!--html goes here-->
        <?php
        $this->pagetitle = $forestInfo['Official_name']." Information";
        $this->getContent();
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
          <td><?= $treeInfo[$i]['sum(numTrees)']; ?></td>
        </tr><?php
      }
    }
}
