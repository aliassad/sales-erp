<?php
include('helpers.php');

$id=$_POST['id'];


$result=query("delete from  vendorpayments  where id='$id'");

if($result)
    echo 'true';
else
    echo 'false';





?>