<?php
require "class.php";
class Card {
    
    public $first_name;
    public $last_name;
    public $position;
    public $business_name;
    public $business_address;
    public $city;
    public $state;
    public $zipcode;
    public $business_website;
    public $email;
    public $phone_number;
    public $user_id;
    
    public function __construct($first_name, $last_name, $position, $business_name, $business_address,
        $city, $state, $zipcode, $business_website, $email, $phone_number, $user_id){
        
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->position = $position;
        $this->business_name = $business_name;
        $this->business_address = $business_address;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
        $this->business_website = $business_website;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->user_id = $user_id;
        
    }
    
    public function save_card() {
    
    $conn = new mysqli('localhost', 'admin', 'admin', 'vcard');
     
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
        $first_name = $this->first_name;
        $last_name = $this->last_name;
        $position = $this->position;
        $business_name = $this->business_name;
        $business_address = $this->business_address;
        $city = $this->city;
        $state = $this->state;
        $zipcode = $this->zipcode;
        $business_website = $this->business_website;
        $email = $this->email;
        $phone_number = $this->phone_number;
        $user_id = $this->user_id;
        
        //sanitize
        $first_name = $mysqli->real_escape_string($this->first_name);
        $last_name = $mysqli->real_escape_string($this->last_name);
        $position = $mysqli->real_escape_string($this->position);
        $business_name = $mysqli->real_escape_string($this->business_name);
        $business_address = $mysqli->real_escape_string($this->business_address);
        $city = $mysqli->real_escape_string($this->city);
        $state = $mysqli->real_escape_string($this->state);
        $zipcode = $mysqli->real_escape_string($this->zipcode);
        $business_website = $mysqli->real_escape_string($this->business_website);
        $email = $mysqli->real_escape_string($this->email);
        $phone_number = $mysqli->real_escape_string($this->phone_number);
        $user_id = $mysqli->real_escape_string($this->user_id);
    
        $sql = "INSERT INTO card (first_name, last_name, company_name, title, company_addr, city, state, zip, phone, website, email, user_id)
            VALUES ('$first_name', '$last_name', '$business_name', '$position', 
            '$business_address', '$city', '$state', '$zipcode', '$phone_number', '$business_website', '$email', $user_id)";
            
        //check results, if bad return the proper repsonse
      if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            return TRUE;
      } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
        
    }
    
    public function get_cards_by_user($user_id) {
        $mysqli = new mysqli('localhost', 'admin', 'admin', 'vcard');
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: front_page.php");
        }
        $user_id = $mysqli->real_escape_string($user_id);
        $query = "SELECT * FROM card where user_id = '$user_id'";
        $result = $mysqli->query($query);
        $results = array();
        $length = $result->num_rows;
        $i = 0;
        if (isset($result)) {
            while(($i < $length)) {
                   $results[] = mysqli_fetch_assoc($result);
                   $i++;
            }
            return $results;
        }
        else {
            $message = new Alert('There was a problem fetching your cards, 
            try again later', 'warning');
            header("Location: yourcard.php");
        }
    }
    public function get_user_by_card($card_id) {
        $mysqli = new mysqli('localhost', 'admin', 'admin', 'vcard');
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: front_page.php");
        }
        
        $card_id = $mysqli->real_escape_string($card_id);
        $query = "SELECT * FROM user INNER JOIN card
            ON user.id = card.user_id WHERE card.user_id = '$card_id'";
        
        $result = $mysqli->query($query);
        
        if (isset($result)) {
            $result_array = mysqli_fetch_assoc($result);
            header("Location: yourcards.php");
            return $result_array;
        }
        else {
            $message = new Alert('There was a problem fetching the user', 'warning');
            header:("Location: dashboard.php");
        }
        
    }
    
    public function share_card($email, $card_id, $from_id) {
        $mysqli = new mysqli('localhost', 'admin', 'admin', 'vcard');
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $email = $mysqli->real_escape_string($email);
        $card_id = $mysqli->real_escape_string($card_id);
        $from_id = $mysqli->real_escape_string($from_id);
        $prequery = "SELECT id FROM user WHERE email = '$email'";
        $first_result = $mysqli->query($prequery);
        if (isset($first_result)) {
            $first_array = mysqli_fetch_array($first_result);
            $to_id = $first_array[0];
        }
        else {
           $message = new Alert('Else we are graduating sucks to suck bro', 'warning');
        }
        
        $query = "INSERT INTO share (to_id, from_id, card_id) VALUES 
        ('$to_id', '$from_id', '$card_id')";
        $result = $mysqli->query($query);
        if (isset($result)) {
            $message = new Alert('Card Successfully shared','success');
            header("Location: ../yourcards.php");
        }
   }
   
    public function get_shared_cards($user_id) {
        $mysqli = new mysqli('localhost', 'admin', 'admin', 'vcard');
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        $user_id = $mysqli->real_escape_string($user_id);
        $query = "SELECT * FROM card INNER JOIN share ON share.card_id = card.id
        WHERE share.to_id = '$user_id'";
        
        $result = $mysqli->query($query);
        $results = array();
        $length = $result->num_rows;
        $i = 0;
        if (isset($result)) {
            while(($i < $length)) {
                   $results[] = mysqli_fetch_assoc($result);
                   $i++;
            }
            return $results;
        }
        else {
            $message = new Alert('There was a problem fetching your cards, 
            try again later', 'warning');
            header("Location: your_Rolodex.php");
    }
    
}
    public function delete_owned_card($user_id, $card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $user_id = $mysqli->real_escape_string($user_id);
        $card_id = $mysqli->real_escape_string($card_id);
        $query = "DELETE FROM card WHERE id = '$card_id' AND user_id = '$user_id'";
        
        $result = $mysqli->query($query);
        if (isset($result)) {
            $message = new Alert('Card Successfully deleted','success');
            header("Location: yourcards.php");
        }
        else {
            $message = new Alert('Card not deleted; something went wrong......', 'warning');
            header("Location: yourcards.php");
        }
        
    }
    
    public function delete_shared_card($card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $card_id = $mysqli->real_escape_string($card_id);
        $query = "DELETE FROM shared WHERE card_id = '$card_id'";
        $result = $mysqli->query($query);
        if (isset($result)) {
            $message = new Alert('Card Deleted!', 'success');
            header("Location: your_Rolodex.php");
        }
        else {
            $message = new Alert('Shared card not deleted; something went wrong......', 'warning');
            header("Location: your_Rolodex.php"); 
        }
    }
}



?>