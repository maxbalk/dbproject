<? ob_start() ?>
    <h2>homepage view</h2>
<? 
$content = ob_get_clean(); 
return $content; 
?>
