<?php
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    // capture GET requests if provided. otherwise, set to " '' "
    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    if($route == 'test'){
        echo "test route";
    }

    elseif($route == 'forestarea'){
        echo "Forest Area Calculator\n\n";
        require 'forestarea.php';
    }

    elseif($route == 'coordinate_generator'){
      require 'coordgen.php';

    }

    else {
        require 'routers/HomeRouter.php';
        $router = new homepage\router();
        $router->processRequest($action);
    }
?>
