<?php
  class dbConnection
  {
    protected static $dbConnection = NULL;
 
    function connectToDB($host, $user, $password, $dbname)
    {
        $this->dbConnection = pg_connect("host=$host user=$user password=$password dbname=$dbname");
         
        return $this->dbConnection;
    }
  }
?>
