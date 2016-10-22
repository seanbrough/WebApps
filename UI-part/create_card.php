<?php
require_once "header.php";
//Form to allow users to create new cards
//Send form to class_card to create object and save to DB
?>
<!DOCTYPE html>
<html lang="en" >

    <head>

        <meta charset="utf-8">
        <title>Create Your Cards</title>
        <link rel="stylesheet" href="css/create_card.css">
    </head>

    <body>
<div class="page_container">
<h2>Create a new card</h2>
    <form method="post" action="../webpages/class_card.php" class = "Info">
        <div class="left">
        <p class = "label">First Name: <br>
        <input type="text" class = "input" name="first_name"></p>
        <br>
        <p class = "label">Last Name: <br>
        <input type="text" class = "input" name="last_name"></p>
        <br>
        <p class = "label"> Position: <br>
        <input type="text" class = "input" name="position"></p>
        <br>
        <p class = "label">Business Name: <br>
        <input type="text" class = "input" name="business_name"></p>
        </div>
        
        <div class="right">
        <p class = "label">Business Address: <br>
        <input type="text" class = "input" name="business_address"></p>
        <br>
        <p class = "label">Business Website: <br>
        <input type="text" class = "input" name="business_website"></p>
        <br>
        <p class = "label">Email: <br>
        <input type="text" class = "input" name="email"></p>
        <br>
        <p class = "label">Phone Number: <br>
        <input type="text" class = "input"  name="phone_number"></p>
        <br>
        </div>
        <input type="submit" class = "button" value="Submit">
    </form>
    <div>
     <hr>
      <footer>
        <p>&copy; Business Vcard 2016</p>
        <p> Group: Web App Project</p>
      </footer>
      </div>
</div>
</html>
