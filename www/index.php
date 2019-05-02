<?php 
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    // capture GET requests if provided. otherwise, set to " '' "
    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    if($route == 'test'){
        echo "test route";
    }
    else {
        require 'routers/HomeRouter.php';
        $router = new homepage\router();
        $router->processRequest($action);
    }
?>
