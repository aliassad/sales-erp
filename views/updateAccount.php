<?php

require_once('helpers.php');

$aid=$_POST["acc_id"];
$acode=$_POST["acc_code"];
$atype=$_POST["acc_type"];
$currency=$_POST["acc_currency"];
$obalance=$_POST["opbalance"];






$r=query("Update `account` Set `code`='$acode',`type`='$atype', `currency`='$currency',`openingbalance`='$obalance' where id='$aid'");
if($r)
echo 'true';
else echo 'false';


?>
