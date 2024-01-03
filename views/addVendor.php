<?php

require_once('helpers.php');

$name = $_POST["vname"];
$phone = $_POST["vphone"];
$email = $_POST["vemail"];
$company = $_POST["vcompany"];
$city = $_POST["vcity"];
$address = $_POST["vaddress"];
$opening_balance = $_POST["vopening_balance"];

$vendor_no = $_POST["vvendor_no"];
$country = $_POST["vcountry"];
$zip_code = $_POST["vzip_code"];
$uid_no = $_POST["vuid_no"];
$account_no = $_POST["vaccount_no"];
$gst = $_POST["vgst"];

$add = true;
$path = "";


if ($_FILES["eimage"]["name"]) {
    $imagepath = "../img/" . $_FILES["eimage"]["name"];
    if (file_exists($imagepath)) {
        echo 'false' . $_FILES["eimage"]["name"];
        $add = false;
    } else {
        $path = "img/" . $_FILES["eimage"]["name"];
        move_uploaded_file($_FILES["eimage"]["tmp_name"], $imagepath);
    }
}

if ($add) {
    $r = query("INSERT INTO 
    `vendor` (`id`, `name`, `address`,`phone`,`email`,`img`,`companyname`,`openingbalance`,
              `city`,
              `vendor_no`,
              `country`,
              `zip_code`,
              `uid_no`,
              `account_no`,
              `gst`
              ) 
    VALUES (NULL,'$name',
            '$address',
            '$phone',
            '$email',
            '$path',
            '$company',
            '$opening_balance',
            '$city',
            '$vendor_no',
            '$country',
            '$zip_code',
            '$uid_no',
            '$account_no',
            '$gst'
            );");
    if ($r)
        echo 'true';
    else echo 'false';
}

?>
