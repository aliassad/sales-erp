<?php
require("helpers.php");
$discription=$_POST["dis"];
$title=$_POST["title"];
$stock=$_POST["stock"];
$sprice=$_POST["sprice"];
$pprice=$_POST["pprice"];
$disc=$_POST["disc"];
$mstock=$_POST["minstock"];




$sql="Update product set des='$discription',stock='$stock',saleprice='$sprice',purchaseprice='$pprice',discount='$disc',minstock='$mstock' where des='$title';";
// SQL query
$q=query($sql);
if(mysqli_affected_rows() > 0){
    echo "true";
}
else{ echo "false";}
?>