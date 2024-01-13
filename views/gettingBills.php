<?php
require("helpers.php");
if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $result = query("SELECT b.gst,b.bill_serial, b.id,concat(c.id,': ',c.name) as name,b.discount,b.amount,DATE_FORMAT(b.ddate, '%d-%m-%Y') as ddate,DATE_FORMAT(b.date,'%d-%m-%Y') as date,b.type,(select SUM(a.amount) from billamounts a where b.id=a.bid ) as paid from bill b,customer c WHERE b.cid='$cid' and c.id='$cid' group by b.id desc");
    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'id' => $row['id'],
            'bill_serial' => $row['bill_serial'],
            'name' => $row['name'],
            'amount' => ($row['amount'] * 1.0 + $row['gst'] * 1.0),
            'ddate' => $row['ddate'],
            'date' => $row['date'],
            'balance' => (($row['amount'] * 1.0 + $row['gst'] * 1.0) - ($row['paid'] * 1.0) - ($row['discount'] * 1.0)),
            'paid' => ($row['paid'] ?: 0),
            'type' => $row['type']
        );
        array_push($data, $row_data);
    }
} else {
    $result = query("SELECT  b.gst,b.bill_serial, b.id,concat(c.id,': ',c.name) as name,b.discount,b.amount,DATE_FORMAT(b.ddate, '%d-%m-%Y') as ddate,DATE_FORMAT(b.date,'%d-%m-%Y') as date,b.type,(select SUM(a.amount) from billamounts a where b.id=a.bid ) as paid from bill b,customer c WHERE b.cid=c.id group by b.id desc");

    $data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'id' => $row['id'],
            'bill_serial' => $row['bill_serial'],
            'name' => $row['name'],
            'amount' => ($row['amount'] * 1.0 + $row['gst'] * 1.0),
            'ddate' => $row['ddate'],
            'date' => $row['date'],
            'balance' => (($row['amount'] * 1.0 + $row['gst'] * 1.0) - ($row['paid'] * 1.0) - ($row['discount'] * 1.0)),
            'paid' => ($row['paid'] ?: 0),
            'type' => $row['type']
        );
        array_push($data, $row_data);
    }

}
echo json_encode($data);
?>