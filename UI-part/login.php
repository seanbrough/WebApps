<?php
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="en" >

    <head>

        <meta charset="utf-8">
        <title>Log in</title>
        <link rel="stylesheet" href="css/login.css">
    </head>

    <body>
    	     
    	      <h1>  Welcome to design your own business vcards!</h1>
    	      
    	      
    	      <div id = "intro" style="float:left;width:800px">
    	          <h2>Vcard</h2>
    	          <h3>vCard is a file format standard for electronic business cards. 
    	               vCards are often attached to e-mail messages, but can be exchanged in other ways,
    	               such as on the World Wide Web or instant messaging. They can contain name and address information, 
    	               telephone numbers, e-mail addresses, URLs, logos, photographs, and audio clips.
    	          </h3>
    	      </div>
    	      
    	      
    	       <div id="wrapper" class = container>
                              <form  action="handlers/login_handler.php" id="login" method = "POST"> 
                                <h1>Log in</h1> 
                                    <label for="email" class="label"> Your Email Address  </label>
                                    <input id="email" name="email" class = "input" type="text" placeholder="Enter Your Email"/>
                                    <br>
                                    <label for="password" class="label"> Your password </label>
                                    <input id="password" name="password" class = "input" type="password" placeholder="Enter the password" /> 
                                   <?php
                                     if(($_SESSION['alert']->$severity !== "Success")){
                                         print_r($_SESSION['alert']->$message);
                                     }
                                    
                                     ?>
                                <p class="button"> 
                                    <input type="submit" id = "log_in" name = "login" value="Log in" /> 
                                    <input type="submit" id = "sign_up" name = "signup" value="Sign Up!" /> 
                            
								</p>
                                
						
                            </form>
                    </div>
  
  
 </body>
 </html>
