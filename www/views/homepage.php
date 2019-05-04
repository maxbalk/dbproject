<?php ob_start();

class Homepage extends Layout{

    public function displayForests($forests){
        ?>
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
                <td><?= $forest['Official_name']; ?>
                <td><?= $forest['Forest_location']; ?>
                <td><button>Inspect</button>
            </tr><?
        }
        ?></table><?
        $this->pagetitle = "Forest Management System";
        $this->getContent();
    }

}
