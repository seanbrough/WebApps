<?php
require_once "header.php";

if(isset($_GET['id']))
{
     $user_id = intval($_GET['id']);
     $user = User::get_user_by_id($user_id);
     if($user === null){
     $_SESSION['alert'] = new Alert("User with id $user_id not found");
     header("Location: front_page.php");
     }
}
elseif(isset($_SESSION['luser']))
{
     $user = $_SESSION['luser'];
     // print_r($user);
     // die();
}
else//no user to display
{
     $_SESSION['alert'] = new Alert("Could not display user");
     header("Location: front_page.php");
}

?>


    <div class="jumbotron">
      <div class="container">
        <h1>Welcome <?php echo $user->first_name ?> </h1>
        <h2>Pick where you want to go!</h2>
        <p>Build, distribute, and view digital business cards</p>
        <p><a class="btn btn-primary btn-lg" role="button" href="share.php">Share a card with a friend! &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>View Your Cards</h2>
          <p>View, edit, sort, remove, and send your cards</p>
          <p><a class="btn btn-default" href="yourcards.php" role="button">View Cards &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>View your Rolodex</h2>
          <p>View, sort, and delete cards in your Rolodex</p>
          <p><a class="btn btn-default" href="your_Rolodex.php" role="button">View Rolodex &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Create a new card</h2>
          <p>Create a new cards to send to clients, customers, and connections</p>
          <p><a class="btn btn-default" href="create_card.php" role="button">New Card &raquo;</a></p>
        </div>
      </div>


    </div> <!-- /container -->   

<?php
require_once "footer.php";
?>