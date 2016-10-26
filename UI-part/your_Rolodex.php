<?php

require_once "handlers/class_card.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Your Rolodex</title>
<link rel="stylesheet" type="text/css" href="css/yourcards.css">
</head>

<body>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $shared_cards = card::get_shared_cards($user_id);
    
    if (isset($shared_cards)) {

        foreach ($shared_cards as $card) {
                echo 
                '<div class = "card">
                <span class="main_info">
                <h2 id = "name">Name: '.$card['first_name'].' '.$card['last_name'].'</h2><br>
                <p id = "position">Position:'.$card['title'].'</p><br>
                <p id = "business_name">Company: '.$card['company_name'].'</p><br>
                <p id = "business_address">Address:'.$card['company_addr'].'</p><br>
                </span>
                <p class = "contact">
                <a id = "business_website" href="'.$card['website'].'">'.$user -> id.'</a><br>
                <br>
                <a id = "email" href="mailto:'.$card['email'].'">'.$card['email'].'</a><br>
                <br>
                <a id = "phone_number">'.$card['phone'].'</a></p>
                <br>
                </div>';
                }
    }
    else {
        echo '<h1 id = "no_cards">You currently have no cards shared to your account</h1>';
    }
}


?>
</body>

</html>
