<?
class Homepage{
    public $content;
    function __construct(){
        $content = ob_get_clean(); 
    }
    public function getContent(){
        ob_start()
        ?>
            <h2>homepage view</h2>
        <? $content = ob_get_clean();
        echo $content;
    }

}
?>