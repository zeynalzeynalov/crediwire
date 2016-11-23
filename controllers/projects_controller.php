<?php
  class ProjectsController {
    public function main() {
      $first_name = 'Jon';
      $last_name  = 'Snow';
      require_once('views/projects/main.php');
    }

    public function error() {
      require_once('views/projects/error.php');
    }
  }
?>
