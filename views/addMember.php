<?php
require('helpers.php');
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$address=$_POST["address"];



$sql="insert into member(id,name,cardno,phone,address) values(NULL,'$name','$email','$phone','$address');";
// SQL query
$q=query($sql);
if($q){
    echo "true";
}
else{ echo "false";
}
?>