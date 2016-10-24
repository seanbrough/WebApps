<?php
require_once "handlers/class.php";
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
</html>

<html lang="en" >

    <head>

        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/dashboard.css">
    </head>

   <body>
          <div class = "jumbotron">
          </div>
          <h1> Enjoy your Business Cards!</h1>
          <div class = "icon"></div>
          <img id = "icon_create" src = "css/create.png">
          <img id = "icon_manage" src = "css/manage.png">
          <img id = "icon_share" src = "css/share.png">
          <div class = "container">
              <p><a class="button" id = "create" role="button" href="create_card.php">Create a new Card</a></p>
              <p><a class="button" id = "manage" role="button" href="yourcards.php">Manage Your Cards</a></p>
              <p><a class="button" id = "share" role="button" href="your_Rolodex.php">Shared Cards</a></p>
         </div>
   </body>
</html>
