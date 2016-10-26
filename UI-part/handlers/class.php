<?php
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


class Vcard{
     
     const MYSQL_HOSTNAME = '127.0.0.1'; 
    //  const MYSQL_USER= 'admin';
    const MYSQL_USER= 'severn3088';
    const MYSQL_password= '';
    //  const MYSQL_password = 'admin'; 
     const MYSQL_DB = 'vcard'; 
     const PW_SALT = "g0Ut3S!";
     // username: edwardni
     // project: webapp
     
}

class Account{
    
    public $email;
    public $pw_hash;
    public $id = null;

    public function __construct($email){
        
         $this->email = $email;
        
    } 
    
    public function set_password($pw){
        $this->pw_hash = hash('ripemd128', Vcard::PW_SALT.$pw);
        
    }
    
    public static function get_user_by_id($id){
        //Query the user table for a user matching $id, 
        //then construct a user object from the record and return it
        //Query the user table for a user matching $id, 
       $mysqli = new mysqli("localhost", "admin", "admin", "vcard");
        if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: " .$mysqli->connect_error;
        }else{
                //echo "Success!";
                };
        $query = "SELECT * FROM user WHERE id = '$id'";
        $res = $mysqli->query($query);
        $row = $res->fetch_assoc();
        
         $user = new Account($row['email']);
         $user->pw_hash = $row['password'];
         $user->id = $id;
            if($id == $row['id']){
            return $user;
     }else{
         return null;
     }
    }
      

    //save the user object to the database.
    //return an array in the form of array('success' => true , 'message' => 'User successfully saved.')
    public function save(){
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        
        if($mysqli->connect_error){//bad connection
            return array('success' => false, 'message' => $mysqli->connect_error);
        }
        
        if($this->pw_hash == null){
            return array('success' => false, 'message' => 'You must set a password before saving the user.');
        }elseif($this->pw_hash == "wrong"){
            return array('success' => false, 'message' => 'Your password is not consistant.');
            
        }
        //sanitize these
        $email = $mysqli->real_escape_string($this->email);
        
        $query = "INSERT INTO user (email, password, signup_date) ".
                    "VALUES('$email', '$this->pw_hash', NOW()) ".
                    "ON DUPLICATE KEY UPDATE email=VALUES(email), password=VALUES(password)";
    
        //execute query
        $res = $mysqli->query($query);
        //check results, if bad return the proper repsonse
        if(!$res){
            return array('success' => false, 'message' => $mysqli->error);
        }
    
        //if it's a new user, get the user id and set the id property
        if($this->id == null){//set the id if needed.
            $this->id = $mysqli->insert_id;
        }
        //$res->close();//free up the resource
        return array('success' => true, 'message' => "User with id $this->id saved to database");

    }
    
 
  
}


?>
