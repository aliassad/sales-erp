

<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
           <div class="col-md-4" style="padding-left:0px">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=customers" class="btn btn-default"><i class="fa fa-group"></i>&nbsp;Customers</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-briefcase"></i>&nbsp;Stocks</a>
            </div>
        </div>


        <div class="col-md-8" style="margin-bottom:10px; margin-top:5px; padding:5px;">
             <a href="#" class="btn btn-md btn-success" style="float:right; "  onclick="clearModal();">
                <i class="fa fa-plus"></i>&nbsp;New Product</a>
            
        </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-4" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Product no#</span>
                    <input id="pno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-5" style="padding-left:5px; padding-right:3px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Product Name#</span>

                    <select id="pname" class="selectpicker show-tick" data-live-search="true" title='Select Product...' onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php
                        $result=query("select des from product"); 
                        while($row=mysqli_fetch_array($result))
                        {
                                echo '<option>'.$row['des'].'</option>';
                        }
                        ?>
                    </select>

                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file-text"></i><span class="break"></span>&nbsp;Products</h3>
            </div>
            <div class="panel-body" style="height:385px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" id="aPa" style="padding:0px;">
                        <thead>
                            
                            <th class="text-center">
                                <i class="fa  fa-barcode"></i>&nbsp;Product no#
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-edit"></i>&nbsp;Description
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-briefcase"></i>&nbsp;Stock
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-money"></i>&nbsp;Sale Price
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-money"></i>&nbsp;Purchase Price
                            </th>
                            <th class="text-center">
                                <b>%</b>&nbsp;Discount
                            </th>
                            <th class="text-center">
                                <i class="fa fa-minus-square"></i>&nbsp;Min Stock
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-edit"></i>&nbsp;
                            </th>
                            <th class="text-center">
                                <i class="fa  fa-trash"></i>&nbsp;
                            </th>
                        </thead>
                         
                        <tbody id="products">
                        </tbody>
                    </table>


                </div>
            </div>
        </div>



    </div>


</div>
</div>

<div class="modal fade" id="editStockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" tabindex="-1">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase fa-2x"></i>&nbsp;Edit Product:&nbsp;<span style="color:blue" id="dtitle"></span></h4>
            </div>
            <form>
            <div class="modal-body well">
                
                    <div class="row">
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i>&nbsp;Discription</span>
                                     <input type="text" id="epname" class="form-control"  tabindex="1">
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-briefcase"></i>&nbsp;Stock</span>
                                    <input id="estock" type="number" class="form-control"  tabindex="2"/>
                                </div>
                            </div>
                            </div>

                            <div class="row" style="padding-top:10px;">
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Sale Price</span>
                                    <input id="esprice" type="number" class="form-control"  tabindex="3"/>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Purchase Price</span>
                                    <input id="epprice" type="number" class="form-control"  tabindex="4"/>
                                </div>
                            </div>
                                </div>
                        <div class="row"  style="padding-top:10px;">
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><b>%</b>&nbsp;Discount</span>
                                    <input id="ediscount" type="number" class="form-control"  tabindex="5"/>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right:0px; ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-minus-square"></i>&nbsp;Min Stock</span>
                                    <input id="eminstock" type="number" class="form-control"  tabindex="6"/>
                                </div>
                            </div>
                        </div>

                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-custom" tabindex="7" onclick="saveEditProduct();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="8"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>
                </form>
        </div>
    </div>
</div>




<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" tabindex="-1">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase fa-2x"></i>&nbsp;New Product</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-edit"></i>&nbsp;Discription</span>
                                    <input id="discrip" type="text" class="form-control" tabindex="1" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-briefcase"></i>&nbsp;Stock</span>
                                    <input id="stock" type="number" class="form-control" tabindex="2"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Sale Price</span>
                                    <input id="sprice" type="number" class="form-control" tabindex="3" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Purchase Price</span>
                                    <input id="pprice" type="number" class="form-control" tabindex="4"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><b>%</b>&nbsp;Discount Percent</span>
                                    <input id="disc" type="number" class="form-control" tabindex="5" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-minus-square"></i>&nbsp;Min Stock</span>
                                    <input id="minstock" type="number" class="form-control" tabindex="6" />
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveProduct();" tabindex="7"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="8"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>
        </div>
    </div>
</div>




<!-- /.container-fluid -->
<!-- /#page-wrapper 
    <!-- /#wrapper -->
<script src="js/jquery.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/stocks.js"></script>