<?php
  $q = $_REQUEST["project_id"];

  $hint = "";

  require_once('config/configuration.php');
  require_once('includes/dbconnection.php');
  
  public static function getProjectTimeRecords()
  {
        $projectList = [];
        $con = dbConnection::connectToDB();
        $results = pg_query($con,'SELECT * FROM public."Project" ORDER BY "Project_ID" ASC') or die('Query failed: ' . pg_last_error());
        while ($row = pg_fetch_assoc($results))
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Slug'], $row['Project_Created_Date']);
        return $projectList;
  }
  
  echo $hint;
?>
