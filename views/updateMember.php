<?php
require_once('helpers.php');

$id=$_POST['cid'];
$name=$_POST['cname'];
$phone=$_POST['cphone'];
$address=$_POST['caddress'];
$email=$_POST['cemail'];

$r=query("UPDATE member Set name='$name',cardno='$email',phone='$phone',address='$address' where id='$id'");
if(!$r)
    echo 'false';
else
    echo 'true';

?>