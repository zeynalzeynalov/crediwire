<?php
    require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
    require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
    
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

    echo $request[0];
    echo $request[1];

    echo $_SERVER['PATH_INFO'];

    $_CONTROLLER = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
    $_ACTION = array_shift($request)+0;

    echo $CONTROLLER.'-'.$ACTION;

    if (isset($_CONTROLLER) && isset($_ACTION))
    {
        $controller = $CONTROLLER;
        $action     = $ACTION;
    }
    else
    {
        $controller = 'projects';
        $action     = 'main';
    }
    
    require_once(dirname(dirname(__FILE__)).'/views/template.php');
?>
