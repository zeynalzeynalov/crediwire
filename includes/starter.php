<?php
      function start($controller, $action)
      {
            require_once(dirname(dirname(__FILE__)).'/controllers/' . $controller . '_controller.php');

            switch($controller) {
              case 'projects':
                  require_once(dirname(dirname(__FILE__)).'/models/project.php');
                  $controller = new ProjectsController();
              break;
            }

            $controller->{ $action }();
      }

      $controllerList = array('projects' => ['main', 'error'], 'help' => ['help', 'error']);

      if (array_key_exists($controller, $controllerList))
      {
          if (in_array($action, $controllerList[$controller]))
              start($controller, $action);
          else
              start('projects', 'error');
      } 
      else
          start('projects', 'error');
?>
