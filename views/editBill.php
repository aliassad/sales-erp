<?php


setlocale(LC_MONETARY,"en_US");
$billno=$_GET["billno"];
if(isset($_GET["cid"]))
{
    $cid=$_GET["cid"];
}

$result=query("select b.cid,b.amount,b.discount,DATE_FORMAT(b.date,'%d-%m-%Y') as date,DATE_FORMAT(b.ddate,'%d-%m-%Y') as ddate,b.notes,b.type from bill b where id='$billno'");

while($row=mysqli_fetch_array($result))
{
 $cid=$row['cid'];
 $amount=$row['amount'];
 $discount=$row['discount'];
 $date=$row['date'];
 $ddate=$row['ddate'];
 $note=$row['notes'];
 $type=$row['type'];
}
$result=query("select Sum(amount) as paid from billamounts where bid='$billno'");
while($row=mysqli_fetch_array($result))
{
 $paid=$row['paid'];
}
$result=query("select concat(id,': ',name) as name from customer where id='$cid'");
while($row=mysqli_fetch_array($result))
{
 $name=$row['name'];
}

$pending=$amount-$paid;
$products=query("select * from product");


?>


 <div class="container-fluid">
  <div class="page-content">
   <!-- Page Heading -->

   <div class="row" style="padding-bottom: 15px;" >
    <div class="btn-group btn-breadcrumb">
     <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
     <?php if(isset($_GET["cid"])) { ?>
      <a href="index.php?page=customers" class="btn btn-default"><i class="fa fa-group"></i>&nbsp;Customers</a>
      <a href="index.php?page=showCustomer&idno=<?php echo $cid; ?>" class="btn btn-default"><i class="fa fa-user"></i>&nbsp;Customer Details</a>
      <?php }else { ?>
       <a href="index.php?page=sell" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
       <?php } if(isset($_GET["cid"])){ ?>
        <a href="index.php?page=showBill&billno=<?php echo $billno; ?>&cid=<?php echo $cid; ?>" class="btn btn-default">
         <i class="fa fa-file-text"></i>&nbsp;Bill</a>
        <?php }else { ?>
         <a href="index.php?page=showBill&billno=<?php echo $billno; ?>" class="btn btn-default"><i class="fa fa-file-text"></i>&nbsp;Bill</a>
         <?php } ?>
          <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit Bill</a>

    </div>
   </div>




   <!-- /.row -->


   <div class="row">
    <div class="col-md-4" style="padding-left: 0px;">
     <div class="form-group">
      <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Customer</span>
       <select id="cuname" class="selectpicker show-tick" data-live-search="true">
        <option>
         <?php echo $name; ?>
        </option>
        <?php
                        $result=query("select concat(id,': ',name) as name from customer");
                        while($row=mysqli_fetch_array($result))
                        {
                                if($row['name']!=$name)
                                echo '<option>'.$row['name'].'</option>';
                        }
                        ?>
       </select>

      </div>
     </div>
    </div>
    <a class="btn btn-md btn-primary" onclick="saveInvoice();" style="float:right;"> <i class="fa fa-edit"></i>&nbsp;Update &amp; Save</a>
   </div>

   <div class="row">
    <div class="col-md-5" style="padding:0px; padding-right:20px; margin:0px;">
     <div class="form-group">
      <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-edit"></i><b>&nbsp;Number:</b> </span>
       <input class="form-control" id="invNo" value="<?php echo $billno; ?>" readonly/>
      </div>
     </div>
    </div>

    <div class="col-md-7" style="padding:0px; margin:0px;">
     <div class="form-group">
      <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-calendar"></i><b>&nbsp;BillDate:</b> </span>
       <input type="text" placeholder="click to select date" class="form-control" id="ddate" value="<?php echo $date; ?>" />
       <span class="input-group-addon"><i class="fa fa-calendar"></i><b>&nbsp;Due by:</b> </span>
       <input type="text" placeholder="click to select date" class="form-control" id="duedate" value="<?php echo $ddate; ?>" />
      </div>
     </div>
    </div>

   </div>
   <div class="row">
    <div class="col-md-3 col-md-offset-4">
     <div class="form-group" style="padding-left:20px; padding-right:20px;">
      <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-edit"></i></span>
       <select style="font-size:18px" id="intitle" class="form-control">
        <option>
         <?php echo $type; ?>
        </option>
        <?php if($type!="Invoice"&&$type!="Order")
                           echo '<option>Invoice</option>';
                    ?>
       </select>
      </div>
     </div>
    </div>
   </div>

   <div class="panel panel-primary" style="
    margin-bottom: 10px;">
    <div class="panel-body" style="; overflow-y:none; padding:0px;">

     <table class="table  table-bordered table-hover">
        <thead>

                <th class="text-center">
                 <i class="fa fa-pencil "></i>&nbsp;Item no#
                </th>
                <th class="text-center">
                 <i class="fa fa-briefcase "></i>&nbsp;Product
                </th>
                <th class="text-center">
                 <i class="fa fa-money "></i>&nbsp;@
                </th>
                <th class="text-center">
                 <i class="fa fa-table"></i>&nbsp;Qty
                </th>
                <th class="text-center">
                 <b>%</b>&nbsp;Discount
                </th>
                <th class="text-center">
                 <i class="fa fa-money "></i>&nbsp;Amount
                </th>
                <th class="text-center">
                  #
                 </th>

        </thead>
      <tbody id="invoice">

       <?php
                                        $result=query("select * from lineitem where bid='$billno'");
                                        while($row=mysqli_fetch_array($result))
                                        {

                                       echo '<tr><td class="itemno" >'.$row['lid'].'</td><td style="width:30%;"><input type="text" class="form-control"  value="'.$row['product'].'" readonly/></td><td style="width:12%" ><input type="number"  placeholder="Rate" class="form-control" onkeyup="calAmount(this);" value="'.$row['rate'].'"></td><td style="width:12%" ><input type="number"  placeholder="Qty" class="form-control" onkeyup="calAmount(this);" value="'.$row['unit'].'"></td><td style="width:12%" ><input type="number"  placeholder="Discount" class="form-control" onkeyup="calAmount(this);" value="'.$row['discount'].'"></td><td style="width:20%" ><input type="number" tabindex="-1"   class="form-control amt"  readonly value="'.$row['amount'].'"></td> <td><button id="'.$row['lid'].'" tabindex="-1" class="btn btn-danger glyphicon glyphicon-remove row-remove" onclick="delete_emp('.$row['lid'].');" ></button></td></tr>';
                                        }

                                    ?>


      </tbody>
      <tfoot>
       <th style="width:8%;">
        <input type="text" id="add_row" class="form-control" placeholder="New Item">
       </th>
      </tfoot>


     </table>

    </div>
    <div class="panel-footer clearfix" style="padding-top: 0px; padding-bottom: 0px; margin: 0px;">
     <table class="table" style="margin: 0px;">
      <thead>
       <th>Amount Recieved:</th>
       <th>Discount:</th>
       <th>Balance:</th>
       <th>Grand Total(PKR):</th>
      </thead>
      <tbody>
       <tr id="discount">
        <td>
         <input type="number" id="paid" class="form-control" onkeyup="dis();" placeholder="0.0" value="<?php echo $paid; ?>" readonly/>
        </td>
        <td>
         <input type="number" id="discount1" class="form-control" onkeyup="dis();" placeholder="0.0" value="<?php echo $discount; ?>" />
        </td>
        <td>
         <input type="text" id="total" class="form-control" value="<?php echo $pending-$discount; ?>" readonly>
        </td>
        <td>
         <input type="text" id="ftotal" class="form-control" value="<?php echo $amount; ?>" readonly>
        </td>
       </tr>
      </tbody>
     </table>
    </div>

   </div>
   <div class="row">
    <div class="col-lg-12" style="padding:0px;">
     <table class="table table-bordered">
      <thead>
       <th style="background:lightgrey;"><i class="fa fa-newspaper-o"></i>&nbsp;Notes</th>
      </thead>
      <tbody>
       <tr>
        <td>
         <textarea id="notes" class="form-control" rows="4" style="font-size:14px;"><?php echo $note; ?></textarea>
        </td>
       </tr>
      </tbody>

     </table>
    </div>


   </div>





  </div>

 </div>
 <!-- /.container-fluid -->


 </div>

 <script src="js/sweetalert.min.js"></script>
 <script src="js/jquery.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/jquery.json-2.4.min.js"></script>
 <script src="js/taffy-min.js"></script>
 <script src="js/editBill.js"></script>
 <script src="js/datepicker.js"></script>
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#ddate').datepicker({
                    format: "dd-mm-yyyy"
                }); 
                $('#duedate').datepicker({
                    format: "dd-mm-yyyy"
                }); 
                
            });
        </script>
