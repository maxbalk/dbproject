<?php
    define("ROOT",$_SERVER["DOCUMENT_ROOT"]);
    require_once(ROOT.'/Adapter.php');

    // capture GET requests if provided. otherwise, set to " '' "
    $route = $_GET['route'] ?? '';
    $action = $_GET['do'] ?? '';

    if($route == 'test'){
        echo "test route";
    }

    elseif($route == 'forestarea'){
        echo "Forest Area Calculator\n\n";
        require_once('forestarea.php');
    }

    elseif($route == 'coordinate_generator'){
      require_once('coordgen.php');

    }

    elseif($route == 'climates'){
        require_once('routers/ClimateRouter.php');
        $router = new router();
        $router->processRequest($action);
    }

    else {
        require_once('routers/HomeRouter.php');
        $router = new router();
        $router->processRequest($action);
    }
?>
