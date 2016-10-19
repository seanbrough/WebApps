<?php
require_once "utils.php";
require_once "class_User.php";
session_start();

$mysqli = new mysqli(CardDB::MYSQL_HOSTNAME, CardDB::MYSQL_USER, CardDB::MYSQL_password, CardDB::MYSQL_DB);
        
if($mysqli->connect_error){
     $_SESSION['alert'] = new Alert($mysqli->connect_error, 'danger');
     header("Location: index.php");
}
//blah
if ($_POST && isset($_POST['email'], $_POST['password'])) {
     
     $email = mysqli_real_escape_string($mysqli, $_POST['email']);
     $password = mysqli_real_escape_string($mysqli, $_POST['password']);
     
     $password_hash = hash('ripemd128', CardDB::PW_SALT.$password);
     $query = "SELECT * FROM user WHERE email = '$email'";
     $results = $mysqli->query($query);
     $result_array = mysqli_fetch_assoc($results);
     if (isset($result_array['email'])) {
          if ($password_hash == $result_array['password']) {
               $_SESSION['luser'] = User::get_user_by_id($result_array['id']);
               $_SESSION['alert'] = new Alert("Login Successful!", "success");
               header("Location: dashboard.php");
          }
          else {
               $_SESSION['alert'] = new Alert("Password incorrect", "warning");
               header("Location: front_page.php");
          }
     }
     else {
          $_SESSION['alert'] = new Alert("No users match that email address ".$result_array, "warning");
          header("Location: front_page.php");
     }
}