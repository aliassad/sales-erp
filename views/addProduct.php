<?php
require("helpers.php");

$stock = $_POST["stock"];
$sale_price = $_POST["sprice"];
$purchase_price = $_POST["pprice"];
$mstock = $_POST["minstock"];
$serial_no = $_POST["serial_no"];
$article_no = $_POST["article_no"];
$item_length = $_POST["item_length"];
$item_width = $_POST["item_width"];
$square_meter = $_POST["square_meter"];
$origin = $_POST["origin"];
$vendor_id = $_POST["vendor_id"];
$description = $_POST["description"];
$discount = $_POST["discount"];

$sql = "insert into product(id,
                    des,
                    stock,
                    saleprice,
                    purchaseprice,
                    discount,
                    minstock,
                    item_length,
                    item_width,
                    square_meter,
                    origin,
                    vendor_id,
                    article_no,
                    s_no
                    ) 
values(NULL,
       '$description',
       '$stock',
       '$sale_price',
       '$purchase_price',
       '$discount',
       '$mstock',
       '$item_length',
       '$item_width',
       '$square_meter',
       '$origin',
       '$vendor_id',
       '$article_no',
       '$serial_no'
       );";

$q = query($sql);
if ($q) {
    echo "true";
} else {
    echo "false";
}
?>