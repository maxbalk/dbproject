<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]);
require_once(ROOT.'/Adapter.php');
require_once(ROOT.'/views/View.php');
require_once(ROOT.'/controllers/Controller.php');

$route = $_GET['route'] ?? '';
$action = $_GET['do'] ?? '';

if($route == 'climates'){
    require_once('routers/ClimateRouter.php');
    $router = new ClimateRouter();
    $router->processRequest($action);
}
elseif($route=='forest'){
    require_once('routers/ForestRouter.php');
    $router = new ForestRouter();
    $router->processRequest($action);
}
elseif($route==''){
    require_once('routers/HomeRouter.php');
    $router = new HomeRouter();
    $router->processRequest($action);
}
?>
