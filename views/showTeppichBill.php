<?php
setlocale(LC_MONETARY, "en_US");
$billno = $_GET["billno"];

$result = query("select b.street,b.phone,b.city,b.post,b.customer_name, b.bill_serial,b.amount,b.discount,b.date,b.ddate,b.notes,b.type,b.gst from teppich_clean_bill b where b.id='$billno'");

while ($row = mysqli_fetch_array($result)) {
    $bill_serial = $row['bill_serial'];
    $amount = $row['amount'];
    $discount = $row['discount'];
    $date = $row['date'];
    $ddate = $row['ddate'];
    $note = $row['notes'];
    $type = $row['type'];
    $gst = $row['gst'];
    $street = $row['street'];
    $name = $row['customer_name'];
    $phone = $row['phone'];
    $zip_code = $row['post'];
    $city = $row['city'];
}

$result = query("select Sum(amount) as paid from teppich_clean_billamounts where bid='$billno'");
while ($row = mysqli_fetch_array($result)) {
    $paid = $row['paid'];
}

$pending = ($amount) - $paid;

?>
<style>
    .container {
        background-color: #eee8e1 !important;
    }

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 2px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: none !important;
    }
</style>
<input id="userRole" value="<?php echo $_SESSION['role']; ?>" style="display: none;">
<div class="page-content">

    <!-- Page Heading -->
    <div class="row" style="margin-left:10px;">
        <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <a href="index.php?page=teppich_sell" class="btn btn-default"><i
                        class="fa fa-shopping-cart"></i>&nbsp;Teppich Clean</a>
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
                <a href="index.php?page=editTeppichBill&billno=<?php echo $billno; ?>"
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
        <?php if ($type == "Invoice") { ?>
            <a class="btn btn-lg btn-info" style="float:right; margin-right: 10px" id="printDeliveryOrder"><i
                        class="fa fa-print"></i>&nbsp;Print
                Delivery Order</a>
        <?php } ?>
    </div>
</div>
<!-- /.row -->
<div class="container" style="background-color:#FFFFFF; ">
    <div class="row">
        <div class="col-sm-6">
            <img src="img/teppich_clean.png" class="img-responsive" width="160px" height="auto">
        </div>
        <div class="col-sm-6">
            <h1 id="type" style="float: right;text-transform: uppercase"><?= $type; ?></h1>
        </div>
    </div>

    <div class="row box">
        <div class="col-lg-5" style="padding-left:10px;">

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
                        <?php echo $zip_code . ' ' . $street . '<br> ' . $city; ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>

        <div class="col-lg-3 col-lg-offset-4" style="padding-right:20px;">
            <table class="table table">
                <tbody>
                <tr>
                    <td class="nocenter">Teppich Clean Inh. Tipu Khan</td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-building-o"></i>&nbsp;Im Taubental 40, 41468 Neuss</td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-phone-square"></i>&nbsp;021 31/7 18 69-0</td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-print"></i>&nbsp;021 31/7 18 69-21</td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-envelope-open"></i>&nbsp;Info@teppich-clean24.de</td>
                </tr>
                <tr>
                    <td class="nocenter"><i class="fa fa-globe"></i>&nbsp;www.teppich-clean24.de</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row box">
        <b style="font-size: 16px"><?= $type; ?> No: <?php echo $bill_serial; ?></b><input type="number" id="billno"
                                                                                           value="<?php echo $billno; ?>"
                                                                                           style="display:none;"/>
    </div>
    <div class="row box">
        <table class="table">
            <thead>
            <th class="text-center">
                <i class="fa fa-hashtag"></i>&nbsp;Pos.
            </th>
            <th class="text-left">
                Product
            </th>
            <th class="text-center">
                Length
            </th>
            <th class="text-center">
                Width
            </th>
            <th class="text-right">
                SQM
            </th>
            <th class="text-center">
                Price Per SQM
            </th>
            <th class="text-center">
                QTY
            </th>
            <th class="text-center">
                <b>%</b>&nbsp;Discount
            </th>
            <th class="text-center">
                GST Inlc
            </th>
            <th class="text-center">
                Net
            </th>
            <th class="text-center">
                GST
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;Amount
            </th>
            </thead>
            <tbody>
            <?php
            $result = query("SELECT l.*  FROM `teppich_clean_line_item` l WHERE l.bid = '$billno'");
            $index = 0;
            $unit_total = 0;
            $sqm_total = 0;
            while ($row = mysqli_fetch_array($result)) {
                $index++;
                $unit_total = $unit_total + $row['qty'];
                $sqm_total = $sqm_total + $row['sqm'];
                $is_gst_incl = $row['gst_incl'];
                $gst_checked = "";
                if ($is_gst_incl) {
                    $gst_checked = "checked";
                }
                ?>
                <tr>
                    <td class="text-center"><?= $index ?></td>
                    <td class="text-center"><?= $row['product'] ?></td>
                    <td class="text-center"><?= $row['length'] ?></td>
                    <td class="text-center"><?= $row['width'] ?></td>
                    <td class="text-center"><?= $row['sqm'] ?></td>
                    <td class="text-center"><?= $row['rate'] ?></td>
                    <td class="text-center"><?= $row['qty'] ?></td>
                    <td class="text-center"><?= $row['discount'] ?></td>
                    <td class="text-center"><input type="checkbox" <?= $gst_checked ?> readonly disabled></td>
                    <td class="text-center"><?= $row['net'] ?></td>
                    <td class="text-center"><?= $row['gst'] ?></td>
                    <td class="text-center"><?= $row['amount'] ?></td>
                </tr>
            <?php }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= number_format($sqm_total, 2, ',', '.'); ?></td>
                <td></td>
                <td><?= $unit_total ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="8" rowspan="3" style="border-style:none;">
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
                <td colspan="5">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="nocenter"><b>Gross Total:</b></td>
                            <td class="nocenter">
                                <?= CURRENCY_SIGN . ' ' . number_format(($amount), 2) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>GST (19)%:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($gst), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Net Total:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($amount-$gst), 2); ?></td>
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
    <div class="row box">
        You are required to keep the invoice for tax purposes for two years.
        <p>
            Payable: Net upon receipt of Invoice Reductions In fees result from our current framework or conditions
        </p>
    </div>
    <div class="row box">
        <div class="col-sm-6">
            Sparkasse Neuss: Account number: 934 230 69 Bank code: 305 500 00<br>
            Sparkasse Neuss: IBAN: DE81 3055 0000 0093 4230 69
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"><b>
                Tax No. 125/5308/5032<br>
                UID No. DE 274915735
            </b>
        </div>
    </div>
    <div class="row box" style="padding: 20px">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            Terms and conditions at: <b>https://carpet-clean24.de/agb</b>
        </div>
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
<script src="js/teppichShowBill.js"></script>
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