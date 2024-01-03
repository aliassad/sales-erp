<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
           <div class="col-md-6" style="padding-left:0px;">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=sell" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-file-text"></i>&nbsp;Production</a>
            </div>
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-md btn-primary" style="float:right; margin-top:10px;" onclick="storeValues();">
                    <i class="fa fa-print"></i>&nbsp;Print</a>
            </div>
            
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-3" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Order no#</span>
                    <input id="billno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Customer#</span>
                    <select id="customer" class="selectpicker show-tick" data-live-search="true" title="Enter Customer Name.." onchange="filter();">
                        <option class="btn-success">Show all</option>
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

            <div class="col-md-5" style="padding:0px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                    <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                    <span class="input-group-addon">  to</span>
                    <input id="tdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                </div>

            </div>





        </div>
        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-copy"></i><span class="break"></span>&nbsp;Orders</h3>
            </div>
            <div class="panel-body" style="height:395px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-striped table-hover" style="padding:0px;">
                        <thead>
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Order no#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Order Item no#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-user"></i>&nbsp;Customer
                            </th>
                            <th class="text-center">
                                <i class="fa fa-briefcase"></i>&nbsp;Product
                            </th>
                            <th class="text-center">
                                <i class="fa fa-file-text"></i>&nbsp;Discription
                            </th>
                            <th class="text-center">
                                <i class="fa fa-tasks"></i>&nbsp;Order Unit
                            </th>
                            <th class="text-center">
                                <i class="fa fa-tasks"></i>&nbsp;Sale Unit
                            </th>
                            <th class="text-center">
                                <i class="fa fa-tasks"></i>&nbsp;Remaining Unit
                            </th>
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Date
                            </th>  
                            <th class="text-center">
                                <i class="fa fa-file-text"></i>&nbsp;Notes
                            </th>
                            <th class="text-center">
                                <i class="fa fa-tag"></i>&nbsp;Status
                            </th>
                            <th class="text-center">
                                <i class="fa fa-edit"></i>&nbsp;
                            </th>
                        </thead>
                        <tbody id="productions">
                                
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>




    
    
    <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file fa-2x"></i>&nbsp;Order Notes </h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i>&nbsp;Notes</span>
                                   <textarea id="bnotes"  class="form-control"cols="10" rows="5" readonly></textarea>
                                </div>
                            </div> 
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>
            </div>
        </div>
    </div>
</div>
    
    
        <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit fa-2x"></i>&nbsp;Change Order Status</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil"></i>&nbsp;Order id</span>
                                     <input id='oid' type="text" class="form-control" readonly/>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i>&nbsp;Order Item id</span>
                                     <input id='oiid' type="text" class="form-control" readonly/>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                        <div class="form-group" style="margin-top:20px;">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-top:10px;">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i>&nbsp;Status</span>
                                     <select id="ostatus" class="form-control" placeholder='Select Status...'>
                                        <option value="0">Pending</option>
                                        <option value="1">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-custom" onclick="change();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>
        </div>
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
<script src="js/production.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/sweetalert.min.js"></script>
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#tdate').datepicker({
                    format: "dd-mm-yyyy"
                });    
                $('#fdate').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
            });
        </script>