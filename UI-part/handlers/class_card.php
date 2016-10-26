<?php

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
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $query = "INSERT INTO shared (to_id, from_id, card_id) VALUES 
        ('$to_id', '$from_id', '$card_id')";
        $result = $mysqli->query($query);
        if (isset($result)) {
            $message = new Alert('Card Successfully shared','success');
            header("Location: yourcards.php");
        }
   }
   
    public function get_shared_cards($user_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $query = "SELECT * FROM card INNER JOIN share ON share.card_id = card.id
        WHERE share.to_id = $user_id";
    }
    
    public function delete_owned_card($user_id, $card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
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