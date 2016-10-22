<?php

class {
    
    $connection = new mysqli(CardDB::MYSQL_HOSTNAME, CardDB::MYSQL_USER, CardDB::MYSQL_password, CardDB::MYSQL_DB);
    
    
    public $first_name;
    public $last_name;
    public $position
    public $business_name;
    public $business_address;
    public $business_website
    public $email;
    public $phone_number;
    
    public function __construct($first_name, $last_name, $position, $business_name, $business_address
        $business_website, $email, $phone_number){
        
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->postion = $position
        $this->business_name = $business_name;
        $this->business_address = $business_address;
        $this->business_website = $business_website
        $this->email = $email;
        $this->phone_number = $phone_number;
    }
    
    public function save_car() {
        
    }
    
    public function share_card() {
        
    }
    
    public function delete_card() {
        
    }
}




?>