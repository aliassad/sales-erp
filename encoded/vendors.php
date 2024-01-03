<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-md-5" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="index.php?page=accounts" class="btn btn-default"><i class="fa fa-dollar"></i>&nbsp;Accounts</a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-group"></i>&nbsp;Company Vendors</a>
                </div>
            </div>
            <div class="col-md-7" style="margin-bottom:10px; padding:5px;">
                <a href="#" class="btn btn-md btn-success" style="float:right; margin:5px; margin-right:0px;" data-toggle="modal" data-target="#newEmployeeModal" onclick="clearModal();">
                    <i class="fa fa-plus"></i>&nbsp;New Vendor </a>
               
            </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-md-4" style="padding-left:0px">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Vendor ID#</span>
                    <input id="eno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Vendor Name#</span>
                    <select id="ename" class="selectpicker show-tick" data-live-search="true" title='Select Vendor...' onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result=query("select name from vendor order by name");
                        while($row=mysqli_fetch_array($result))
                        {
                                echo '<option>'.$row['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;City#</span>
                    <select id="ecity" class="selectpicker show-tick" data-live-search="true" title='Select City...' onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result=query("select name from cities order by name");
                        while($row=mysqli_fetch_array($result))
                        {
                                echo '<option>'.$row['name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>

        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-group"></i><span class="break"></span>&nbsp;Company Vendors</h3>
            </div>
            <div class="panel-body" style="height:350px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class="fa fa-pencil"></i>&nbsp;Id#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-user"></i>&nbsp;Name
                            </th>
                            <th class="text-center">
                                <i class="fa fa-phone"></i>&nbsp;Phone
                            </th>
                            <th class="text-center">
                                <i class="fa fa-building"></i>&nbsp;City
                            </th>
                            <th class="text-center">
                                <i class="fa fa-book"></i>&nbsp;Address
                            </th>
                            <th class="text-center">
                                <i class="fa fa-globe"></i>&nbsp;Email
                            </th>
                            <th class="text-center">
                                <i class="fa fa-home"></i>&nbsp;Company Name
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Amount Payable
                            </th>
                        </tr>
                        </thead>
                        <tbody id="vendors">
                        <tr id="loading"  ><td colspan="8"><center > <img src="img/loading.gif"> </center></td></tr>
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
                                <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Payable (PKR):</span>
                            <input type="text" id="total_Payable" style="font-size:18px; font-weight: bold; " class="form-control" value="0" readonly
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


<div class="modal fade" id="newEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;New Vendor</h4>
            </div>
            <div class="modal-body well">
                <form id="vendorForm">
                    <div class="row">
                        <div class="col-md-8" style="padding-right: 0px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6" style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                            <input name="vname" id="vname" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;NIC</span>
                                            <input name="vnic" id="vnic" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;Email</span>
                                            <input name="vemail" id="vemail" type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                                            <input name="vphone" id="vphone" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6" style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Address</span>
                                            <textarea name="vaddress" id="vaddress" type="text" class="form-control" rows="2" cols="5" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i>&nbsp;Company Name</span>
                                            <textarea name="vcompany" id="vcompany" type="text" class="form-control" rows="2" cols="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-building-o"></i>&nbsp;City</span>
                                            <select id="vcity" name="vcity" class="selectpicker show-tick" data-live-search="true" title='Select
                                            City...' >
                                                <?php
                                                $result=query("select name from cities order by name");
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    echo '<option>'.$row['name'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Opening Balance</span>
                                            <input name="vopening_balance" id="vopening_balance" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <img class="img-responsive" id="preview" src="img/img.jpg" style="max-height:150px; max-width:230px;" />
                                    <input tabindex="-1" style="margin-top:10px; padding:5px; max-width:95%;" class="btn btn-primary btn-sm" name="eimage" id="eimage" type="file" name="p4" onchange="PreviewImage();" />

                                </div>
                            </div>

                        </div>




                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveEmployee();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>






<!-- /.container-fluid -->
<!-- /#page-wrapper 
    <!-- /#wrapper -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/vendors.js"></script>
<script src="js/sweetalert.min.js"></script>