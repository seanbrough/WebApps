<?php
require_once "header.php";

//handle the form post here
//create your form below. <form> tags already there for you...
?>
<head>
    <script type="text/javascript" src="validate_pw.js"></script>
</head>
<div class="container">
<h2>Create A New Account</h2>
<div style="width:500px">
    <form method="post" action="registration_handler.php">
        First Name: <br>
        <input type="text" name="first_name">
        <br>
        Last Name: <br>
        <input type="text" name="last_name">
        <br>
        Email: <br>
        <input type="text" name="email" required>
        <br>
        Password: <br>
        <input type="password" name="first_password" id="password" required>
        <br>
        Confirm Password: <br>
        <input type="password" name="password" id="confirm_password" required>
        <br>
        <br>
        <input type="submit" onclick="validatePassword();" value="Submit">
    </form>
</div>
<?php
require_once "footer.php";
?>