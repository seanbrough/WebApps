<?php
require_once "class_User.php";
require_once "utils.php";
session_start();


//check to see if user is logged in or not
if(isset($_SESSION['luser']))
{
     $user_logged_in = true;
     $luser = $_SESSION['luser'];
}else{
     $user_logged_in = false;
}
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="front_page.php">Carte de Visite</a>
        </div>
        <div class="navbar-collapse collapse">
        <?php
        if($user_logged_in):
        ?>
                <div class="navbar-right" >
        <a style="float:right" href="logout.php">sign out</a> 
        </div>
        <div class="navbar-right" >
             <h3 style="color:#999">Hello <a href="profile.php"><?=$luser->first_name ?></a></h3> 
        </div>

        <?php 
        else:
        ?>
          <form class="navbar-form navbar-right" role="form" action="login.php" method="post">
            <div class="form-group">
              <input name="email" type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
          <?php
          endif;
          ?>
        </div><!--/.navbar-collapse -->
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