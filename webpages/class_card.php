<?php

class Card {
    
    public $first_name;
    public $last_name;
    public $position;
    public $business_name;
    public $business_address;
    public $business_website;
    public $email;
    public $phone_number;
    
    public function __construct($first_name, $last_name, $position, $business_name, $business_address,
        $business_website, $email, $phone_number){
        
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->postion = $position;
        $this->business_name = $business_name;
        $this->business_address = $business_address;
        $this->business_website = $business_website;
        $this->email = $email;
        $this->phone_number = $phone_number;
        
    }
    
    public function save_card() {
    
    $mysqli = new mysqli('localhost', 'admin', 'admin', 'Properties');
    
    $sql = "INSERT INTO Info (firstname, lastname, company_name, title, website, email)
            VALUES ('$first_name', '$last_name', '$business_name', '$position', '$business_website', '$email')";
            
    if (mysqli_query($mysqli, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
        
    }
    
    public function get_cards_by_id($user_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: front_page.php");
        }
        $query = "SELECT * FROM CARD where user_id = $user_id";
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
        
        $query = "SELECT User.email, Info.$card_id FROM User INNER JOIN Info
            ON User.id = Info.user_id";
        
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
    
    public function share_card($user_id, $share_id, $card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $query = "INSERT INTO shared VALUES (SELECT * FROM info WHERE id = '$card_id')
        WHERE id = '$user_id'";
        $result = $mysqli->query($query);
        if (isset($result)) {
            $message = new Alert('Card Successfully shared','success');
            header("Location: yourcards.php");
        }
   }
    
    public function delete_owned_card($user_id, $card_id) {
        $mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);
        if($mysqli->connect_error) {
            $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
            return null;
            header("Location: yourcards.php");
        }
        
        $query = "DELETE FROM info WHERE id = '$card_id'";
        
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
    
    public function delete_shared_card($shared_id) {
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