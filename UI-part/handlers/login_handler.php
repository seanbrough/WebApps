<?php
require_once "class.php";


$mysqli = new mysqli(Vcard::MYSQL_HOSTNAME, Vcard::MYSQL_USER, Vcard::MYSQL_password, Vcard::MYSQL_DB);

if($mysqli->connect_error){//bad connection, just return null
     $_SESSION['alert'] = new alert($mysqli->connect_error, 'danger');
     header("Location: ../login.php");
}else{
       //echo "success";
}
if(isset($_POST['signup'])){
    header("Location: signup.php");
}
session_start();
if(isset($_POST['login'])){
        $email = $mysqli->real_escape_string($_POST['email']);
        $pw = $mysqli->real_escape_string($_POST['password']);
        $query = "SELECT * FROM user WHERE email = '$email'";
        $res = $mysqli->query($query);
        $row = $res->fetch_assoc();
        if($email!== $row['email']){
                $_SESSION['alert'] = new Alert("Your username does not exist", "Warning");
                header("Location: ../login.php");
                 }
        if($email === $row['email']){
             if(hash('ripemd128', Vcard::PW_SALT.$pw) === $row['password']){
             $_SESSION['luser'] = Account::get_user_by_id($row['id']);
             $_SESSION['user_id'] = $row['id'];
             $_SESSION['alert'] = new Alert("Welcome", "Success");
             header("Location: ../dashboard.php");
       }else{
             $_SESSION['alert'] = new Alert("Your password is wrong", "Warning");
           header("Location: ../login.php");
       }
     
     
    }  
}
print_r($_SESSION['alert']);
?>  
