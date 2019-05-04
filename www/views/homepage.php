<link rel="stylesheet" type="text/css" href="/views/style.css">
<?php ob_start();

class Homepage{

    public function displayForests($forests){
        ?>
        <form id="forestForm" action="?do=new-forest" method="post"><br>
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
            <th scope="col">northern border</th>
            </tr>
        <?
        foreach($forests as $forest){
            ?><tr>
                <td><?= $forest['Official_name']; ?>
                <td><?= $forest['Lat_north']; ?>
                <td><button>Inspect</button>
            </tr><?
        }
        ?></table><?
        $this->getContent();
    }

    private function getContent(){ 
        $content = ob_get_clean();
        ?>
        <div style="text-align:center">
        <div style="display: inline-block">
            <h2>homepage view</h2><br>  
            <?= $content; ?>
        <div>
        </div>
        <?
    }
}
