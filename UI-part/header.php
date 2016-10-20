<?php
require_once "class.php";
session_start();

if(isset($_SESSION['luser']))
{
     $user_logged_in = true;
     $luser = $_SESSION['luser'];
}else{
     $user_logged_in = false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/header.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
      

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
    <div class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
         
          <a class="navbar-brand">Business Vcard</a>
        </div>
        <div class="navbar-collapse collapse">
        <?php
        if($user_logged_in):
        ?>
                <div class="navbar-right" >
        <a style="float:right" href="logout.php">sign out</a> 
        </div>
        <div class="navbar-right" >
             <h3 style="color:#ffffff">Hello <?=$luser->email?></h3> 
        </div>

          <?php
          endif;
          ?>
        </div>
      </div>
    </div>
    
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