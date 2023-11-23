<?php
include('helpers.php');

$n=$_POST['hname'];

$result=query("INSERT INTO ` `.`vendortype` (`id`, `name`) VALUES (NULL, '$n');");

if($result)
    echo 'true';
else
    echo 'false '.$n;


?>