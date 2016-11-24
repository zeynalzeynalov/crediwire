<?php

    class Project_Execution_Record
    {
      public $Starting_Time_Stamp;
      public $Ending_Time_Stamp;
      public function __construct($Starting_Time_Stamp, $Ending_Time_Stamp)
      {
      $this->Starting_Time_Stamp = $Starting_Time_Stamp;
      $this->Ending_Time_Stamp = $Ending_Time_Stamp;
      }
    }

    class Project {

    public $Project_ID;
    public $Project_Title;
    public $Project_Created_Date;
    public $Project_State;
    public $Project_Execution_Record;
        
    public function __construct($Project_ID, $Project_Title, $Project_Created_Date, $Project_State, $timeRecordList)
    {
        $this->Project_ID = $Project_ID;
        $this->Project_Title = $Project_Title;
        $this->Project_Created_Date = $Project_Created_Date;
        $this->Project_State = $Project_State;
      
        $this->Project_Execution_Record = $timeRecordList;
    }
    
    public function getButtonStringForProjectState()
    {
        return ($this->Project_State == "CLOSED" ? "Start working" : "Stop working");
    }
    
    public function getButtonStringCssClassForProjectState()
    {
        return ($this->Project_State == "CLOSED" ? "btn btn-success" : "btn btn-danger");
    }
    
    public static function fetchAll()
    {
        $projectList = [];
        $dbCon = dbConnection::connectToDB();
        $results = pg_query($dbCon, 'SELECT P.*, public.Check_Project_State(P."Project_ID") "Project_State"
            FROM public."Project" P ORDER BY P."Project_ID" ASC') or die('Select query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
        {
            
                 $timeRecordList = [];
       $dbCon = dbConnection::connectToDB();
       $query_select = sprintf('SELECT * FROM public."Project_Execution_Record" WHERE "Is_Completed" = TRUE AND "Project_ID" = %d ORDER BY "Project_Execution_Record_ID" ASC;', $projectID);
       
       $r = pg_query($dbCon, $query_select) or die('Select query failed: ' . pg_last_error());

        while ($w = pg_fetch_assoc($r))
          $timeRecordList[] = new Project_Execution_Record($w['Starting_Time_Stamp'], $w['Ending_Time_Stamp']);

 
            
            
            echo coun($timeRecordList);
            
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Created_Date'], $row['Project_State'], $timeRecordList); 
        }
        pg_close($dbCon);
        return $projectList;
    }
  }
?>
