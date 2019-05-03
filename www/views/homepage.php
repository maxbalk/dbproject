<?php ob_start();
class Homepage{

    private $content;

    public function __construct(){
        $content = ob_get_clean();
    }

    public function displayForests($forests){
        ?><table>
            <tr>
            <th scope="col">Forest Name</th>
            <th scope="col">northern border</th>
            </tr>
        <?
        foreach($forests as $forest){
            ?><tr>
                <td><?= $forest['Official_name']; ?>
                <td><?= $forest['Lat_north']; ?>
            </tr><?
        }
        ?></table><?
        $this->getContent();
    }

    private function getContent(){
        ?>
            <h2>homepage view</h2>

        <?php $content = ob_get_clean();
        echo $content;
    }
}

?>
