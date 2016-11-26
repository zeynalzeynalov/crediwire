<?php
      class ProjectsController
      {
            public function main()
            {
                  $projects = Project::fetchAll();
                  $projects_total_durations = Project::getTotalProjectDurations();
                  require_once(dirname(dirname(__FILE__)).'/views/projects/main.php');
            }

            public function error()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/error.php');
            } 
      }
?>
