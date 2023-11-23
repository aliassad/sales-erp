<?php
require("helpers.php");

$data = array();
$vendors = query("SELECT * FROM `vendor`");

while ($vendor = mysqli_fetch_array($vendors)) {

    $openingBalance = $vendor['openingbalance'];
    $id = $vendor['id'];


    $vendorPurchase = query("SELECT sum(qty*rate) as payment FROM `vendorpurchase` vp WHERE vp.vp='$id'");

    if ($vendorPurchase) {
        while ($row = mysqli_fetch_array($vendorPurchase)) {

            $total = $row['payment'];

        }
    }


    $vendorPayments = query("Select sum(vp.amount) amount  FROM `vendorpayments` vp WHERE  vp.vid='$id' and vp.ptype='Debit'");
    if ($vendorPayments) {
        while ($row = mysqli_fetch_array($vendorPayments)) {
            $paid = round($row['amount']);
        }
    }

    $vendorPaymentCredit = query("Select sum(vp.amount) amount  FROM `vendorpayments` vp WHERE  vp.vid='$id' and vp.ptype='Credit'");
    if ($vendorPaymentCredit) {
        while ($row = mysqli_fetch_array($vendorPaymentCredit)) {
            $incentive = round($row['amount']);
        }
    }


    $total = $total - $paid + $incentive + $openingBalance;

    $row_data = array(
        'id' => $vendor['id'],
        'name' => $vendor['name'],
        'phone' => $vendor['phone'],
        'address' => $vendor['address'],
        'email' => $vendor['email'],
        'cname' => $vendor['companyname'],
        'city' => $vendor['city'],
        'country' => $vendor['country'],
        'zip_code' => $vendor['zip_code'],
        'uid_no' => $vendor['uid_no'],
        'account_no' => $vendor['account_no'],
        'gst' => $vendor['gst'],
        'vendor_no' => $vendor['vendor_no'],
        'payment' => round($total)
    );
    array_push($data, $row_data);


}
echo json_encode($data);


?>