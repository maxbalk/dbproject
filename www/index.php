<?php 
    // capture GET requests if provided. otherwise, set to " '' "
    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    //front controller pattern that handles incoming routes and passes to features
    if($route == 'test'){
        echo "test route";
    }
    //homepage functionality largely deals with Forest entity
    else {
        require 'homepage/router.php';
        $router = new homepage\router();
        $router->processRequest($action);
    }

?>
