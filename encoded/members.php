<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-md-6" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-credit-card"></i>&nbsp;Members</a>
                </div>
            </div>

            <div class="col-md-6" style="margin-bottom:10px; padding:5px;">
                <a href="#" class="btn btn-md btn-success" style="float:right;margin-top:5px;" data-toggle="modal" data-target="#newCustomerModal" onclick="clearModal();">
                    <i class="fa fa-plus"></i>&nbsp;New Member </a>

            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-4" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Member Ship No#</span>
                    <input id="pno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-5" style="padding-left:5px; padding-right:3px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Member Name#</span>
                    <select id="pname" class="selectpicker show-tick" data-live-search="true" title='Select Customer...' onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result=query("select name from member");
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




        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-credit-card"></i><span class="break"></span>&nbsp;Members</h3>
            </div>
            <div class="panel-body" style="height:375px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                        <th class="text-center">
                            <i class="fa fa-pencil"></i>&nbsp;Sr #
                        </th>
                        <th class="text-center">
                            <i class="fa fa-user"></i>&nbsp;Name
                        </th>
                        <th class="text-center">
                            <i class="fa fa-credit-card"></i>&nbsp;Member Ship no
                        </th>
                        <th class="text-center">
                            <i class="fa fa-phone"></i>&nbsp;Phone
                        </th>
                        <th class="text-center">
                            <i class="fa fa-book"></i>&nbsp;Address
                        </th>
                        </thead>
                        <tbody id="customers">
                        <tr id="loading"  ><td colspan="6"><center > <img src="img/loading.gif"> </center></td></tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>





</div>
</div>


<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;New Customer</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
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
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Member Ship no</span>
                                    <input id="cemail" type="number" class="form-control">
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
                                    <textarea id="caddress" type="text" class="form-control" rows="3" cols="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveCustomer();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
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
<script src="js/members.js"></script>
<script src="js/sweetalert.min.js"></script>
