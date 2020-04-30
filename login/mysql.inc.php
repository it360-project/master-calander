<?php
  // mysql.inc.php - This file will be used to establish the database connection.
  class myConnectDB extends mysqli{
    public function __construct($hostname="midn.cs.usna.edu",
        $user="m213990",
        $password="mustang",
        $dbname="it360_master_calendar"){
      parent::__construct($hostname, $user, $password, $dbname);
    }
  }
?>
