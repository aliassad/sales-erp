<?php
require_once("helpers.php");

// Retrieving values from the POST request
$type = $_POST['type'];
$notes = $_POST['notes'];
$customer = $_POST['customer'];
$customer_phone = $_POST['customer_phone'];
$customer_street = $_POST['customer_street'];
$customer_post = $_POST['customer_post'];
$customer_city = $_POST['customer_city'];
$duedate = $_POST['duedate'];
$bdate = $_POST['bdate'];
$pTableData = $_POST['pTableData'];
$total = $_POST['total'];
$gst = $_POST['gst'];
$paid = $_POST['paid'] *1 ? $_POST['paid'] : 0;;
$discount = $_POST['discount']*1 ? $_POST['discount'] : 0;
$balance = $_POST['balance'];
$bill_serial = $_POST['bill_serial'];
$bill_id = $_POST['bill_id'];

$tableData = stripcslashes($_POST['pTableData']);

$pTableData = json_decode($pTableData, true);


// Insert main invoice data
$mainInvoiceQuery = "
    UPDATE teppich_clean_bill
    SET 
        type = '$type',
        notes = '$notes',
        customer_name = '$customer',
        phone = '$customer_phone',
        street = '$customer_street',
        post = '$customer_post',
        city = '$customer_city',
        ddate = '$duedate',
        date = '$bdate',
        amount = '$total',
        gst = '$gst',
        discount = '$discount',
        bill_serial = '$bill_serial'
    WHERE id = '$bill_id'
";
$r = query("Delete from teppich_clean_line_item where bid='$bill_id';");
// Execute the main invoice query
if (query($mainInvoiceQuery)) {

    // Insert pTableData items
    foreach ($pTableData as $item) {
        $product = $item['product'];
        $length = $item['length'];
        $width = $item['width'];
        $sqm = $item['sqm'];
        $rate = $item['rate'];
        $qty = $item['qty'];
        $no = $item['no'];
        $discount = $item['discount']*1 ? $item['discount'] : 0;
        $gst_incl = $item['gst_incl'] ? 1 : 0;
        $gst = $item['gst'];
        $net = $item['net'];
        $amount = $item['amount'];
        $status = 0;

        // Inserting each pTableData item
        $pTableDataQuery = "
        INSERT INTO teppich_clean_line_item (
            product, length, width, sqm, rate, qty, discount, gst_incl, gst, net, amount, status,lid,bid
        ) 
        VALUES (
            '$product', '$length', '$width', '$sqm', '$rate', '$qty', '$discount', '$gst_incl', '$gst', '$net', '$amount', '$status','$no','$bill_id'
        )
    ";
        // Execute the pTableData query
        query($pTableDataQuery);
    }

    echo "Record Updated successfully";
} else {
    echo "Error: " . $mainInvoiceQuery;
}


?>

