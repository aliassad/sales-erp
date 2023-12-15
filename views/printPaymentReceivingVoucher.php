<html>

<head>
    <?php

    require_once("helpers.php");
    $cid = $_GET['cid'];
    $date = $_GET['date'];
    $amount = $_GET['amount'];
    $detail = $_GET['detail'];
    $mode = $_GET['mode'];
    $balance = $_GET['balance'];
    $balance = $balance - $amount;


    $result = query("select * from customer where id='$cid'");
    $name = "";
    $phone = "";
    $address = "";
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $phone = $row['phone'];
        $city = $row['city'];
        $address = $row['address'];
    }


    ?>


    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

    <style>
        th,
        thead, {

            background-color: #eee;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 2px;
            font-size: 12px;
        }

        @media print {
            #non-print-elem {
                display: none;
            }
        }

    </style>


</head>

<body>


<style>
    .row.vertical-divider {
        overflow: hidden;
    }

    .row.vertical-divider > div[class^="col-"] {

        text-align: center;
        border-left: 1px solid #000000;
        border-right: 1px solid #000000;

        border-style: dotted;

    }

    .row.vertical-divider div[class^="col-"]:first-child {
        border-left: none;
    }

    .row.vertical-divider div[class^="col-"]:last-child {
        border-right: none;
    }
</style>
<div class="row" style=" margin-top:0.2in;margin-bottom:0.2in;">
    <div class="col-xs-12 text-right">
        <a class="btn btn-info" href="../index.php?page=home" id="non-print-elem"><i class=" fa fa-undo"></i> Go To Home</a>
        <a class="btn btn-info" id="non-print-elem" onclick="window.print();"><i class=" fa fa-print"></i> Print</a>
    </div>
</div>
<div class="row vertical-divider">
    <div class="col-md-6">
        <center style="margin-bottom:2px;"><h6 id="type" style="border:4px double black;">Zahlungsbeleg</h6></center>
        <div class="row box">
            <div style="padding:2px;">

                <div class="col-md-12">
                    <table class="table" style="margin:0px; margin-bottom:15px;">
                        <tbody>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-user"></i>&nbsp;Name:</b>
                                <?php echo $name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i
                                            class="fa fa-phone "></i>&nbsp;Phone:</b>
                                <?php echo $phone; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-building "></i>&nbsp;City:</b>
                                <?php echo $city; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-address-book"></i>&nbsp;Address:</b>
                                <?php echo $address; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row box">
            <div style="padding:2px;">
                <table class="table" style="margin:0px;">
                    <thead>
                    <th class="text-center">
                        <i class="fa fa-calendar"></i>&nbsp;Date
                    </th>
                    <th>
                        <i class="fa fa-money"></i>&nbsp;Amount
                    </th>
                    <th>
                        <i class="fa fa-bars"></i>&nbsp;Payment Mode
                    </th>
                    <th class="text-center">
                        <i class="fa fa-file-text-o"></i>&nbsp;Detail
                    </th>
                    </thead>
                    <tbody class="items">
                    <tr>
                        <td><?php echo $date; ?></td>
                        <td><?php echo number_format(($amount), 2, ',', '.'); ?></td>
                        <td><?php echo $mode; ?></td>
                        <td><?php echo $detail; ?></td>
                    </tr>
                    </tbody>
                    <tfoot>

                    <?php

                    echo '<tr>
<td colspan="4" ><table class="table table-bordered" style="margin:100px 0px 0px 0px;"><tbody>
<tr><td class="nocenter" ><b>Total Amount Received:</b></td>
<td class="nocenter" style="font-weight:bold;font-size:14px;">' . number_format(($amount), 2, ',', '.') . CURRENCY_SIGN . '</td></tr><tr><td 
class="nocenter" ><b>Total Balance:</b></td><td class="nocenter" style="font-weight:bold;font-size:14px;">' . number_format($balance, 2, ',', '.') . CURRENCY_SIGN . '</td></tr></tbody></table>';
                    ?>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top:30%;">
            <hr>
            <p style="float:left;font-size: 10px;"><b>Note:</b>&nbsp;Computer Generated Slip is invalid Without
                Signature and Stamp.
            <p style="float:right">Signature
                and Stamp</p>
        </div>
    </div>

    <div class="col-md-6">
        <center style="margin-bottom:2px;"><h6 id="type" style="border:4px double black;">Zahlungsbeleg</h6></center>
        <div class="row box">
            <div style="padding:2px;">

                <div class="col-md-12">

                    <table class="table" style="margin:0px; margin-bottom:15px;">
                        <tbody>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-user"></i>&nbsp;Name:</b>
                                <?php echo $name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i
                                            class="fa fa-phone "></i>&nbsp;Phone:</b>
                                <?php echo $phone; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-building "></i>&nbsp;City:</b>
                                <?php echo $city; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-address-book"></i>&nbsp;Address:</b>
                                <?php echo $address; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row box">
            <div style="padding:2px;">
                <table class="table" style="margin:0px;">
                    <thead>
                    <th class="text-center">
                        <i class="fa fa-calendar"></i>&nbsp;Date
                    </th>
                    <th>
                        <i class="fa fa-money"></i>&nbsp;Amount
                    </th>
                    <th>
                        <i class="fa fa-bars"></i>&nbsp;Payment Mode
                    </th>
                    <th class="text-center">
                        <i class="fa fa-file-text-o"></i>&nbsp;Detail
                    </th>
                    </thead>
                    <tbody class="items">
                    <tr>
                        <td><?php echo $date; ?></td>
                        <td><?php echo number_format(($amount), 2, ',', '.'); ?></td>
                        <td><?php echo $mode; ?></td>
                        <td><?php echo $detail; ?></td>
                    </tr>
                    </tbody>
                    <tfoot>

                    <?php

                    echo '<tr>
<td colspan="4" ><table class="table table-bordered" style="margin:100px 0px 0px 0px;"><tbody>
<tr><td class="nocenter" ><b>Total Amount Received:</b></td><td class="nocenter" style="font-weight:bold;font-size:14px;">' . number_format(($amount), 2, ',', '.') . CURRENCY_SIGN . '
                     </td></tr><tr><td 
class="nocenter" ><b>Total Balance:</b></td><td class="nocenter" style="font-weight:bold;font-size:14px;">' . number_format($balance, 2, ',', '.') . CURRENCY_SIGN . '</td></tr></tbody></table>';

                    ?>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:30%;">
            <hr>
            <p style="float:left;font-size: 10px;"><b>Note:</b>&nbsp;Computer Generated Slip is invalid Without
                Signature and Stamp.
            <p style="float:right">Signature
                and Stamp</p>
        </div>
    </div>

</div>


<input type="text" id="ssid" value="<?php echo $cid; ?>" style="display:none;"/>
</body>

</html>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
