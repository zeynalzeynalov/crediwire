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
		$dbConn = dbConnection::connectToDB();
		$ID = pg_escape_string ($dbConn, $ID);
	
	      	// Firstly check project state
		$result_state = pg_query($dbConn, sprintf('SELECT public.Check_Project_State(%d) as project_state;', $ID)) or die('Select query failed: ' . pg_last_error());;

		$row = pg_fetch_assoc($result_state);

		if( $row['project_state'] == 'CLOSED' )
		{
			$query_action = sprintf('INSERT INTO public.Project_Execution_Record (Starting_Time_Stamp, is_Completed, Project_ID) VALUES (NOW(), FALSE, %d);', $ID);
			$result_action = pg_query($dbConn, $query_action) or die('Insert query failed: ' . pg_last_error());;
			
			echo "OPENED";		 
		}
		else if( $row['project_state'] == 'OPEN' )
		 {
			$query_action = sprintf('UPDATE public.Project_Execution_Record
				SET 
				Ending_Time_Stamp = NOW(),
				is_Completed = TRUE,
				Final_Execution_Time = EXTRACT(EPOCH FROM (NOW() - Starting_Time_Stamp))
				WHERE Project_Execution_Record_ID IN
				(SELECT MAX(Project_Execution_Record_ID) FROM Project_Execution_Record WHERE Project_ID = %d)
				AND
				is_Completed = FALSE;', $ID);
			$result_action = pg_query($dbConn, $query_action) or die('Update query failed: ' . pg_last_error());;
			echo "CLOSED";
		 }

		pg_close($dbCon);
      }

      $RESOURCE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
      $ID = array_shift($request)+0;

      if(strtoupper($RESOURCE) == strtoupper("manageProjectTimeRecord") && isset($ID))
            manageProjectTimeRecord($ID);
?>
