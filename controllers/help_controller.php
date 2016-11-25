<?php
      class HelpController
      {
            public function main()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/help.php');
            }
        
            public function error()
            {
                  require_once(dirname(dirname(__FILE__)).'/views/error.php');
            } 
      }
?>
