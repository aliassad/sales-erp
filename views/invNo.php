<?php
require_once("helpers.php");



$result=query("select  max(id) from bill");
if($result)
{
while($row=mysqli_fetch_array($result))
{
echo $row['max(id)']+1;
}
}
?>