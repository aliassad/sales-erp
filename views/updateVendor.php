<?php
require_once('helpers.php');


$id=$_POST["eaid"];
$name=$_POST["name"];
$nic=$_POST["nic"];;
$phone=$_POST["phone"];
$email=$_POST["email"];
$address=$_POST["address"];
$company=$_POST["company"];
$openingbalance=$_POST["opening_balance"];
$city=$_POST["city"];

$path="";

$r=query("select img from vendor where id='$id';");
while($row=mysqli_fetch_array($r))
{
 $path=$row['img'];
}

if($_FILES["uimage"]["name"])
{ 
  if($path){ $newpath="../".$path;
  if (file_exists($newpath)) {
    unlink($newpath);
  }  
           }
$imagepath = "../img/" . $_FILES["uimage"]["name"];
$path = "img/".$_FILES["uimage"]["name"];
move_uploaded_file($_FILES["uimage"]["tmp_name"],$imagepath);
}

$r=query("UPDATE `vendor` SET `name`='$name',`nic`='$nic',`address`='$address', `phone`='$phone',`email`='$email',`companyname`='$company',
`img`='$path',`openingbalance`='$openingbalance',`city`='$city' where id='$id'");
if($r)
echo 'true';
else echo 'false';


?>
