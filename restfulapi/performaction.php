<?php
      header("Access-Control-Allow-Orgin: *");
      header("Access-Control-Allow-Methods: *");
      header("Content-Type: application/json");

      require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
      require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');

      if($_SERVER['REQUEST_METHOD'] != 'GET')
      die("Error: Not a GET request!");
      $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

      function manageProjectTimeRecord($ID)
      {
          $dbconn = dbConnection::connectToDB();
          $insert_result = pg_query($dbconn, 'INSERT INTO public."Project_Execution_Record" ("Project_Execution_Record_ID", "Starting_Time_Stamp", "Is_Completed", "Project_ID") VALUES (0, NOW(), FALSE, $ID);');
          if (pg_num_rows($insert_result)) 
              echo "true";
          else
              echo "false";
      }

      $RESOURCE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
      $ID = array_shift($request)+0;

      if(strtoupper($RESOURCE) == strtoupper("manageProjectTimeRecord") && isset($ID))
            manageProjectTimeRecord($ID);
?>
