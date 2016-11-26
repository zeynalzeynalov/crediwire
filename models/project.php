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

    public $project_id;
    public $project_title;
    public $project_created_date;
    public $project_state;
    public $project_execution_record;
    public $total_time_diff_text;
        
    public function __construct($Project_id, $Project_Title, $Project_Created_Date, $Project_State, $timeRecordList, $total_time_diff_text)
    {
        $this->project_id = $Project_id;
        $this->project_title = $Project_Title;
        $this->project_created_date = $Project_Created_Date;
        $this->project_state = $Project_State;
      
        $this->project_execution_record = $timeRecordList;
        $this->total_time_diff_text = $total_time_diff_text;
    }
    
    public function getButtonStringForProjectState()
    {
        return ($this->project_state == "CLOSED" ? "Start working" : "Stop working");
    }
    
    public function getButtonStringCssClassForProjectState()
    {
        return ($this->project_state == "CLOSED" ? "btn btn-success" : "btn btn-danger");
    }
           
    public static function fetchAll()
    {
        $projectList = [];
        $dbCon = dbConnection::connectToDB();
        $results = pg_query($dbCon, 
            "SELECT 
            P.*,
            public.Check_Project_State(P.Project_id) Project_State,
            
            (select TO_CHAR(interval '1 second' * sum(final_execution_time), 'HH24:MI:SS') from project_execution_record where project_id = P.project_id) total_time_diff_text

            FROM public.Project P ORDER BY P.Project_id ASC") or die('Select query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
        {
            
            $timeRecordList = [];

            $query_select = sprintf("SELECT 
            
            to_char(starting_time_stamp, 'DD-MM-YYYY HH24:MI:SS') starting_time_stamp,
            to_char(ending_time_stamp, 'DD-MM-YYYY HH24:MI:SS') ending_time_stamp,  
            TO_CHAR(interval '1 second' * final_execution_time, 'HH24:MI:SS') time_diff_text 
            
            FROM public.project_execution_Record WHERE Is_Completed = TRUE AND Project_id = %d ORDER BY Project_Execution_Record_id ASC;", $row['project_id']);

            $r = pg_query($dbCon, $query_select) or die('Select query failed: ' . pg_last_error());

            while ($w = pg_fetch_assoc($r))
            {
                $timeRecordList[] = new Project_Execution_Record($w['starting_time_stamp'], $w['ending_time_stamp'], $w['time_diff_text']);
            }

            $projectList[] = new Project($row['project_id'], $row['project_title'], $row['project_created_date'], $row['project_state'], $timeRecordList, $row['total_time_diff_text']); 
        }
        
        pg_close($dbCon);
        return $projectList;
    }   
  }
?>
