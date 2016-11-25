<?php

    class Project_Execution_Record
    {
        public $starting_time_stamp;
        public $ending_time_stamp;
        public $time_diff_text;

        public function __construct($Starting_Time_Stamp, $Ending_Time_Stamp, $Time_Diff_Text)
        {
          $this->starting_time_stamp = $Starting_Time_Stamp;
          $this->ending_time_stamp = $Ending_Time_Stamp;
          $this->time_diff_text = $Time_Diff_Text;
        }
    }

    class Project {

    public $Project_id;
    public $Project_Title;
    public $Project_Created_Date;
    public $Project_State;
    public $Project_Execution_Record;
        
    public function __construct($Project_id, $Project_Title, $Project_Created_Date, $Project_State, $timeRecordList)
    {
        $this->Project_id = $Project_id;
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
        $results = pg_query($dbCon, 'SELECT P.*, public.Check_Project_State(P.Project_id) Project_State
            FROM public.Project P ORDER BY P.Project_id ASC') or die('Select query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
        {
            
            $timeRecordList = [];
            $dbCon = dbConnection::connectToDB();
            $query_select = sprintf("SELECT *, TO_CHAR(interval '1 second' * final_execution_time, 'HH24:MI:SS') time_diff_text FROM public.project_execution_Record WHERE Is_Completed = TRUE AND Project_id = %d ORDER BY Project_Execution_Record_id ASC;", $row['project_id']);

            $r = pg_query($dbCon, $query_select) or die('Select query failed: ' . pg_last_error());

            while ($w = pg_fetch_assoc($r))
            {
                $timeRecordList[] = new Project_Execution_Record($w['starting_time_stamp'], $w['ending_time_stamp'], $w['time_diff_text']);
            }

            $projectList[] = new Project($row['project_id'], $row['project_title'], $row['project_created_date'], $row['project_state'], $timeRecordList); 
        }
        pg_close($dbCon);
        return $projectList;
    }
  }
?>
