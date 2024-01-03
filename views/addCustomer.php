<?php
require('helpers.php');
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$company = $_POST["company"];
$city = $_POST["city"];
$openingBalance = $_POST["opening_balance"];
$country = $_POST["country"];
$zip_code = $_POST["zip_code"];
$uid_no = $_POST["uid_no"];
$account_number = $_POST["account_number"];
$gst = $_POST["gst"];
$telephone = $_POST["telephone"];
$customer_number = $_POST["customer_number"];


$sql = "insert into customer(id,name,email,phone,address,openingbalance,city,company,country,zip_code,uid_no,account_no,gst,telephone,customer_no) 
values(NULL,'$name','$email','$phone','$address','$openingBalance','$city','$company','$country','$zip_code','$uid_no','$account_number','$gst','$telephone','$customer_number');";
// SQL query
$q = query($sql);

if ($q) {
    echo "true";
} else {
    echo "false";
}
?>