<?php
//alert class
class Alert{
     
     public $message;
     public $severity;
     public $dismissable;
     
     //options for $sev are success, warning (default), info and danger, 
     function __construct($msg, $sev = "warning", $dis = true){
          $this->message = $msg;
          $this->severity = $sev;
          $this->dismissable = $dis;
     }
     
}

class CardDB{
     
     const MYSQL_HOSTNAME = '127.0.0.1'; 
     const MYSQL_USER= 'severn0988'; 
     const MYSQL_password = ''; 
     const MYSQL_DB = 'business_card'; 
     const PW_SALT = "g0Ut3S!";
     
}
?>