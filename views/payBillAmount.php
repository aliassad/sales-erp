<?php
require_once('helpers.php');
$id = $_POST['bid'];
$balance = $_POST['balance'];
$paid = $_POST['paid'];
$date = $_POST['date'];

//$r = query("UPDATE bill SET pending='$balance' where id='$id';");
//if (!$r) {
//    echo 'false';
//}

$r = query("insert into `billamounts`(`bid`, `amount`, `date`)  values('$id','$paid',STR_TO_DATE('$date','%d-%m-%Y'));");

if ($r)
    echo 'true';
else
    echo 'false';

?>