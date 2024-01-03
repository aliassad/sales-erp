

<?php 
require_once('helpers.php');


$tid=$_POST['id'];
$dis=$_POST['dis'];
$paid=$_POST['paid'];
$recieved=$_POST['recieved'];

$r=query("update accounttransaction set discription='$dis',debit='$recieved',credit='$paid' where id='$tid';");
if(!$r)
echo 'false';
else
echo 'true';
?>