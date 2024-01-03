<?php
require("helpers.php");
$result = query('SELECT p.*,(select concat(v.id,":",v.vendor_no," ",v.name) from vendor v where v.id = p.vendor_id) as vendor_no  from product as p');
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $row_data = array(
        'id' => $row['id'],
        'des' => $row['des'],
        'stock' => $row['stock'],
        'sprice' => $row['saleprice'],
        'pprice' => $row['purchaseprice'],
        'minstock' => $row['minstock'],
        'disc' => $row['discount'],
        'item_length' => $row['item_length'],
        'item_width' => $row['item_width'],
        'square_meter' => $row['square_meter'],
        's_no' => $row['s_no'],
        'article_no' => $row['article_no'],
        'origin' => $row['origin'],
        'vendor_no' => $row['vendor_no'],
    );
    array_push($data, $row_data);
}

echo json_encode($data);

?>