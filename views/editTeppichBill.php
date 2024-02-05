<?php


setlocale(LC_MONETARY, "en_US");
$billno = $_GET["billno"];
if (isset($_GET["cid"])) {
    $cid = $_GET["cid"];
}

$result = query("select b.* from teppich_clean_bill b where id='$billno'");

while ($row = mysqli_fetch_array($result)) {
    $bill_serial = $row['bill_serial'];
    $amount = $row['amount'];
    $discount = $row['discount'];
    $date = $row['date'];
    $ddate = $row['ddate'];
    $note = $row['notes'];
    $type = $row['type'];
    $gst = $row['gst'];
    $name = $row['customer_name'];
    $phone = $row['phone'];
    $post = $row['post'];
    $street = $row['street'];
    $city = $row['city'];
}
$result = query("select Sum(amount) as paid from teppich_clean_billamounts where bid='$billno'");
while ($row = mysqli_fetch_array($result)) {
    $paid = $row['paid'];
}
$pending = ($amount) - $paid;
?>
<style>
    #discount > td > input {
        font-size: 32px;
    }

    #discount > td > input[id="final_total"] {
        font-size: 48px;
        height: 49px;
    }
</style>

<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->

        <div class="row" style="padding-bottom: 15px;">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=teppich_sell" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Teppich Clean</a>
                <a href="index.php?page=showTeppichBill&billno=<?php echo $billno; ?>" class="btn btn-default"><i
                            class="fa fa-file-text"></i>&nbsp;Bill</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit Bill</a>
            </div>
            <a class="btn btn-md btn-primary" onclick="saveInvoice();" style="float:right; margin-top: 5px"> <i
                        class="fa fa-edit"></i>&nbsp;Update
                &amp; Save</a>
        </div>


        <!-- /.row -->


        <div class="row">
            <div class="col-md-2" style="padding: 0px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Customer</span>
                        <input type="text" class="form-control" value="<?= $name ?>" id="customer_name"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding-left: 5px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                        <input type="text" class="form-control" id="customer_phone" value="<?= $phone ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding-left: 5px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building"></i>&nbsp;Street</span>
                        <input type="text" class="form-control" id="customer_street" value="<?= $street ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding-left: 5px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-code"></i>&nbsp;Post Code</span>
                        <input type="text" class="form-control" id="customer_post" value="<?= $post ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding-left: 5px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;City</span>
                        <input type="text" class="form-control" id="customer_city" value="<?= $city ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group" style="padding-left:5px;">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <select style="font-size:18px" id="intitle" class="form-control">
                            <option>
                                <?php echo $type; ?>
                            </option>
                            <?php if ($type != "Invoice")
                                echo '<option>Invoice</option>';
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2" style="padding:0px; padding-right:20px; margin:0px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i><b>&nbsp;Number:</b> </span>
                        <input class="form-control" id="invNo" value="<?php echo $billno; ?>" readonly/>
                    </div>
                </div>
            </div>

            <div class="col-md-3" style="padding:0px; padding-right:10px; margin:0px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag"></i><b>&nbsp;Sr</b> </span>
                        <input class="form-control" id="bill_serial" value="<?php echo $bill_serial; ?>"/>
                    </div>
                </div>
            </div>

            <div class="col-md-7" style="padding:0px; margin:0px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i><b>&nbsp;BillDate:</b> </span>
                        <input type="text" placeholder="click to select date" class="form-control" id="billdate"
                               value="<?php echo $date; ?>"/>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i><b>&nbsp;Due by:</b> </span>
                        <input type="text" placeholder="click to select date" class="form-control" id="duedate"
                               value="<?php echo $ddate; ?>"/>
                    </div>
                </div>
            </div>

        </div>

        <div class="panel panel-primary" style="margin-bottom: 10px;">
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
                        <i class="fa fa-arrow-up"></i>&nbsp;Length <span class="text-xs">cm</span>
                    </th>
                    <th class="text-center">
                        <i class="fa fa-arrow-right"></i>&nbsp;Width <span class="text-xs">cm</span>
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money "></i>&nbsp;@
                    </th>
                    <th class="text-center">
                        SQM
                    </th>
                    <th class="text-center">
                        <i class="fa fa-table"></i>&nbsp;Qty
                    </th>
                    <th class="text-center">
                        <b>%</b>&nbsp;Discount
                    </th>
                    <th class="text-center">
                        GST Incl
                    </th>
                    <th class="text-center">
                        Net
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money"></i>&nbsp;GST
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
                    $result = query("SELECT l.* FROM `teppich_clean_line_item` l WHERE l.bid = '$billno'");
                    while ($row = mysqli_fetch_array($result)) {
                        $is_checked = "";
                        if ($row['gst_incl'])
                            $is_checked = "checked";
                        echo '<tr><td class="itemno" >' . $row['lid'] . '</td>';
                        echo '<td style="width:20%;"><input  type="text" class="form-control"  value="' . $row['product'] . '" /></td>';
                        echo '<td style="width:8%" ><input type="number"  placeholder="Length" class="form-control" onkeyup="calAmount(this);" value="' . $row['length'] . '"></td>';
                        echo '<td style="width:8%" ><input type="number"  placeholder="Width" class="form-control" onkeyup="calAmount(this);" value="' . $row['width'] . '"></td>';
                        echo '<td style="width:5%" ><input type="number"  placeholder="Rate" class="form-control" onkeyup="calAmount(this);" value="' . $row['rate'] . '"></td>';
                        echo '<td style="width:5%" ><input type="number"  placeholder="SQM" class="form-control" readonly value="' . $row['sqm'] . '"></td>';
                        echo '<td style="width:7%" ><input type="number"  placeholder="Qty" class="form-control" onkeyup="calAmount(this);" value="' . $row['qty'] . '"></td>';
                        echo '<td style="width:7%" ><input type="number"  placeholder="Discount" class="form-control" onkeyup="calAmount(this);" value="' . $row['discount'] . '"></td>';
                        echo '<td style="width:7%" ><input type="checkbox"  class="form-control" onchange="calAmount(this);" ' . $is_checked . '></td>';
                        echo '<td style="width:8%" ><input type="number" tabindex="-1"   class="form-control net"  readonly value="' . $row['net'] . '"></td>';
                        echo '<td style="width:8%" ><input type="number" tabindex="-1"   class="form-control gst"  readonly value="' . $row['gst'] . '"></td>';
                        echo '<td style="width:15%" ><input type="number" tabindex="-1"   class="form-control amt"  readonly value="' . $row['amount'] . '"></td>';
                        echo '<td><button id="' . $row['lid'] . '" tabindex="-1" class="btn btn-danger glyphicon glyphicon-remove row-remove" onclick="delete_emp(' . $row['lid'] . ');" ></button></td>';
                        echo '</tr>';
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
                    <th>Gross Total(<?= CURRENCY ?>):</th>
                    <th>GST (19)%:</th>
                    <th>Net Total(<?= CURRENCY ?>):</th>
                    <th>Discount:</th>
                    <th>Amount Received:</th>
                    <th>Total(<?= CURRENCY ?>):</th>
                    </thead>
                    <tbody>
                    <tr id="discount">
                        <td>
                            <input type="number" id="gross_total" class="form-control" placeholder="0.0"
                                   value="<?= $amount; ?>" readonly/>
                        </td>
                        <td>
                            <input type="number" id="gst_amount" class="form-control" placeholder="0.0"
                                   value="<?= $gst; ?>" readonly/>
                        </td>
                        <td>
                            <input type="text" id="net_total" class="form-control"
                                   value="<?= number_format($amount - $gst, 2); ?>" readonly>
                        </td>
                        <td>
                            <input type="number" id="discount1" class="form-control" onkeyup="dis();" placeholder="0.0"
                                   value="<?= $discount; ?>"/>
                        </td>
                        <td>
                            <input type="number" id="paid" class="form-control" onkeyup="dis();" placeholder="0.0"
                                   value="<?= $paid; ?>" readonly/>
                        </td>
                        <td>
                            <input type="text" id="final_total" class="form-control"
                                   value="<?php echo number_format((($amount) - $discount) - $paid, 2); ?>"
                                   readonly>
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
                            <textarea id="notes" class="form-control" rows="4"
                                      style="font-size:14px;"><?php echo $note; ?></textarea>
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
<script src="js/editTeppichBill.js"></script>
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
