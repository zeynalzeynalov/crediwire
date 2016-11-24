<?php
  class Project {

    public $Project_ID;
    public $Project_Title;
    public $Project_Created_Date;
    public $Project_State;

    public function __construct($Project_ID, $Project_Title, $Project_Created_Date, $Project_State)
    {
        $this->Project_ID = $Project_ID;
        $this->Project_Title = $Project_Title;
        $this->Project_Created_Date = $Project_Created_Date;
        $this->Project_State = $Project_State;
    }
    
    public function getButtonStringForProjectState()
    {
        retuen ($this->Project_State == "CLOSED" ? "Start working" : "Stop working");
    }
    
    public static function fetchAll()
    {
        $projectList = [];
        $dbCon = dbConnection::connectToDB();
        $results = pg_query($dbCon,'SELECT P.*, public.Check_Project_State(1) "Project_State"
            FROM public."Project" ORDER BY P."Project_ID" ASC') or die('Query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Created_Date'], $row['Project_State']);

        pg_close($dbCon);
        return $projectList;
    }
  }
?>
