<?php
require_once('helpers.php');


$id=$_POST["vid"];
$name=$_POST["vname"];
$phone=$_POST["vphone"];
$email=$_POST["vemail"];
$address=$_POST["vaddress"];
$company=$_POST["vcompany"];
$openingbalance=$_POST["vopening_balance"];
$city=$_POST["vcity"];
$country=$_POST["vcountry"];
$vendor_no=$_POST["vvendor_no"];
$zip_code=$_POST["vzip_code"];
$uid_no=$_POST["vuid_no"];
$account_no=$_POST["vaccount_no"];
$gst=$_POST["vgst"];

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

$r=query("UPDATE `vendor` SET `name`='$name',`address`='$address', `phone`='$phone',`email`='$email',`companyname`='$company',
`img`='$path',`openingbalance`='$openingbalance',
                    `city`='$city',
                    `vendor_no`='$vendor_no',
                    `country`='$country',
                    `zip_code`='$zip_code',
                    `uid_no`='$uid_no',
                    `gst`='$gst',
                    `account_no`='$account_no'
where id='$id'");
if($r)
echo 'true';
else echo 'false';


?>
