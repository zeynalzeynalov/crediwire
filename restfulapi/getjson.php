<?php
	header("Access-Control-Allow-Orgin: *");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json");

	require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
	require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');

	if($_SERVER['REQUEST_METHOD'] != 'GET')
		die("Error: Not a GET request!");

	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

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

	function getProjectTimeRecords($projectID)
	{
		$recordList = [];
		$dbconn = dbConnection::connectToDB();

		
		while ($row = pg_fetch_assoc($results))
		  $recordList[] = new Project_Execution_Record($row['Starting_Time_Stamp'], $row['End_Time_Stamps']);

		return $recordList;
		
		$DB_TABLE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
		$ID = array_shift($request)+0;

		$DB_TABLE = mysqli_real_escape_string($dbCon, $DB_TABLE );
		$ID = mysqli_real_escape_string($dbCon, $ID );
	
		$query_select = sprintf('SELECT * FROM public."%s" WHERE "Is_Completed" = TRUE AND "Project_ID" = %d;',$DB_TABLE, $ID);

		$results = pg_query($dbconn,$query_select) or die('Query failed: ' . pg_last_error());
		
		$sqlQuery = "SELECT * FROM ``".( $ID ? " WHERE ID = $ID" : '' );

		$result = mysqli_query($dbCon,$sqlQuery);

		if (!$result)
		{
			http_response_code(404);
			die(mysqli_error());
		}

		if (!$ID)
			echo '[';

		for ($i=0; $i < mysqli_num_rows($result); $i++)
			echo ( $i>0 ? ',' : '').json_encode(mysqli_fetch_object($result));

		if (!$ID)
			echo ']';

		mysqli_close($dbCon);
		
	}



		

?>
