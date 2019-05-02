<?
class Climate{
    public $content;
    function __construct(){
        $content = ob_get_clean(); 
    }
    public function getContent(){
        ob_start()
        ?>
    <h2>Climate and Species View</h2>
    <? $content = ob_get_clean();
        echo $content;
    }

}
?>
