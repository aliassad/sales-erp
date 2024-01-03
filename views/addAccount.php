<?php

require_once('helpers.php');

$acode=$_POST["acc_code"];
$atype=$_POST["acc_type"];
$currency=$_POST["acc_currency"];
$obalance=$_POST["openingbalance"];



$r=query("INSERT INTO `account` (`id`, `code`, `type`, `currency`,`openingbalance`) VALUES (NULL, '$acode', '$atype', '$currency','$obalance');");
if($r)
echo 'true';
else echo 'false';


?>
