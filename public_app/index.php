<?php
    require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
    require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
    
    $_request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $_CONTROLLER = trim($_request[0]);
    $_ACTION     = trim($_request[1]);

echo isset($_CONTROLLER) ;
echo isset($_ACTION);

echo $_CONTROLLER ;
echo $_ACTION;

    if ($_CONTROLLER === NULL && $_ACTION === NULL)
    {
        $controller = 'projects';
        $action     = 'main';
    }
    else
    if ($_ACTION === NULL)
    {
        $controller = $_CONTROLLER;
        $action     = '';
    }
    else
    {
        $controller = $_CONTROLLER;
        $action     = $_ACTION;
    }       

echo $controller;
echo $action;

    require_once(dirname(dirname(__FILE__)).'/views/template.php');
?>
