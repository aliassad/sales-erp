<?php
require("helpers.php");


$data = array();
$opening_balance = 0;
$amountReceived = 0;
$MoreCharge = 0;
$customers = query("select * from customer");
while ($customer = mysqli_fetch_array($customers)) {
    $opening_balance = ($customer['openingbalance']);
    $id = $customer['id'];


    $receivedAmounts = query("select sum(amount) as amountReceived from customerpayments where cid='$id' and ptype='Credit'");
    while ($row = mysqli_fetch_array($receivedAmounts)) {
        $amountReceived = ($row['amountReceived']);
    }
    $moreAmountCharged = query("select sum(amount) as MoreCharge from customerpayments where cid='$id' and ptype='Debit'");
    while ($row = mysqli_fetch_array($moreAmountCharged)) {
        $MoreCharge = ($row['MoreCharge']);
    }


    $billAmounts = query("Select (SELECT sum(ba.amount) from billamounts ba,bill b WHERE ba.bid=b.id and b.cid='$id' ) tpaid,sum(amount-discount) tamount  from bill b where b.type='Invoice' and b.cid='$id'");
    if ($billAmounts) {
        while ($row = mysqli_fetch_array($billAmounts)) {
            $tamount = ($row['tamount']);
            $tpaid = ($row['tpaid']);

        }
        $tbalance = $tamount - $tpaid + $opening_balance - $amountReceived + $MoreCharge;

    } else {
        $tamount = 0;
        $tpaid = 0;
        $tbalance = 0;
    }

    $row_data = array(
        'id' => $customer['id'],
        'name' => $customer['name'],
        'email' => $customer['email'],
        'phone' => $customer['phone'],
        'address' => $customer['address'],
        'company' => $customer['company'],
        'city' => $customer['city'],
        'total_balance' => $tbalance,
        'country' => $customer['country'],
        'zip_code' => $customer['zip_code'],
        'customer_no' => $customer['customer_no'],
        'uid_no' => $customer['uid_no'],
        'account_no' => $customer['account_no'],
        'gst' => $customer['gst'],
        'telephone' => $customer['telephone'],
    );
    array_push($data, $row_data);


}


 echo json_encode($data);

?>