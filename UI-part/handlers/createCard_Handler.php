<?php
require_once "class_card.php";
session_start();

$card = new Card($_POST["first_name"], $_POST["last_name"], $_POST["position"], $_POST["business_name"],
                 $_POST["business_address"], $_POST["city"], $_POST["state"], $_POST["zipcode"], $_POST["business_website"],
                 $_POST["email"], $_POST["phone_number"], $_SESSION["user_id"]);
                 
$save_card = $card->save_card();

if ($save_card === TRUE) {
    header("Location: ../yourcards.php");
} else {
header("Location: ../create_card.php");
}
?>
