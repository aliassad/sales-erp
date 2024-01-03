<?php
include('helpers.php');

$n=$_POST['hname'];

$result=query("INSERT INTO `accounttypes` (`id`, `typename`) VALUES (NULL, '$n');");

if($result)
    echo 'true';
else
    echo 'false '.$n;


?>