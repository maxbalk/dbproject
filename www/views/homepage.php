<?php

class Homepage extends Layout{

    public function displayForests($forests){
        ob_start(); ?>
        <form action="?route=climates" method="post">
            <button type="submit">View Climates and Species</button>
        </form>
        <form id="forestForm" action="" method="post"><br>
            <input type="text" name="newForestName" placeholder="Forest Name">
            <input type="text" name="newForestLocation" placeholder="Country">
            <input type="text" name="nlat" placeholder="N Border Long">
            <input type="text" name="slat" placeholder="S Border Long">
            <input type="text" name="elong" placeholder="E Border Lat">
            <input type="text" name="wlong" placeholder="W Border Lat">
            <button type="submit">Create New Forest</button>
        </form><br>
        <table>
            <tr>
            <th scope="col">Forest Name</th>
            <th scope="col">Location</th>
            </tr>
        <?
        foreach($forests as $forest){
            ?><tr>
                <td><?= $forest['Official_name']; ?></td>
                <td><?= $forest['Forest_location']; ?></td>
                <td><form action="?do=inspect-forest" method="post" style="display: inline">
                        <input type="hidden" name="forest" value="<?= $forest['Official_name']?>"> 
                        <button type="submit">Inspect</button>
                    </form>
                </td>
            </tr><?
        }
        ?></table><?
        $this->pagetitle = "Forest Management System";
        $this->getContent();
    }

}
