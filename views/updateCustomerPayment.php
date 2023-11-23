<?php
require_once('helpers.php');

$id=$_POST['id'];
$amount=$_POST['amount'];
$type=$_POST['type'];
$detail=$_POST['detail'];

$r=query("update customerpayments set amount='$amount',ptype='$type',pdetail='$detail' where id='$id';");
if(!$r)
    echo 'false';
else
    echo 'true';

?>