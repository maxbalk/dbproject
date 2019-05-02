<?php 
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    // capture GET requests if provided. otherwise, set to " '' "
    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    if($route == 'test'){
        echo "test route";
    }
    else {
        require_once('routers/HomeRouter.php');
        $router = new router();
        $router->processRequest($action);
    } 
?>
