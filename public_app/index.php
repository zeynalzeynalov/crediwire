<?php
    require_once('config/configuration.php');
    require_once('includes/dbconnection.php');
    
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

    $CONTROLLER = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
    $ACTION = array_shift($request)+0;
    
    echo "HERE"
        echo $CONTROLLER;
    if (isset($CONTROLLER) && isset($ACTION))
    {
        $controller = $CONTROLLER;
        $action     = $ACTION;
    }
    else
    {
        $controller = 'projects';
        $action     = 'main';
    }
    
    //require_once('views/template.php');
?>
