<?php
	header("Access-Control-Allow-Orgin: *");
	header("Access-Control-Allow-Methods: *");
	header("Content-Type: application/json");

	if($_SERVER['REQUEST_METHOD'] != 'GET')
		die("Error: Not a GET request!");

	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	
	$dbCon = mysqli_connect('localhost', 'cready_erento', '#note#pad#', 'cready_erento');

	if ($dbCon->connect_error)
		die("Connection failed: " . $dbCon->connect_error);
	mysqli_set_charset($dbCon,'utf8');
		
	$DB_TABLE = strtoupper(preg_replace('/[^a-z0-9_]+/i','',array_shift($request)));
	$ID = array_shift($request)+0;

	$DB_TABLE = mysqli_real_escape_string($dbCon, $DB_TABLE );
	$ID = mysqli_real_escape_string($dbCon, $ID );

	//echo $DB_TABLE.' - '.$ID.'<br>';

	$sqlQuery = "SELECT * FROM `$DB_TABLE`".( $ID ? " WHERE ID = $ID" : '' );

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
?>
