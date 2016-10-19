<?php
require_once "utils.php";
require_once "class_User.php";
session_start();

/*
 *Handle the post from register.php
 *If the registration is successful, set an alert with severity success and redirect to index.php
 *If the registration is unsuccessful, set an alert with severity warning with a helpful message and 
 *redirect them back to register.php.
*/
if ($_POST && isset($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"])) {
    $mysqli = new mysqli(CardDB::MYSQL_HOSTNAME, CardDB::MYSQL_USER, CardDB::MYSQL_password, CardDB::MYSQL_DB);
    $first_name = mysqli_real_escape_string($mysqli, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($mysqli, $_POST["last_name"]);
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);
    
    $user_object = new User($first_name, $last_name, $email);
    $user_object->set_password($password);
    $user_save = $user_object->save();
    
    if ($user_save['success'] == true) {
        $message = $user_save['message'];
        $_SESSION['alert'] = new Alert($message, "success");
        header("Location: front_page.php");
    }
    else {
        $message = $user_save['message'];
        $_SESSION['alert'] = new Alert($message, "danger");
        header("Location: registration.php");
    }

}
else {
    $_SESSION['alert'] = new Alert("Registration unsuccessful; Try again", "warning");
    header("Location: registration.php");
}
?>