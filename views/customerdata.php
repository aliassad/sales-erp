<?php
require("helpers.php");
 $name=$_POST['name'];

$result=query("Select name,phone,address FROM customer where concat(id,': ',name)='$name'");
while($row=mysqli_fetch_array($result)){
echo   '<tr><td class="nocenter" ><i class="fa fa-user"></i>&nbsp<b>Name:</b> '.$row['name'].'</td></tr><tr><td class="nocenter" ><i class="fa fa-phone"></i>&nbsp<b>Phone:</b> '.$row['phone'].'</td></tr><tr><td class="nocenter" ><i class="fa fa-book"></i>&nbsp<b>Address:</b> '.$row['address'].'</td></tr></td></tr>';
}

?>