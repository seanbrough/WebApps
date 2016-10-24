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
        $business_website, $email, $phone_number, $user_id){
        
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->postion = $position;
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
    
    $mysqli = new mysqli('localhost', 'admin', 'admin', 'Properties');
    
    $sql = "INSERT INTO card (firstname, lastname, company_name, title, website, email, user_id)
            VALUES ('$first_name', '$last_name', '$business_name', '$position', 
            '$business_address', '$city', '$state', '$zipcode', '$business_website', '$email', $user_id)";
            
    if (mysqli_query($mysqli, $sql)) {
        echo "New record created successfully";
        return TRUE;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        return FALSE;
    }
        
    }
    
    public function get_cards_by_user($user_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: front_page.php");
        }
        $query = "SELECT * FROM card where user_id = '$user_id'";
        $result = $mysqli->query($query);
        if (isset($result)) {
            $result_array = mysqli_fetch_assoc($results);
            return $result_array;
        }
        else {
            $message = new Alert('There was a problem fetching your cards, 
            try again later', 'warning');
            header("Location: yourcard.php");
        }
    }
    
    public function get_user_by_card($card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: front_page.php");
        }
        
        $query = "SELECT user.email FROM user INNER JOIN card
            ON user.id = card.user_id WHERE card.id = '$card_id'";
        
        $result = $mysqli->query($query);
        
        if (isset($result)) {
            $result_array = mysqli_fetch_assoc($results);
            header("Location: yourcards.php");
            return $result_array;
        }
        else {
            $message = new Alert('There was a problem fetching the user', 'warning');
            header:("Location: dashboard.php");
        }
        
    }
    
    public function share_card($to_id, $card_id, $from_id) {
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

header("Location: ../UI-part/create_card.php");


?>