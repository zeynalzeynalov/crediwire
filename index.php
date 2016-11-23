<?php
    require_once('config/configuration.php');
    require_once('includes/dbconnection.php');

    if (isset($_GET['controller']) && isset($_GET['action']))
    {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    }
    else
    {
        $controller = 'projects';
        $action     = 'main';
    }

    require_once('views/template.php');
  
    echo "index.php Hello!<br>";
?>
