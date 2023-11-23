<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-6" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-group"></i>&nbsp;Customers</a>
                </div>
            </div>

            <div class="col-md-6" style="margin-bottom:10px; padding:5px;">
                <a href="#" class="btn btn-md btn-success" style="float:right;margin-top:5px;" data-toggle="modal"
                   data-target="#newCustomerModal" onclick="clearModal();">
                    <i class="fa fa-plus"></i>&nbsp;New Customer </a>
                <a href="index.php?page=sell" class="btn btn-md btn-primary"
                   style="float:right;margin-top:5px; margin-right:5px;">
                    <i class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
                <a href="index.php?page=stock" class="btn btn-md btn-warning"
                   style="float:right;margin-top:5px; margin-right:5px;">
                    <i class="fa fa-briefcase"></i>&nbsp;Stock</a>

            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-4" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Customer #</span>
                    <input id="pno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Customer Name#</span>
                    <select id="pname" class="selectpicker show-tick" data-live-search="true" title='Select Customer...'
                            onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result = query("select name from customer");
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option>' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="padding-left:5px; padding-right:0px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;City#</span>
                    <select id="pcity" class="selectpicker show-tick" data-live-search="true" title='Select City...'
                            onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result = query("select name from cities order by name");
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option>' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-group"></i><span class="break"></span>&nbsp;Customers</h3>
            </div>
            <div class="panel-body" style="height:350px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                        <tr>
                            <th class="text-center">
                                Id #
                            </th>
                            <th class="text-center">
                                Customer #
                            </th>
                            <th class="text-center">
                                <i class="fa fa-user"></i>&nbsp;Name
                            </th>
                            <th class="text-center">
                                <i class="fa fa-home"></i>&nbsp;Company Name
                            </th>
                            <th class="text-center">
                                UID #
                            </th>
                            <th class="text-center">
                                Account #
                            </th>
                            <th class="text-center">
                                <i class="fa fa-building"></i>&nbsp;Country
                            </th>
                            <th class="text-center">
                                <i class="fa fa-building"></i>&nbsp;City
                            </th>
                            <th class="text-center">
                                Zipcode #
                            </th>
                            <th class="text-center">
                                <i class="fa fa-globe"></i>&nbsp;Email
                            </th>
                            <th class="text-center">
                                <i class="fa fa-phone"></i>&nbsp;Phone
                            </th>
                            <th class="text-center">
                                <i class="fa fa-phone-square"></i>&nbsp;Telephone
                            </th>
                            <th class="text-center">
                                <i class="fa fa-book"></i>&nbsp;Address
                            </th>
                            <th class="text-center">
                                GST %
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Amount Receivable
                            </th>
                        </tr>
                        </thead>
                        <tbody id="customers">
                        <tr id="loading">
                            <td colspan="8">
                                <center><img src="img/loading.gif"></center>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="panel-footer clearfix" style="padding-top: 0px; padding-bottom: 0px; margin: 0px;">
                <div class="col-lg-6 col-lg-offset-6" style="padding:0; ">
                    <table class="table" style="margin:0px;">
                        <tbody>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Receivable (<?= CURRENCY ?>):</span>
                                    <input type="text" id="total_Receivable" style="font-size:18px; font-weight: bold; "
                                           class="form-control" value="0" readonly
                                           tabindex="-1">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>
</div>


<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;New Customer</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="fa fa-money"></i>&nbsp;Opening Balance</span>
                                    <input id="opening_balance" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Customer #</span>
                                    <input type="text" id="ccustomer_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                    <input type="text" id="cname" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;Email</span>
                                    <input id="cemail" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-home"></i>&nbsp;Company Name</span>
                                    <input id="ccompany" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-building"></i>&nbsp;Country</span>
                                    <select id="ccountry" name="ccountry" class="selectpicker show-tick"
                                            data-live-search="true" title='Select
                                            Country...'>
                                        <?php
                                        $result = query("select country_name from countries order by country_name");
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option>' . $row['country_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i>&nbsp;City</span>
                                    <select id="ccity" name="ccity" class="selectpicker show-tick"
                                            data-live-search="true" title='Select
                                            City...'>
                                        <?php
                                        $result = query("select name from cities order by name");
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option>' . $row['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                                    <input id="cphone" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-money"></i>&nbsp;Telephone</span>
                                    <input id="ctelephone" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;UID No.</span>
                                    <input id="cuid_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Account No</span>
                                    <input id="caccount_number" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Zip Code</span>
                                    <input id="czip_code" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;GST %</span>
                                    <input id="cgst" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Address</span>
                                    <textarea id="caddress" type="text" class="form-control" rows="2"
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


<!-- /.container-fluid -->
<!-- /#wrapper -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/customers.js"></script>
<script src="js/sweetalert.min.js"></script>
