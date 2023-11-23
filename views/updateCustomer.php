<?php
require_once('helpers.php');

$id = $_POST['cid'];
$name = $_POST['cname'];
$phone = $_POST['cphone'];
$address = $_POST['caddress'];
$email = $_POST['cemail'];
$company = $_POST['ccompany'];
$city = $_POST['ccity'];
$openingBalance = $_POST['opening_balance'];

$telephone = $_POST['telephone'];
$customer_no = $_POST['customer_no'];
$zip_code = $_POST['zip_code'];
$uid_no = $_POST['uid_no'];
$account_no = $_POST['account_no'];
$gst = $_POST['gst'];
$country = $_POST['country'];

$r = query("UPDATE customer 
Set 
    name='$name',
    email='$email',
    phone='$phone',
    address='$address',
    city='$city',
    telephone='$telephone',
    customer_no='$customer_no',
    zip_code='$zip_code',
    uid_no='$uid_no',
    account_no='$account_no',
    gst='$gst',
    country='$country',
    openingbalance='$openingBalance' 
where id='$id'");
if (!$r)
    echo 'false';
else
    echo 'true';

?>