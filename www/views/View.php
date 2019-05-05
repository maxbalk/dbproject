<link rel="stylesheet" type="text/css" href="/views/style.css">
<?php
abstract class View {

    protected $pagetitle;

    public function __construct(){
        ob_start();
    }

    protected function getContent(){
        $content = ob_get_clean();
        ob_end_clean();
        ?>
        <div style="text-align:center">
        <div style="display: inline-block">
            <h2><?= $this->pagetitle ?></h2><br>
            <?= $content; ?>
        <div>
        </div>
        <?php
    }
}
