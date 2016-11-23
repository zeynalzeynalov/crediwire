<?php
  $projectID = $_REQUEST["project_id"];

  $result_string = "";

  require_once('config/configuration.php');
  require_once('includes/dbconnection.php');
  
  class Project_Execution_Record {
    public $Starting_Time_Stamp;
    public $End_Time_Stamps;

    public function __construct($Starting_Time_Stamp, $End_Time_Stamps)
    {
       $this->$Starting_Time_Stamp = $Starting_Time_Stamp;
       $this->$End_Time_Stamps = $End_Time_Stamps;
    }
  }

  function getProjectTimeRecords($projectID)
  {
        $projectList = [];
        $dbconn = dbConnection::connectToDB();
        $results = pg_query($con,'SELECT "Project_Execution_Record_ID", "Starting_Time_Stamp", "End_Time_Stamps", "Is_Completed", "Project_ID"
	FROM public."Project_Execution_Record" WHERE "Is_Completed" = TRUE AND "Project_ID" = $projectID ORDER BY "Project_Execution_Record_ID" ASC;') or die('Query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
          $projectList[] = new Project_Execution_Record($row['Starting_Time_Stamp'], $row['End_Time_Stamps']);
        return $projectList;
  }

  function startTimeRecord($projectID)
  {
      $dbconn = dbConnection::connectToDB();
      $insert_result = pg_query($dbconn, 'INSERT INTO public."Project_Execution_Record" ("Project_Execution_Record_ID", "Starting_Time_Stamp", "Is_Completed", "Project_ID") VALUES (0, now(), FALSE, $projectID);'");
      if (pg_num_rows($insert_result)) 
        echo "Record Added!<br/>";
      else
        echo "Record not Added :(";
  }
  
  if( $_REQUEST["action"] == "getProjectTimeRecords")
  {
      $projectRecordList = getProjectTimeRecords($_REQUEST["project_id"]);
      
      $return_value = "";
      
      foreach ($projectRecordList as $r)
        $return_value .= '<span>'.$r->Starting_Time_Stamp.' - '.$r->End_Time_Stamps.'</span>';
        
      echo $return_value;
  }
  else
    if( $_REQUEST["action"] == "startTimeRecord")
      startTimeRecord($_REQUEST["project_id"]);
  
  
?>
