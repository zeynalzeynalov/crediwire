<?php
  class dbConnection
  {
    protected static $dbConnection = NULL;
 
    function connectToDB()
    {    
        $this->dbConnection = pg_connect("host=DB_HOST user=DB_USER password=DB_PASSWORD dbname=DB_NAME");
         
        return $this->dbConnection;
    }
  }
?>
