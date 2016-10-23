<?php

require_once "class_card.php";
require_once "header.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Your Roladex</title>
<link rel="stylesheet" type="text/css" href="static/style.css">
</head>

<body>
<?php

$user_cards = get_cards_by_id($user_id);

foreach ($user_cards as $value) 
        {
        $card = $value;
        echo 
            '<div class = "card">
            <h1 id = "name">'.$card -> first_name.' '.$card -> last_name.'</h2><br>
            <h2 id = "position>'.$card -> position.'</h2><br>
            <h2 id = "business_name">'.$card -> business_name.'</h2><br>
            <h3 id = "business_address">'.$card -> business_address.'</h3><br>
            <a id = "business_website" href="'.$card -> business_website.'">'.$user -> id.'</a><br>
            <a id = "email" href="mailto:'.$card -> email.'">'.$card -> email.'</a><br>
            <h3 id = "phone_number">'.$cars -> phone_number.'</h3><br>
            <button id = "share_button" onclick="shareCard()">Share Card</button>
            <input id = "share_email" type = "hidden">
            </div>';
        }
?>
</body>

</html>