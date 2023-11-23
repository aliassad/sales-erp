<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-md-5" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-money"></i>&nbsp;Cheques</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-md-4" style="padding-left:0px">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-slack"></i>&nbsp;Cheque Serial</span>
                    <input id="eno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle-o"></i>&nbsp;Party Name</span>
                    <select id="ename" class="selectpicker show-tick" data-live-search="true" title='Select Party' onchange="filter();">
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
            <div class="col-md-4" style="padding-right:0px">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bank"></i>&nbsp;Bank</span>
                    <input type="text" id="ecity" class="form-control"  />
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-md-6" style="padding-left:0px">
                <div class="input-group">
                    <span class="input-group-addon" title="Select Date Range"><i class="fa fa-caret-square-o-down"></i></span>
                    <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                    <span class="input-group-addon">  to</span>
                    <input id="tdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                </div>
            </div>
            <div class="col-md-6" style="padding-right:0px">
                <div class="input-group">
                    <span class="input-group-addon" title="Select Due Date Range"><i class="fa fa-bullhorn"></i></span>
                    <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                    <span class="input-group-addon">  to</span>
                    <input id="tdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                </div>
            </div>
        </div>

        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i><span class="break"></span>&nbsp;Cheques</h3>
            </div>
            <div class="panel-body" style="height:350px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                        <tr>
                            <th><i class="fa fa-lg fa-sort-desc "></i><b class="small hidden-xs" style="font-weight:normal"></b></th>
                            <th ><i class="fa fa-lg fa-slack "></i><b class="small hidden-xs" style="font-weight:normal"> S&nbsp;No.</b></th>
                            <th ><i class="fa fa-lg fa-money "></i><b class="small hidden-xs" style="font-weight:normal"> Cheque No.</b></th>
                            <th><i class="fa fa-lg fa-user-circle-o"></i><b class="small hidden-xs" style="font-weight:normal"> Party Name</b></th>
                            <th><i class="fa fa-lg fa-bank"></i><b class="small hidden-xs" style="font-weight:normal"> Bank</b></th>
                            <th><i class="fa fa-lg fa-caret-square-o-down"></i><b class="small hidden-xs" style="font-weight:normal"> Receive</b></th>
                            <th><i class="fa fa-lg fa-bullhorn"></i><b class="small hidden-xs" style="font-weight:normal"> Due</b></th>
                            <th><i class="fa fa-lg fa-dollar"></i><b class="small hidden-xs" style="font-weight:normal"> Amount</b></th>
                            <th><i class="fa fa-lg fa-tag"></i><b class="small hidden-xs" style="font-weight:normal"> Status</b></th>
                            <th><i class="fa fa-lg fa-gear"></i><b class="small hidden-xs" style="font-weight:normal"> Action</b></th>
                        </tr>
                        </thead>
                        <tbody id="cheques">
                        <tr id="loading"  ><td colspan="11"><center > <img src="img/loading.gif"> </center></td></tr>
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
<!--                                <div class="input-group">-->
<!--                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Payable (PKR):</span>-->
<!--                                    <input type="text" id="total_Payable" style="font-size:18px; font-weight: bold; " class="form-control" value="0" readonly-->
<!--                                           tabindex="-1">-->
<!--                                </div>-->
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
<script src="js/cheques.js"></script>
<script src="js/sweetalert.min.js"></script>