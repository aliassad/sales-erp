<?php
require("helpers.php");
$discription=$_POST["dis"];
$stock=$_POST["stock"];
$sprice=$_POST["sprice"];
$pprice=$_POST["pprice"];
$disc=$_POST["disc"];
$mstock=$_POST["minstock"];

        $sql="insert into product(id,des,stock,saleprice,purchaseprice,discount,minstock) values(NULL,'$discription','$stock','$sprice','$pprice','$disc','$mstock');";
        // SQL query 
        $q=query($sql);
         if(mysqli_affected_rows() > 0){
                   echo "true";
                    }
                    else{ echo "false";}
?>