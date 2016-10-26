<?php

require_once "handlers/class_card.php";

?>
<!DOCTYPE html>
<html>
<head>
<script type = "text/javascript", src = "utils.js"></script>
<title>Your Cards</title>
<link rel="stylesheet" type="text/css" href="css/yourcards.css">
</head>

<body>
<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $shared_cards = card::get_cards_by_user($user_id);
    
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
            
            <form action = "./handlers/sharedCard_Handler.php" method = "POST">
                <input name = "share_email" id = "share_email" type = "hidden">
                <input name = "card_id" type = "hidden" value = '.$card['id'].'>
                <button id = "share_button" type = "submit" onclick="shareCard()">Share</button>
            </form>
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
