<?php

require_once "handlers/class_card.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Your Cards</title>
<link rel="stylesheet" type="text/css" href="css/yourcards.css">
</head>

<body>
<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $shared_cards = card::get_cards_by_id($user_id);
    
    if (isset($shared_cards)) {
        foreach ($shared_cards as $value) {
        $card = $value;
        echo 
            '<div class = "card">
            <span class="main_info">
            <h2 id = "name">Name: '.$card['first_name'].' '.$card['last_name'].'</h2><br>
            <h3 id = "position">Position:'.$card['position'].'</h3><br>
            <h3 id = "business_name">Company: '.$card['business_name'].'</h3><br>
            <h3 id = "business_address">Address:'.$card['business_address'].'</h3><br>
            </span>
            <p class = "contact">
            <a id = "business_website" href="'.$card['business_website'].'">'.$user -> id.'</a><br>
            <br>
            <a id = "email" href="mailto:'.$card['email'].'">'.$card['email'].'</a><br>
            <br>
            <a id = "phone_number">'.$cars['phone_number'].'</a></p>
            <br>
            <button id = "share_button" onclick="shareCard()">Share</button>
            <input name = "share_email" type = "hidden" action = "handler/class_card.php" method = "POST">
            </div>';
             
        }
    }
    else {
        echo '<h1 id = "no_cards_here">You currently do not have any cards</h1></br>';
        echo '<button id = "create_first_card", href="create_card.php">Click here to create your first card!</h1>';
        
    }
    
}
?>



</body>

</html>
