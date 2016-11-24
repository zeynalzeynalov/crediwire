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

	class Project_Execution_Record
	{
		public $Starting_Time_Stamp;
		public $End_Time_Stamps;
		public function __construct($Starting_Time_Stamp, $End_Time_Stamps)
		{
		$this->Starting_Time_Stamp = $Starting_Time_Stamp;
		$this->End_Time_Stamps = $End_Time_Stamps;
		}
	}

	function getProjectTimeRecords($ID)
	{
		$dbConn = dbConnection::connectToDB();
		$ID = pg_escape_string ($dbConn, $ID );
	
		$query_select = sprintf('SELECT * FROM public."Project_Execution_Record" WHERE "Is_Completed" = TRUE AND "Project_ID" = %d ORDER BY "Project_Execution_Record_ID" ASC;', $ID);
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

	function getProjectDetails($ID)
	{
		$dbConn = dbConnection::connectToDB();
		$ID = pg_escape_string ($dbConn, $ID );
	
		$query_select = sprintf('SELECT * FROM public."Project" WHERE "Project_ID" = %d;', $ID);
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
?>
