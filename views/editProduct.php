<?php
require("helpers.php");

$id = $_POST["edit_product_id"]*1;
$stock = $_POST["edit_stock"];
$sale_price = $_POST["edit_sprice"];
$purchase_price = $_POST["edit_pprice"];
$mstock = $_POST["edit_minstock"];
$serial_no = $_POST["edit_serial_no"];
$article_no = $_POST["edit_article_no"];
$item_length = $_POST["edit_item_length"];
$item_width = $_POST["edit_item_width"];
$origin = $_POST["edit_origin"];
$vendor_id = $_POST["edit_vendor_id"];
$description = $_POST["edit_description"];
$discount = $_POST["edit_discount"];


$sql = "Update product set 
                   des='$description',
                   stock='$stock',
                   saleprice='$sale_price',
                   purchaseprice='$purchase_price',
                   discount='$discount',
                   minstock='$mstock', 
                   article_no='$article_no', 
                   s_no='$serial_no', 
                   item_width='$item_width', 
                   item_length='$item_length', 
                   origin='$origin', 
                   vendor_id='$vendor_id'
where id='$id';";
// SQL query
$q = query($sql);
if ($q) {
    echo "true";
} else {
    echo "false";
}
?>