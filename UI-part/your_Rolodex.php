<?php

require_once "class_card.php";
require_once "header.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Your Rolodex</title>
<link rel="stylesheet" type="text/css" href="static/style.css">
</head>

<body>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $shared_cards = card::get_shared_cards($user_id);
    
    if (isset($shared_cards)) {

        foreach ($shared_cards as $value) {
                $card = $value;
                echo 
                    '<div class = "card">
                    <h1 id = "name">'.$card['first_name'].' '.$card['last_name'].'</h2><br>
                    <h2 id = "position>'.$card['position'].'</h2><br>
                    <h2 id = "business_name">'.$card['position'].'</h2><br>
                    <h3 id = "business_address">'.$card['business_address'].'</h3><br>
                    <a id = "business_website" href="'.$card['business_website'].'">'.$user -> id.'</a><br>
                    <a id = "email" href="mailto:'.$card['email'].'">'.$card['email'].'</a><br>
                    <h3 id = "phone_number">'.$cars -> phone_number.'</h3>
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