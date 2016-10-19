<?php
require_once "utils.php";
class User{
    
    public $first_name;
    public $last_name;
    public $email;
    public $pw_hash;
    public $id = null;

    public function __construct($first_name, $last_name, $email){
        
         $this->first_name = $first_name;
         $this->last_name = $last_name;
         $this->email = $email;
    } 
    
    public function set_password($pw){
        $this->pw_hash = hash('ripemd128', CardDB::PW_SALT.$pw);
        
    }
    
    public static function get_user_by_id($id){
        
        //Query the user table for a user matching $id, 
        require_once 'login.php';
        $connection = new mysqli(CardDB::MYSQL_HOSTNAME, CardDB::MYSQL_USER, CardDB::MYSQL_password, CardDB::MYSQL_DB);
        if ($connection->connect_error) die($connection->connect_error);
        $query = "SELECT * FROM user WHERE id = $id";
        $result = mysqli_fetch_assoc($connection->query($query));
        
        if (isset($result)) {
            $user = new User($result['first_name'], $result['last_name'], $result['email']);
            $user->pw_hash = $result['password'];
            $user->id = $result['id'];
            return $user;
        }
        else {
        
        //then construct a user object from the record and return it.
        //Important Make sure to set the id and pw_hash fields on the user object before returning it.
        //Those fields do not get set by the constructor!
        //Return null if a matching user is not found.
        return null;
        }

    }
    
    // public function get_freinds(){
        
    //     //return an array of friends of the logged in user, the query is supplied for you
    //     $connection = new mysqli(Blabbr::MYSQL_HOSTNAME, Blabbr::MYSQL_USER, Blabbr::MYSQL_password, Blabbr::MYSQL_DB);
    //     $query = "SELECT DISTINCT sub.* FROM ".
    //             "(SELECT u.* FROM user u JOIN friendship f ON f.follower_id = u.id WHERE f.target_id = $this->id ".
    //             "UNION ".
    //             "SELECT u.* FROM user u JOIN friendship f ON f.target_id = u.id WHERE f.follower_id = $this->id) as sub";
    //     $results = array($connection->query($query));
    //     foreach ($results as $friend) {
    //         if (isset($results)) {
    //             $friend = new user($results->first_name, $results->last_name, $results->email, $results->password);
    //             $friends[] = $friend;
    //         }
    //         elseif ($connection->connect_error) die($connection->connect_error);
    //     }
    //     return $friends;
        
    // }
    
    
    //save the user object to the database.
    //return an array in the form of array('success' => true , 'message' => 'User successfully saved.')
    public function save(){
        $mysqli = new mysqli(CardDB::MYSQL_HOSTNAME, CardDB::MYSQL_USER, CardDB::MYSQL_password, CardDB::MYSQL_DB);
        
        if($mysqli->connect_error){//bad connection
            return array('success' => false, 'message' => $mysqli->connect_error);
        }
        
        if($this->pw_hash == null){
            return array('success' => false, 'message' => 'You must set a password before saving the user.');
        }
        //sanitize these
        $email = $mysqli->real_escape_string($this->email);
        $first_name = $mysqli->real_escape_string($this->first_name);
        $last_name = $mysqli->real_escape_string($this->last_name);
        
        $query = "INSERT INTO user (email, first_name, last_name, password, signup_date) ".
                    "VALUES('$email', '$first_name', '$last_name', '$this->pw_hash', NOW()) ".
                    "ON DUPLICATE KEY UPDATE first_name=VALUES(first_name), last_name=VALUES(last_name), password=VALUES(password)";
    
        //execute query
        $res = $mysqli->query($query);
        //check results, if bad return the proper repsonse
        if(!isset($res)){
            return array('success' => false, 'message' => $mysqli->error);
        }
    
        //if it's a new user, get the user id and set the id property
        if($this->id == null){//set the id if needed.
            $this->id = $mysqli->insert_id;
        }
        $mysqli->close();//free up the resource
        return array('success' => true, 'message' => "User with id $this->id saved to database");

    }
    
    // public function get_image(){
    //     $file = "img/users/".strtolower($this->first_name)."_".strtolower($this->last_name).".jpg";
    //     if(file_exists($file)){
    //         return $file;
    //     }else{
    //         return "img/users/monkey.jpg";
    //     }
    // }

    
}