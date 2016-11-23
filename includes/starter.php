<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'projects':
        // we need the model to query the database later in the controller
        require_once('models/project.php');
        $controller = new ProjectsController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('projects' => ['main', 'error'],
                       'posts' => ['index', 'show']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('projects', 'error');
    }
  } else {
    call('projects', 'error');
  }
?>
