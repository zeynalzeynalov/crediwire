<?php
  class dbConnection
  {
    protected static $dbConnection = NULL;
 
    function connectToDB()
    {    
        $dbConnection = pg_connect(sprintf("host=%s user=%s password=%s dbname=%s", DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);)
          
        or die ("Could not connect to server\n");;
         
        return $dbConnection;
    }
  }
?>
