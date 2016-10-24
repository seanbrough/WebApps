<?php
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="css/signup.css">
</head>
<body>
  <form class="sign-up" action="handlers/signup_handler.php" method="POST" onsubmit="return validate_reg_form(this)">
    <h1 class="sign-up-title">Sign up to own your business vcards</h1>
    <label for="email" class = "label">Email Address</label>
    <input type="text" class="sign-up-input" id = "inputEmail" name = "email" placeholder="Please Enter your email" >
    <br>
    <label for="password" class = "label">Password</label>
    <input type="password" class="sign-up-input" id = "inputPassword" name = "password" placeholder="Enter a password">
    <br>
    <label for="Confirm_password" class = "label">Confirm Password</label>
    <input type="password" class="sign-up-input" id = "inputConfirmPassword" name = "Confirm_password" placeholder="Confirm the password">
    <br>
    <input type="submit" value="Sign up!" class="sign-up-button">
    <?php

if(isset($_SESSION['alert'])){
         $alert = $_SESSION['alert'];
         $dismissable = $alert->dismissable ? " alert-dismissible" : "";
         $severity = " alert-".$alert->severity;
         $strong = strtoupper($alert->severity)."!";
echo <<<END
<div class="alert $severity$dismissable" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>$strong </strong> $alert->message
</div>
END;
     unset($_SESSION['alert']);
     }

?>
    <div class="about">
     <hr>
      <footer>
        <p>&copy; Business Vcard 2016</p>
        <p> Group: Web App Project</p>
      </footer>
      </div>
  </form>

   
</body>
</html>
