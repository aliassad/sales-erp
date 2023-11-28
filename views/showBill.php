<?php
setlocale(LC_MONETARY, "en_US");
$billno = $_GET["billno"];
if (isset($_GET["cid"])) {
    $cid = $_GET["cid"];
}

$result = query("select b.cid,b.amount,b.discount,DATE_FORMAT(b.date,'%d-%m-%Y') as date,DATE_FORMAT(b.ddate,'%d-%m-%Y') as ddate,b.notes,b.type,b.gst from bill b where b.id='$billno'");


while ($row = mysqli_fetch_array($result)) {
    $cid = $row['cid'];
    $amount = $row['amount'];
    $discount = $row['discount'];
    $date = $row['date'];
    $ddate = $row['ddate'];
    $note = $row['notes'];
    $type = $row['type'];
    $gst = $row['gst'];
}

$result = query("select Sum(amount) as paid from billamounts where bid='$billno'");
while ($row = mysqli_fetch_array($result)) {
    $paid = $row['paid'];
}
$result = query("select * from customer where id='$cid'");
while ($row = mysqli_fetch_array($result)) {
    $address = $row['address'];
    $name = $row['name'];
    $phone = $row['phone'];
    $customer_gst = $row['gst'];
}
$pending = ($amount + $gst) - $paid;

?>
<input id="userRole" value="<?php echo $_SESSION['role']; ?>" style="display: none;">
<div class="page-content">

    <!-- Page Heading -->
    <div class="row" style="margin-left:10px;">
        <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <?php if (isset($_GET["cid"])) { ?>
                <a href="index.php?page=customers" class="btn btn-default"><i
                            class="fa fa-group"></i>&nbsp;Customers</a>
                <a href="index.php?page=showCustomer&idno=<?php echo $cid; ?>" class="btn btn-default"><i
                            class="fa fa-user"></i>&nbsp;Customer Details</a>
            <?php } else { ?>
                <a href="index.php?page=sell" class="btn btn-default"><i
                            class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
            <?php } ?>
            <a href="#" class="btn btn-primary"><i class="fa fa-file-text"></i>&nbsp;Bill</a>
        </div>
    </div>

    <div class="row" style="padding:20px">
        <div class="col-md-8">
            <?php if ($type == "Invoice") { ?>
                <a href="#" class="btn btn-md btn-warning" data-toggle="modal" data-target="#PayModal"
                   onclick="clearModal();" style="font-size:15px;"><i class="fa fa-money"></i>
                    <b>&nbsp;Pay Amount&amp;See Payments History</b> </a>
            <?php } ?>

            <?php if ($_SESSION['role'] == "Admin") { ?>
                <a <?php if (isset($_GET["cid"])) { ?> href="index.php?page=editBill&billno=<?php echo $billno; ?>&cid=<?php echo $cid; ?>" <?php } else { ?> href="index.php?page=editBill&billno=<?php echo $billno; ?>"  <?php } ?>
                        class="btn btn-md btn-primary" style="font-size:15px;">
                    <i class="fa fa-edit"></i>
                    <b>Edit Bill</b></a>
                <a class="btn btn-md btn-danger" style="font-size:15px;" onclick="deleteBill(<?php echo $billno; ?>);">
                    <i class="fa fa-trash"></i>
                    <b>&nbsp;Delete Bill</b></a>
            <?php } ?>
        </div>
        <a class="btn btn-lg btn-primary" style="float:right;" id="printBill"><i class="fa fa-print"></i>&nbsp;Print
            Bill</a>

    </div>
</div>
<!-- /.row -->
<div class="container" style="background-color:#FFFFFF; ">
    <div class="row">
        <div class="col-sm-6">
            <img src="img/teppich_clean.jpeg" class="img-responsive" width="160px" height="auto">
        </div>
        <div class="col-sm-6" >
            <h2 id="type" style="float: right"><?= $type; ?></h2>
        </div>
    </div>

    <div class="row box">
        <div class="col-lg-5" style="padding-left:40px;">

            <table class="table">
                <tbody id="tocustomer">
                <tr>
                    <td class="nocenter"><b><i class="fa fa-user"></i>&nbsp;Name:</b>
                        <?php echo $name; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><b><i class="fa fa-phone "></i>&nbsp;Phone:</b>
                        <?php echo $phone; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><b><i class="fa fa-book"></i>&nbsp;Address:</b>
                        <?php echo $address; ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-lg-5 col-lg-offset-2" style="padding-right:40px;">
            <table class="table table">
                <tbody>

                <tr>
                    <td class="nocenter">
                        <i class="fa fa-tag"></i>&nbsp;<b>Customer Order id: </b>
                        <?php echo $billno; ?>
                        <input type="number" id="billno" value="<?php echo $billno; ?>" style="display:none;"/>

                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-calendar"></i>&nbsp;<b>Date: </b>
                        <?php echo $date; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-calendar"></i>&nbsp;<b>Due by: </b>
                        <?php echo $ddate; ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row box">
        <table class="table">
            <thead>
            <th class="text-center">
                <i class="fa fa-pencil "></i>&nbsp;Item no#
            </th>
            <th class="text-center">
                <i class="fa fa-briefcase "></i>&nbsp;Product
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;Price Per SQM
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
            </thead>
            <tbody>
            <?php
            $result = query("SELECT l.*, p.article_no, p.origin,p.item_length,p.item_width, p.saleprice  FROM `lineitem` l, product p  WHERE l.bid = '$billno' and  l.product = p.id; ");
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr><td class="text-center" >' . $row['lid'] . '</td><td>' . $row['article_no'] . ' ' . $row['origin'] . ' ' . $row['des'] . ' ' . $row['item_length'] . '*' . $row['item_width'] . ': ' . number_format(($row['item_length'] * $row['item_width'] / 10000), 2) . ' SQM</td><td class="text-center" >' . $row['rate'] . '</td><td class="text-center" >' . $row['unit'] . '</td><td class="text-center" >' . $row['discount'] . '</td><td class="text-center" >' . ($row['amount']) . '</td></tr>';
            }
            ?>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" rowspan="3" style="border-style:none;">
                    <table class="table table-bordered">
                        <thead>
                        <th style="background:lightgrey;"><i class="fa fa-newspaper-o"></i>Notes</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <textarea id="mnot" class="form-control" rows="4" style="font-size:14px;"
                                          readonly><?= $note ?></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td colspan="2">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="nocenter"><b>Gross Total:</b></td>
                            <td class="nocenter">
                                <?= CURRENCY_SIGN . ' ' . number_format(($amount), 2) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>GST (<?= $customer_gst ?>)%:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($gst), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Net Total:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($amount + $gst), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Discount:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($discount), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Amount Received:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($paid), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="background:lightgrey;"><b>Balance:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($pending - $discount), 2) ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <input id="cbalance" type="number" style="display:none;"
                   value="<?php echo $pending - $discount; ?>">
            </tfoot>
        </table>
    </div>

</div>
</div>
<input id="cbalance" type="number" style="display:none;" value="'<?php echo $pending; ?>'">

<div class="modal fade" id="PayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-2x"></i>&nbsp;Pay Amount &amp;
                    Payments History</h4>
            </div>
            <div class="modal-body well">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Payment Date</span>
                    <input id="pdate" type="text" class="form-control" placeholder="click to select date"
                           onchange="filterPayments();">
                </div>
                <label class="label label-md label-default"><i class="fa fa-dashboard"></i>&nbsp;Payment history</label>
                <center>
                    <div style="border: 3px solid lightblue">
                        <table class="table table-striped" id="bpay">
                            <thead>
                            <th><i class="fa fa-pencil"></i>&nbsp;Sr#</th>
                            <th><i class="fa fa-money"></i>&nbsp;Amount</th>
                            <th><i class="fa fa-calendar"></i>&nbsp;Date</th>
                            <th><i class="fa fa-trash"></i>&nbsp;</th>
                            </thead>
                            <tbody id="paymentsList">
                            </tbody>
                        </table>
                    </div>
                </center>

                <center>
                    <form>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Previous Balance:</span>
                                        <input type="text" id="pbalance" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Date:</span>
                                        <input type="text" id="amountDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Amount Received:</span>
                                        <input type="number" id="amountp" class="form-control" onkeyup="calBalance();"
                                               value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Remaining Balance:</span>
                                        <input type="text" id="rbalance" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="payAmount();">Save Changes</button>
                <!--                    <button type="button" class="btn btn-primary" onclick="payAmountSlip();">Save &amp; PrintSlip</button>-->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/showBill.js"></script>
<script src="js/datepicker.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        $('#pdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#amountDate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#amountDate').datepicker('setValue', 'gotoCurrent');
    });
</script>