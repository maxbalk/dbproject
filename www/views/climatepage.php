<?php
class ClimatePage extends View{

    public function displayClimates($climates, $trees){
        ?>
        <form action="/"method="post">
            <button type="submit">Return to homepage</button>
        </form>
        <table>
            <tr>
                <th scope="col">Species name</th>
                <th scope="col">Lifespan</th>
                <th scope="col">Fire tolerance</th>
                <th scope="col">Diameter at breast height</th>
            </tr>
            <?php foreach($trees as $tree){
                ?><tr>
                    <td><?= $tree['Scientific_name']?></td>
                    <td><?= $tree['Lifespan']?></td>
                    <td><?= $tree['Fire_tolerance']?></td>
                    <td><?= $tree['DBH']?></td>
                </tr><?php
            } ?>
        <table>
            <tr>
                <th scope="col">Climate name</th>
                <th scope="col">Average rainfall</th>
            </tr>
            <?php foreach($climates as $climate){
                ?><tr>
                    <td><?= $climate['Climate_name']?></td>
                    <td><?= $climate['Avg_rainfall']?></td>
                </tr><?php
            } ?>
        </table>
        <?php
        $this->pagetitle = "Species and climate information";
        $this->getContent();
    }

}
?>
