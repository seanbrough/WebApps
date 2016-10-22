<?php
require_once "header.php";

//Form to allow users to create new cards
//Send form to class_card to create object and save to DB
?>
<div class="container">
<h2>Create a new card</h2>
<div style="width:500px">
    <form method="post" action="../webpages/class_card.php">
        First Name: <br>
        <input type="text" name="first_name">
        <br>
        Last Name: <br>
        <input type="text" name="last_name">
        <br>
        Position: <br>
        <input type="text" name="position">
        <br>
        Business Name: <br>
        <input type="text" name="business_name">
        <br>
        Business Address: <br>
        <input type="text" name="business_address">
        <br>
        Business Website: <br>
        <input type="text" name="business_website">
        <br>
        Email: <br>
        <input type="text" name="email">
        <br>
        Phone Number: <br>
        <input type="text" name="phone_number">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
<?php
require_once "footer.php";
?>