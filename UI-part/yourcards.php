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
echo '<a class = "share_button" href="dashboard.php">Back to Dashboard</a>';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $shared_cards = card::get_cards_by_user($user_id);
    
    if (isset($shared_cards)) {
        foreach ($shared_cards as $card) {
        echo 
            '<div class = "box">
                <div class = "card">
                   <div class = "main_info">
                         <h2 id = "name"> '.$card['first_name'].' '.$card['last_name'].'</h2>
                        <p id = "position">'.$card['title'].'</p>
                        <p id = "phone_number">'.$card['phone'].'</p>
                    </div>
                    
                    <p id = "business_name"> '.$card['company_name'].'</p>
                    
                    <div class = "contact">
                    <p id = "business_website">'.$card['website'].'</p>
                  
                    <p id = "email" href="mailto:'.$card['email'].'">'.$card['email'].'</p>
                    
                    
                    </div>
    
                </div>
            <form action = "./handlers/yourCards_Handler.php" method = "POST" id = "submit">
                <input name = "card_id" type = "hidden" value = '.$card['id'].'>
                <button class = "share_button"  type = "submit" onclick="shareCard()">Share It</button>
                <br style="clear:both;">
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
