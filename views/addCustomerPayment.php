<?php
require('helpers.php');

$customerId = $_POST["id"];


$detail = $_POST["detail"];
$amount = $_POST["amount"];
$type = $_POST["type"];
$date = $_POST["date"];

$result = query("insert into customerpayments (`cid`,`amount`,`ptype`,`pdetail`,`date`) values('$customerId','$amount','$type','$detail',STR_TO_DATE
    ('$date',
'%d-%m-%Y'));");

if (!$result)
    echo 'false';
else
    echo 'true';

?>