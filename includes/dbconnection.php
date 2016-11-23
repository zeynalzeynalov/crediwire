<?php
  class dbConnection
  {
    protected static $dbConnection = NULL;
 
    function connectToDB()
    {    
        $dbConnection = pg_connect("host=DB_HOST user=DB_USER password=DB_PASSWORD dbname=DB_NAME") or die ("Could not connect to server\n");;
         
        return $dbConnection;
    }
  }
?>
