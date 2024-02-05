<?php
require("helpers.php");
if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $result = query("SELECT b.gst,b.bill_serial, b.id,concat(b.customer_name,': ',b.phone,' ',b.post,' ',b.street,' ',b.city) as name,b.discount,b.amount,b.ddate,b.date ,b.type,(select SUM(a.amount) from teppich_clean_billamounts a where b.id=a.bid ) as paid from teppich_clean_bill b group by b.id desc");
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'id' => $row['id'],
            'bill_serial' => $row['bill_serial'],
            'name' => $row['name'],
            'amount' => ($row['amount']  * 1.0),
            'ddate' => $row['ddate'],
            'date' => $row['date'],
            'balance' => (($row['amount'] * 1.0) - ($row['paid'] * 1.0) - ($row['discount'] * 1.0)),
            'paid' => ($row['paid'] ?: 0),
            'type' => $row['type']
        );
        array_push($data, $row_data);
    }
} else {
    $result = query("SELECT  b.gst,b.bill_serial, b.id,concat(b.customer_name,': ',b.phone,' ',b.post,' ',b.street,' ',b.city) as name,b.discount,b.amount,b.ddate,b.date ,b.type,(select SUM(a.amount) from teppich_clean_billamounts a where b.id=a.bid ) as paid from teppich_clean_bill b group by b.id desc");

    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'id' => $row['id'],
            'bill_serial' => $row['bill_serial'],
            'name' => $row['name'],
            'amount' => ($row['amount']  * 1.0),
            'ddate' => $row['ddate'],
            'date' => $row['date'],
            'balance' => (($row['amount'] * 1.0) - ($row['paid'] * 1.0) - ($row['discount'] * 1.0)),
            'paid' => ($row['paid'] ?: 0),
            'type' => $row['type']
        );
        array_push($data, $row_data);
    }

}
echo json_encode($data);
?>