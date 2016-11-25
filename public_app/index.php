<?php
    require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
    require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
    
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

    $CONTROLLER = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
    $ACTION = array_shift($request)+0;
    
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
    
    require_once(dirname(dirname(__FILE__)).'/views/template.php');
?>
