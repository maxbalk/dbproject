<?php
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);
    require_once(ROOT.'/Adapter.php');
    require_once(ROOT.'/views/layout.php');

    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    if($route == 'climates'){
        require_once('routers/ClimateRouter.php');
        $router = new ClimateRouter();
        $router->processRequest($action);
    }

    elseif($route==''){
        require_once('routers/HomeRouter.php');
        $router = new HomeRouter();
        $router->processRequest($action);
    }
?>
