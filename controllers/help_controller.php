<?php
      class HelpController
      {
            public function main()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/help/main.php');
            }
        
            public function error()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/help/error.php');
            } 
      }
?>
