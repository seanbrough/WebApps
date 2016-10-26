// <?php
require "class_card.php";
session_start();

card::share_card($_POST['share_email'], $_POST['card_id'], $_SESSION['user_id'] );

// ?>