<?php

require_once('helpers.php');

$name=$_POST["vname"];
$nic=$_POST["vnic"];
$phone=$_POST["vphone"];
$email=$_POST["vemail"];
$company=$_POST["vcompany"];
$city=$_POST["vcity"];
$address=$_POST["vaddress"];
$opening_balance=$_POST["vopening_balance"];

$add=true;
$path="";


if($_FILES["eimage"]["name"])
{
$imagepath = "../img/" . $_FILES["eimage"]["name"];
if(file_exists($imagepath))
{ 
echo 'false'.$_FILES["eimage"]["name"];  
$add=false;
} 
else
{   
$path = "img/".$_FILES["eimage"]["name"];
move_uploaded_file($_FILES["eimage"]["tmp_name"], $imagepath);
}
}

if($add)
{
$r=query("INSERT INTO `vendor` (`id`, `name`, `nic`, `address`,`phone`,`email`,`img`,`companyname`,`openingbalance`,`city`) VALUES (NULL,'$name',
'$nic',
'$address','$phone','$email','$path','$company','$opening_balance','$city');");
if($r)
echo 'true';
else echo 'false';
}

?>
