<?php
	header("Access-Control-Allow-Orgin: *");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json");

	require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
	require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');

	if($_SERVER['REQUEST_METHOD'] != 'GET')
		die("Error: Not a GET request!");

	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

	//echo($request);

	function getProjectTimeRecords($ID)
	{
		$dbConn = dbConnection::connectToDB();
		$ID = pg_escape_string ($dbConn, $ID );
	
		$query_select = sprintf("SELECT
		project_execution_record_id,
		to_char(starting_time_stamp, 'DD-MM-YYYY HH24:MI:SS') starting_time_stamp,
		to_char(ending_time_stamp, 'DD-MM-YYYY HH24:MI:SS') ending_time_stamp,
		is_completed,
		project_id,
		final_execution_time,
		
            	TO_CHAR(interval '1 second' * final_execution_time, 'HH24:MI:SS') time_diff_text 
		
		FROM public.Project_Execution_Record WHERE is_completed = TRUE AND Project_ID = %d ORDER BY Project_Execution_Record_ID ASC;", $ID);
		$results = pg_query($dbConn, $query_select) or die('Query failed: ' . pg_last_error());
		
		if (!$results)
		{
			pg_close($dbConn);
			http_response_code(404);
		}

		echo '[';
		for ($i=0; $i < pg_num_rows ($results); $i++)
			echo ( $i>0 ? ',' : '').json_encode(pg_fetch_object ($results));
		echo ']';

		pg_close($dbConn);
	}

	function getProjectDetails($ID)
	{
		$dbConn = dbConnection::connectToDB();
		$ID = pg_escape_string ($dbConn, $ID );
	
		$query_select = sprintf('SELECT * FROM public.Project WHERE Project_ID = %d;', $ID);
		$results = pg_query($dbConn, $query_select) or die('Query failed: ' . pg_last_error());
		
		if (!$results)
		{
			pg_close($dbConn);
			http_response_code(404);
		}
		
		echo '[';
		for ($i=0; $i < pg_num_rows ($results); $i++)
			echo ( $i>0 ? ',' : '').json_encode(pg_fetch_object ($results));
		echo ']';

		pg_close($dbCon);
	}

	$RESOURCE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
	$ID = array_shift($request)+0;
	
	if(strtoupper($RESOURCE) == strtoupper("getProjectTimeRecords") && isset($ID))
		getProjectTimeRecords($ID);
	else
	if(strtoupper($RESOURCE) == strtoupper("getProjectDetails") && isset($ID))	
		getProjectDetails($ID);
?>
