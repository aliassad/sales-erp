<?php 
$table=$_GET['TableData'];


?>
    <html>

    <head>


        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/taffy-min.js"></script>
        <script src="../js/jquery.json-2.4.min.js"></script>



        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <style>
            th,
            thead,
            {
                background-color: #eee;
            }
            
            .table > thead > tr > th,
            .table > tbody > tr > th,
            .table > tfoot > tr > th,
            .table > thead > tr > td,
            .table > tbody > tr > td,
            .table > tfoot > tr > td {
            padding: 2px;
                font-size: 10px;
            }
            
            @media print {
                * {
                    -webkit-print-color-adjust: exact;
                }
            }
            
            @page {
                webkit-print-color-adjust: exact;
                size: A4;
                /* auto is the initial value */
                /* this affects the margin in the printer settings */
                margin-left: 2mm;
                margin-right: 2mm;
                margin-top: 20mm;
                margin-bottom: 10mm;
                break-inside: avoid-column;
            }
            
            .box {
                margin: 10px;
            }
        </style>


    </head>

    <body style="margin-top:10px;">
        <center style="margin-bottom:2px;">
            <b><h5><span>Production&nbsp;Sheet&nbsp;Print&nbsp;View&nbsp;<?php echo date("F j, Y, g:i a");?></span></h5></b></center>
        <div class="row box">
        </div>
        <div class="row box">
            <div style="padding:2px;">
                <table class="table table-striped" style="margin:0px;">
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
                                <i class="fa fa-tasks"></i>&nbsp;Unit
                            </th>
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Date
                            </th>  
                            <th class="text-center">
                                <i class="fa fa-tag"></i>&nbsp;Status
                            </th>
                        </thead>
                    <tbody>
                    <?php        
                        $tableData = json_decode($table,TRUE);
                        for($i=0;$i<count($tableData);$i++)
                        {
                            
                        echo '<tr><td>'.$tableData[$i]['id'].'</td><td>'.$tableData[$i]['iid'].'</td><td class="nocenter">'.$tableData[$i]['name'].'</td><td>'.$tableData[$i]['product'].'</td><td>'.$tableData[$i]['dis'].'</td><td>'.$tableData[$i]['unit'].'</td><td>'.$tableData[$i]['date'].'</td><td>'.$tableData[$i]['status'].'</td></tr>';    
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>

 <script type="text/javascript">
           
           
            
      $(document).ready(function () {
       setTimeout(function(){ window.print();
                             window.location="../index.php?page=production";
                            },800);

  
  
       
    });
            
</script>    

