<?php
      class RestfulapiController
      {
            public function main()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/restfulapi.php');
            }
        
            public function error()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/error.php');
            } 
      }
?>
