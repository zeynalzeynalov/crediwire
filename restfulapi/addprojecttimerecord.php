<?php
  $projectID = $_REQUEST["project_id"];

  $result_string = "";

  require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
  require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
  
  class Project_Execution_Record {
    public $Starting_Time_Stamp;
    public $End_Time_Stamps;

    public function __construct($Starting_Time_Stamp, $End_Time_Stamps)
    {
       $this->Starting_Time_Stamp = $Starting_Time_Stamp;
       $this->End_Time_Stamps = $End_Time_Stamps;
    }
  }

  function startTimeRecord($projectID)
  {
      $dbconn = dbConnection::connectToDB();
      $insert_result = pg_query($dbconn, 'INSERT INTO public."Project_Execution_Record" ("Project_Execution_Record_ID", "Starting_Time_Stamp", "Is_Completed", "Project_ID") VALUES (0, now(), FALSE, $projectID);');
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
        $return_value .= '<span class="label label-info">'.$r->Starting_Time_Stamp.' - '.$r->End_Time_Stamps.'</span><br>';
        
      echo $return_value === "" ? "no suggestion" : $return_value;;
  }
  else
    if( $_REQUEST["action"] == "startTimeRecord")
      startTimeRecord($_REQUEST["project_id"]);
  
  
?>
