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
$billid = $_POST['billid'];
$duedate = $_POST['duedate'];
$bdate = $_POST['bdate'];
$pTableData = $_POST['pTableData'];
$total = $_POST['total'];
$gst = $_POST['gst'];
$paid = $_POST['paid'] *1 ? $_POST['paid'] : 0;;
$discount = $_POST['discount']*1 ? $_POST['discount'] : 0;
$balance = $_POST['balance'];
$bill_serial = $_POST['bill_serial'];

$tableData = stripcslashes($_POST['pTableData']);

$pTableData = json_decode($pTableData, true);


// Insert main invoice data
$mainInvoiceQuery = "
    INSERT INTO teppich_clean_bill (
        type, notes, customer_name, phone, street,post,city,
        ddate, date, amount, gst, discount, bill_serial
    )
    VALUES (
        '$type', '$notes', '$customer', '$customer_phone', '$customer_street', '$customer_post', '$customer_city',
        '$duedate', '$bdate', '$total', '$gst',  '$discount', '$bill_serial'
    )
";

// Execute the main invoice query
if (query($mainInvoiceQuery)) {
    // Get the last inserted ID (invoice ID)
    $invoice_id = 0;
    $r = query("select max(id) bid from teppich_clean_bill");
    while ($ro = mysqli_fetch_array($r)) {
        $invoice_id = $ro['bid'];
    }

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
            '$product', '$length', '$width', '$sqm', '$rate', '$qty', '$discount', '$gst_incl', '$gst', '$net', '$amount', '$status','$no','$invoice_id'
        )
    ";
        // Execute the pTableData query
        query($pTableDataQuery);
    }

    if ($paid != 0) {
        $r = query("insert into `teppich_clean_billamounts`(`bid`, `amount`, `date`) values('$invoice_id','$paid',STR_TO_DATE('$bdate','%d-%m-%Y'));");
        if (!$r) {
            echo "false3";
        }
    }
    echo "Record inserted successfully";
} else {
    echo "Error: " . $mainInvoiceQuery;
}


?>

