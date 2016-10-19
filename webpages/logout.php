<?php
require_once "utils.php";
session_start();
session_destroy();
session_start();
$_SESSION['alert'] = new Alert("You have successfully signed out", "success");
header("Location: index.php");