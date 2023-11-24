<?php
require('helpers.php');

$vendorId = $_POST["vid"];
$detail = $_POST["detail"];
$amount = $_POST["amount"];
$type = $_POST["type"];
$date = $_POST["date"];

$result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','$type','$detail',STR_TO_DATE('$date','%d-%m-%Y'));");

if (!$result)
    echo 'false';
else
    echo "true";


?>