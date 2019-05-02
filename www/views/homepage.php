<? ob_start() ?>
    <h2>homepage view</h2>
<?

class Homepage{
    private $content;
    function __construct(){
        $content = ob_get_clean(); 
    }
    public function getContent(){
        return $content;
    }
}
?>
