<?php
$lastMonth = date("d-M-Y", strtotime('-1 months'));
$today = date("d-M-Y");

?>

<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->

        <div class="row">
            <div class="col-md-4" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-book"></i>&nbsp;Reports</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default" style="margin-top:0px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart"></i><span class="break"></span>&nbsp;Reports</h3>
            </div>
            <div class="panel-body" >
                <div class="row">
                    <h3><label class="label label-default large"><i class="fa fa-cubes"></i>&nbsp;Inventory</label></h3>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Report Type#</span>
                            <select id="stock_report_type" class="selectpicker show-tick" data-live-search="true" title="Select Report Type.." >
                            <option>SALES LEDGER</option>
                            <option>STOCK LEDGER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                            <input id="stock_report_from" type="text" placeholder="click to select date" class="form-control" value="<?php echo $lastMonth;?>">
                            <span class="input-group-addon">  to</span>
                            <input id="stock_report_to" type="text" placeholder="click to select date" class="form-control" value="<?php echo $today;?>">
                        </div>

                    </div>
                    <div class="col-md-2" >
                        <button class="btn btn-info btn-md" onclick="showStockReport();">GO</button>
                    </div>
                </div>
                <div class="row">
                    <h3><label class="label label-default large"><i class="fa fa-users"></i>&nbsp;Vendor</label></h3>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Vendor#</span>
                            <select id="vid" class="selectpicker show-tick" data-live-search="true" title="Enter Vendor Name.." >
                                <?php
                                $result=query("select concat(id,': ',name) as name from vendor");
                                while($row=mysqli_fetch_array($result))
                                {
                                    echo '<option>'.$row['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding:0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                            <input id="from" type="text" placeholder="click to select date" class="form-control" value="<?php echo $lastMonth;?>">
                            <span class="input-group-addon">  to</span>
                            <input id="to" type="text" placeholder="click to select date" class="form-control" value="<?php echo $today;?>">
                        </div>

                    </div>
                    <div class="col-md-2" >
                        <button class="btn btn-info btn-md" onclick="showVendorReport();">GO</button>
                    </div>
                </div>
                <div class="row">
                    <h3><label class="label label-default large"><i class="fa fa-group"></i>&nbsp;Customer</label></h3>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Customer#</span>
                            <select id="cid" class="selectpicker show-tick" data-live-search="true" title="Enter Customer Name.." >
                                <?php
                                $result=query("select concat(id,': ',name) as name from customer");
                                while($row=mysqli_fetch_array($result))
                                {
                                    echo '<option>'.$row['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding:0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                            <input id="cfrom" type="text" placeholder="click to select date" class="form-control" value="<?php echo $lastMonth;?>">
                            <span class="input-group-addon">  to</span>
                            <input id="cto" type="text" placeholder="click to select date" class="form-control" value="<?php echo $today;?>">
                        </div>

                    </div>
                    <div class="col-md-2" >
                        <button class="btn btn-info btn-md" onclick="showCustomerReport();">GO</button>
                    </div>
                </div>
                <div class="row">
                    <h3><label class="label label-default large"><i class="fa fa-bank"></i>&nbsp;Account </label></h3>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Account#</span>
                            <select id="aid" class="selectpicker show-tick" data-live-search="true"
                                    title="Enter Account Name..">
                                <?php
                                $result = query("select concat(id,': ',code) as name from account");
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option>' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>


                        </div>
                    </div>
                    <div class="col-md-6" style="padding:0px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                            <input id="afrom" type="text" placeholder="click to select date" class="form-control"
                                   value="<?php echo $lastMonth; ?>">
                            <span class="input-group-addon">  to</span>
                            <input id="ato" type="text" placeholder="click to select date" class="form-control"
                                   value="<?php echo $today; ?>">
                        </div>

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-info btn-md" onclick="showAccountReport();">GO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>

    .row
    {
        padding-bottom:10px;
    }
</style>

<!-- #container-fluid -->
<!-- #page-wrapper #wrapper -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/jQuery-print.js"></script>
<script src="js/reports.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        $('#from').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });


        $('#to').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });
        $('#cfrom').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });


        $('#cto').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });

        $('#afrom').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });


        $('#ato').datepicker({
            format: "dd-M-yyyy"
        }).on('changeDate', function (ev) {
            // do what you want here
            $(this).datepicker('hide');
        });

    });


</script>

