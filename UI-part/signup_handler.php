
<?php
require_once "class.php";
     
$mysqli = new mysqli("localhost", "admin", "admin", "vcard");
        if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: " .$mysqli->connect_error;
        }else{
                echo "Success!";
                }

$email = $mysqli->real_escape_string($_POST['email']);
$pw =  $mysqli->real_escape_string($_POST['password']);
$confirm =  $mysqli->real_escape_string($_POST['Confirm_password']);

session_start();
$_SESSION['account']= array();
$_SESSION['account']= new Account($email);

if($pw == null){
             $_SESSION['account']->pw_hash = null;
}elseif($pw !== null && $pw !== $confirm){
            $_SESSION['account']->pw_hash = "wrong";
}else{
      $_SESSION['account'] -> set_password($pw);
} 


$suc = array();
$suc = $_SESSION['account']->save();

print_r($suc);
if($suc['success'] == true){
      $_SESSION['alert'] = new Alert("Congratulations and Welcome!", "succuss");
    header("Location: login.php");
}else{
    
     $_SESSION['alert'] = new Alert("Your registration are failed", "Warning");
    header("Location: signup.php");
}
?>


