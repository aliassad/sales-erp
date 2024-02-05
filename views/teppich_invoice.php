<?php if (isset($_GET['page']))
    $page = $_GET['page'];
else {
    $page = "home";
}

?>
<style>
    #discount > td > input {
        font-size: 32px;

    }

    #discount > td > input[id="final_total"] {
        font-size: 48px;
        height: 49px;
    }

    .dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {
        top: 100% !important;
        bottom: auto !important;
        margin-bottom: 2px;
    }


</style>

<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-4" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="index.php?page=teppich_sell" class="btn btn-default"><i
                                class="fa fa-pagelines"></i>&nbsp;Selling</a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-file-text"></i>&nbsp;New Bill</a>
                </div>
            </div>
            <div class="col-md-4">
                <center>
                    <div class="form-group">
                        <button class="btn btn-md btn-warning" style="margin-top:5px;"><b>BILL No</b> <span
                                    class="badge"><?php
                                $result = query("SHOW TABLE STATUS LIKE 'teppich_clean_bill'");
                                $data = mysqli_fetch_assoc($result);
                                $next_increment = $data['Auto_increment'];
                                echo($next_increment);
                                ?></span>
                            <input id='billidno' value="<?php echo($next_increment); ?>" style="display:none;"></button>
                    </div>
                </center>
            </div>
            <div class="col-md-4">
                <button class="btn btn-md btn-info" style="margin-top:5px; float: right">
                    <input id="billdate" type="text"
                           class="form-control"
                           style="width:166px;font-size:24px;  "/>
                </button>
            </div>
        </div>

        <div class="row" style="padding-bottom:10px;padding-top:20px;">
            <div class="col-md-3" style="padding-left: 0;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Sr</span>
                        <input class="form-control" id="bill_serial"/>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding-left: 0;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-edit"></i>&nbsp;Type</span>
                        <select style="font-size:18px" id="intitle" class="form-control">
                            <option>Invoice</option>
                            <option>Quotation</option>
                            <!--                                <option>Order</option>-->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="padding: 0px; ">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Customer</span>
                        <input id="customer_name" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding: 0px;padding-left: 10px; ">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                        <input id="customer_phone" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding: 0px;padding-left: 10px; ">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Street</span>
                        <input id="customer_street" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding: 0px;padding-left: 10px; ">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i>&nbsp;Post Code</span>
                        <input id="customer_post" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="padding: 0px;padding-left: 10px; ">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;City</span>
                        <input id="customer_city" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-primary" style="
    margin-bottom: 10px;">
            <div class="panel-body" style="overflow-y:none; padding:0px;">

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
                    <tr>
                        <td class="itemno">1</td>
                        <td style="width:28%;">
                            <input type="text" id="product1" placeholder="Product title" class="form-control"/>
                        </td>
                        <td style="width:7%">
                            <input type="number" id="length1" placeholder="0 cm" class="form-control"
                                   onkeyup="calAmount(this);">
                        </td>
                        <td style="width:7%">
                            <input type="number" id="width1" placeholder="0 cm" class="form-control"
                                   onkeyup="calAmount(this);">
                        </td>
                        <td style=" width:8%">
                            <input type="number" id="rate1" placeholder="@" class="form-control"
                                   onkeyup="calAmount(this);">
                        </td>
                        <td style=" width:5%">
                            <input type="number" id="sqm1" placeholder="SQM" class="form-control"
                                   readonly value="0" tabindex="-1">
                        </td>
                        <td style=" width:7%">
                            <input type="number" id="unit1" placeholder="Qty" class="form-control"
                                   onkeyup="calAmount(this);">
                        </td>
                        <td style=" width:7%">
                            <input type="number" id="disc1" placeholder="Discount" tabindex='-1' class="form-control"
                                   onkeyup="calAmount(this);">
                        </td>
                        <td style="width:5%">
                            <input type="checkbox" tabindex="-1" id="gst_included1" class="form-control"
                                   readonly value="0" onchange="calAmount(this)">
                        </td>
                        <td style="width:5%">
                            <input type="text" tabindex="-1" id="net1" placeholder="0" class="form-control net"
                                   readonly value="0">
                        </td>
                        <td style="width:5%">
                            <input type="text" tabindex="-1" id="gst1" placeholder="0" class="form-control gst"
                                   readonly value="0">
                        </td>
                        <td style="width:15%">
                            <input type="text" tabindex="-1" id="amount1" placeholder="0" class="form-control amt"
                                   readonly value="0">
                        </td>
                        <td>
                            <button id="1" tabindex="-1" class="btn btn-danger glyphicon glyphicon-remove row-remove"
                                    onclick="delete_emp(1);"></button>
                        </td>
                    </tr>


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
                    <th>GST (19%):</th>
                    <th>Net Total(<?= CURRENCY ?>):</th>
                    <th>Discount:</th>
                    <th>Amount Received:</th>
                    <th>Total (<?= CURRENCY ?>):</th>
                    </thead>
                    <tbody>
                    <tr id="discount">
                        <td>
                            <input type="text" id="gross_total" class="form-control" value="0" readonly tabindex="-1">
                        </td>
                        <td>
                            <input type="text" id="gst_amount" class="form-control" value="0" readonly tabindex="-1">
                        </td>
                        <td>
                            <input type="text" id="net_total" class="form-control" value="0" readonly tabindex="-1">
                        </td>
                        <td>
                            <input type="number" id="discount1" class="form-control" onkeyup="dis();"
                                   placeholder="0.0"/>
                        </td>
                        <td>
                            <input type="number" id="paid" class="form-control" onkeyup="dis();" placeholder="0.0"/>
                        </td>
                        <td>
                            <input type="text" id="final_total" class="form-control" value="0" readonly tabindex="-1">
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
                            <textarea id="notes" class="form-control" rows="3" style="font-size:14px;"></textarea>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <th>
                        <center>
                            <a href="#" class="btn btn-lg btn-primary" style="align:center;" id="showModal"
                               onclick="updateInvoice();"> Check out</a>
                        </center>
                    </th>
                    </tfoot>
                </table>
            </div>


        </div>


    </div>

</div>
<!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->


<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;New Customer</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>&nbsp;Name</span>
                                    <input type="text" id="cname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;Email</span>
                                    <input id="cemail" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                                    <input id="cphone" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Address</span>
                                    <textarea id="caddress" type="text" class="form-control" rows="3"
                                              cols="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveCustomer();"><i class="fa fa-save"></i>&nbsp;Save
                    changes
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close
                </button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="myDivToPrint" style="overflow-y:auto;max-height:570px;">
                <center>
                    <div class="row" style="width:90%;">
                        <center><h3 id="type" style="border:4px double black"></h3></center>
                        <div class="col-lg-6" style="padding-left: 0px;">
                            <div class="col-lg-10" style="padding-left: 0px;">
                                <table class="table">
                                    <tbody id="tocustomer">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6" style="padding-right: 0px;">
                            <div class="col-lg-10 col-lg-offset-2" style="padding-right: 0px;">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="nocenter">
                                            <i class="fa fa-tag"></i>&nbsp;<b>Trx ID: </b>
                                            <span class="badge" id="invNo"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="nocenter"><i class="fa fa-calendar"></i>&nbsp;<b>Date:&nbsp;</b><span
                                                    id="fbilldate"></span></td>
                                    <tr>
                                        <td class="nocenter"><i class="fa fa-calendar"></i>&nbsp;<b>Due Date: </b>
                                            <input type="text" placeholder="click to select date" class="form-control"
                                                   id="duedate"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </center>

                <center>
                    <table class="table  table" style="width:90%;">
                        <thead style="background-color:lightgrey;">
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
                        </thead>
                        <tbody id="inv">
                        <script>
                            function updateInvoice() {

                                if (!$('#bill_serial').val()) {
                                    $('#bill_serial').focus();
                                    swal("Missing Invoice Serial", "Please add valid Invoice Serial", "error");
                                    return;
                                }

                                if (!$('#customer_name').val()) {
                                    swal("Error! No Customer selected", "Please select Customer first", "error");
                                    return;
                                }
                                $('#myModal').modal('toggle');


                                $('#invNo').html($('#billidno').val());

                                $('#inv').html("");
                                $('#type').html("");
                                $('#gtotal').html("");
                                $('#fbilldate').html($('#billdate').val());
                                $('#type').append($('#intitle').val());

                                let discount_amount = $('#discount1').val();
                                let discount_section = "";

                                let paid_amount = $('#paid').val();
                                let paid_section = "";

                                if (discount_amount === '' || parseFloat(discount_amount) === 0) {
                                    discount_section = "";
                                } else {
                                    discount_section = '<tr><td class="nocenter"><b>Discount:</b></td><td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                                        parseFloat((discount_amount)).toLocaleString() + ' </td></tr>';
                                }

                                if (paid_amount === '' || parseFloat(paid_amount) === 0) {
                                    paid_section = "";
                                } else {
                                    paid_section = '<tr><td class="nocenter"><b>Amount Paid:</b></td><td class="nocenter">' + $('#CURRENCY_SIGN').val() + ' ' +
                                        parseFloat((paid_amount)).toLocaleString() + ' </td></tr>';
                                }

                                $('#tocustomer').html(
                                    '<tr><td class="nocenter"><i class="fa fa-user"></i>&nbsp;<b>Name:</b> ' +
                                    $('#customer_name').val() +
                                    '</td></tr>' +
                                    '<tr><td class="nocenter"><i class="fa fa-phone"></i>&nbsp;<b>Phone:</b> ' +
                                    $('#customer_phone').val() +
                                    '</td></tr>' +
                                    '<tr><td class="nocenter"><i class="fa fa-book"></i>&nbsp;<b>Address:</b> ' +
                                    $('#customer_post').val() + ' ' +
                                    $('#customer_street').val() + ' ' +
                                    $('#customer_city').val() +
                                    '</td></tr>'
                                );

                                $('#gtotal').append(
                                    '<tr>' +
                                    '<td colspan="7" rowspan="3" style="border-style:none;">' +
                                    '<table class="table table-bordered">' +
                                    '<thead>' +
                                    '<th style="background:lightgrey;">' +
                                    '<i class="fa fa-newspaper-o"></i>Notes' +
                                    '</th>' +
                                    '</thead>' +
                                    '<tbody>' +
                                    '<tr>' +
                                    '<td>' +
                                    '<textarea id="mnot" class="form-control" rows="3" style="font-size:14px;" readonly></textarea>' +
                                    '</td>' +
                                    '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '</td>' +
                                    '<td></td>' +
                                    '<td colspan="4">' +
                                    '<table class="table table-bordered">' +
                                    '<tbody>' +
                                    '<tr>' +
                                    '<td class="nocenter"><b>Gross Total:</b></td>' +
                                    '<td class="nocenter">' +
                                    $('#CURRENCY_SIGN').val() + ' ' +
                                    parseFloat(($('#gross_total').val())).toLocaleString() +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td class="nocenter"><b>GST (19)%:</b></td>' +
                                    '<td class="nocenter">' +
                                    $('#CURRENCY_SIGN').val() + ' ' +
                                    parseFloat(($('#gst_amount').val())).toLocaleString() +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td class="nocenter"><b>Net Total:</b></td>' +
                                    '<td class="nocenter">' +
                                    $('#CURRENCY_SIGN').val() + ' ' +
                                    parseFloat(($('#net_total').val())).toLocaleString() +
                                    '</td>' +
                                    '</tr>' +
                                    discount_section +
                                    paid_section +
                                    '<tr>' +
                                    '<td class="nocenter" style="background:lightgrey;"><b>Balance:</b></td>' +
                                    '<td class="nocenter">' +
                                    $('#CURRENCY_SIGN').val() + ' ' +
                                    parseFloat(($('#final_total').val())).toLocaleString() +
                                    '</td>' +
                                    '</tr>' +
                                    '</tbody>' +
                                    '</table>' +
                                    '</td>' +
                                    '</tr>'
                                );

                                $('#invoice tr').each(function (row, tr) {
                                    let is_gst_included = $(tr).find('td:eq(8) > input[type="checkbox"]').prop('checked');
                                    let gst_checkbox = ""
                                    if (is_gst_included) {
                                        gst_checkbox = "checked";
                                    }

                                    $('#inv').append(
                                        '<tr>' +
                                        '<td>' + $(tr).find('td:eq(0)').text() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(1) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(2) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(3) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(4) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(5) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(6) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(7) > input').val() + '</td>' +
                                        '<td><input type="checkbox" ' + gst_checkbox + ' readonly disabled/> </td>' +
                                        '<td>' + $(tr).find('td:eq(9) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(10) > input').val() + '</td>' +
                                        '<td>' + $(tr).find('td:eq(11) > input').val() + '</td>' +
                                        '</tr>'
                                    );

                                });
                                $('#mnot').val($('#notes').val());
                            }
                        </script>
                        </tbody>
                        <tfoot id="gtotal"></tfoot>
                    </table>
                </center>
                <!--    <center><p style="background:lightgrey; padding:5px;">Thank you for your business!</p></center>-->
                <!--    <p style="padding:20px;"><span style="float:left;"><b>Prepared by:_______________ </b></span><span style="float:right;"><b>Aprroved by:_______________</b></span>       </p>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveInvoice();" data-dismiss="modal"><i
                            class="fa fa-save"></i>&nbsp;Save
                </button>
                <button type="button" class="btn btn-primary" onclick="saveprintInvoice();"><i class="fa fa-save"></i>&nbsp;Save&amp;&nbsp;<i
                            class="fa fa-print"></i>&nbsp;Print
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close
                </button>

            </div>
        </div>
    </div>
</div>


<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/datepicker.js"></script>


<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#duedate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#billdate').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#billdate').datepicker('setValue', 'gotoCurrent');
    });
</script>
<script src="js/teppich_invoice.js"></script>
