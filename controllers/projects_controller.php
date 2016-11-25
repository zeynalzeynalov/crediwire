<?php
      class ProjectsController
      {
            public function main()
            {
                  $projects = Project::fetchAll();
                  require_once(dirname(dirname(__FILE__)).'/views/projects/main.php');
            }

            public function error()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/projects/error.php');
            } 
      }
?>
