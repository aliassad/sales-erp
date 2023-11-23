<?php

require_once('helpers.php');

$qty=$_POST['qty'];
$dis=$_POST['dis'];
$rate=$_POST['rate'];
$vid=$_POST['vid'];
$pid=$_POST['pid'];

$result=query("INSERT INTO ` `.`vendorpurchase` (`id`,`pid`, `dis`, `qty`, `rate`, `vid`, `date`) VALUES (NULL, '$pid','$dis','$qty','$rate','$vid',now());");

if($result)
    echo mysqli_insert_id();
else echo 'false';




?>