<?php
    require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
    require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
    
    $_request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

    echo '[0]'.$request[0];
    echo '[1]'.$request[1];

    echo '<br>server url:'.$_SERVER['PATH_INFO'];

    $_CONTROLLER = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($_request)));
    $_ACTION = array_shift($_request)+0;

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
