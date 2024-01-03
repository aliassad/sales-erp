<?php
require_once('helpers.php');


$cid=$_POST['cid'];
$r=query("select sum(b.pending) balance from bill b where b.cid='$cid' and b.type='Invoice'");
if(!$r)
echo '0';
else
{

while($row=mysqli_fetch_array($r))
{
    $balance=$row['balance'];

}



echo $balance;

}
?>
