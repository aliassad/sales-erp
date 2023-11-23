<?php
session_start();
date_default_timezone_set('Asia/Karachi');
require_once("views/helpers.php");


if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
$page="home";
}



if(!isset($_SESSION['id']))
{
    header("Location:loginPage.php");
}


render("header");
render($page);
render("footer");

?>
