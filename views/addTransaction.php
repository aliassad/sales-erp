<?php
require('helpers.php');

$aid=$_POST['aid'];

$dis=$_POST['dis'];
$debit=$_POST['debit'];
$credit=$_POST['credit'];
$tdate=$_POST['tdate'];

$result=query("INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES (NULL, '$aid', '$dis', '$debit','$credit',STR_TO_DATE('$tdate','%d-%m-%Y'));");

$iid=0;

$result=query("Select max(id) as id from `accounttransaction`;");
while($row=mysqli_fetch_array($result))
{
    $iid=$row['id'];
}

if($result)
    echo $iid;
else
    echo 'false';







?>