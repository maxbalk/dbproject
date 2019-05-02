<?
class ClimatePage{
    public $content;
    function __construct(){
        $content = ob_get_clean(); 
    }
    public function getContent(){
        ob_start()
        ?>
            <h2>Climate and Species View</h2>
            <? 
            foreach($climates as $climate){
                echo $climate->name."<br>";
            }
            ?>
        <? $content = ob_get_clean();
        echo $content;
    }

}
?>
