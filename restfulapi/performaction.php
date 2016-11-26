<?php
      header("Access-Control-Allow-Orgin: *");
      header("Access-Control-Allow-Methods: *");
      header("Content-Type: application/json");

      require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
      require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');

      if($_SERVER['REQUEST_METHOD'] != 'GET')
      die("Error: Not a GET request!");

      $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      $original_request = $request;

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
			
			//echo "OPENED";		 
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
			//echo "CLOSED";
		 }

		pg_close($dbCon);
	      

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://crediwire.herokuapp.com/restfulapi/getjson.php/getProjectdetails/".$ID);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
      }

	function addNewProject($projectTitle)
	{
		echo $projectTitle;
		$dbConn = dbConnection::connectToDB();
		$projectTitle = pg_escape_string ($dbConn, $projectTitle);
		
		echo $projectTitle;
		
		$query_action = sprintf("
		INSERT INTO public.project(
		project_title, project_created_date)
		VALUES ('%s', NOW());", $projectTitle);
		$result_action = pg_query($dbConn, $query_action);
			
		
		if (!$result_action)
			echo '[{"message":"New project added!'.$query_action.pg_last_error().'"}]';
		else
			echo '[{"message":"Error during project addition '.$query_action.pg_last_error().'"}]';
		
		pg_close($dbConn);
	}

      $RESOURCE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
      $ID = array_shift($request)+0;

	if(strtoupper($RESOURCE) == strtoupper("manageProjectTimeRecord") && isset($ID))
		manageProjectTimeRecord($ID);
	else
	if(strtoupper($RESOURCE) == strtoupper("addNewProject") && isset($ID))
		addNewProject($original_request[1]);
?>
