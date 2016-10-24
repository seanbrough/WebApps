<? php

$card = new Card($_POST["first_name"], $_POST["last_name"], $_POST["position_name"], $_POST["business_name"],
                 $_POST["business_address"], $_POST["city"], $_POST["state"], $_POST["zipcode"], $_POST["business_website"]
                 $_POST["email"], $_POST["phone_number"], $Session["$user_id"])
                 
Card::save_card();

if (Card::save_card() === TRUE) {
    header("Location: yourcards.php");
} else {
header("Location: create_card.php");
}
?>
