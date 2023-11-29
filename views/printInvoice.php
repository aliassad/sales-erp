<html>

<head>
    <?php
    require_once("helpers.php");

    $billno = $_GET["billid"];
    if (isset($_GET["cid"])) {
        $cid = $_GET["cid"];
    }

    $result = query("select b.cid,b.amount,b.discount,DATE_FORMAT(b.date,'%d-%m-%Y') as date,DATE_FORMAT(b.ddate,'%d-%m-%Y') as ddate,b.notes,b.type,b.gst,b.billing_company from bill b where b.id='$billno'");


    while ($row = mysqli_fetch_array($result)) {
        $cid = $row['cid'];
        $amount = $row['amount'];
        $discount = $row['discount'];
        $date = $row['date'];
        $ddate = $row['ddate'];
        $note = $row['notes'];
        $type = $row['type'];
        $billing_company = $row['billing_company'];
        $gst = $row['gst'];
    }

    $result = query("select Sum(amount) as paid from billamounts where bid='$billno'");
    while ($row = mysqli_fetch_array($result)) {
        $paid = $row['paid'];
    }
    $result = query("select * from customer where id='$cid'");
    while ($row = mysqli_fetch_array($result)) {
        $address = $row['address'];
        $name = $row['name'];
        $phone = $row['phone'];
        $zip_code = $row['zip_code'];
        $city = $row['city'];
        $country = $row['country'];
        $customer_gst = $row['gst'];
    }
    $pending = ($amount + $gst) - $paid;

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
            font-size: 14px;
        }


        @page {
            webkit-print-color-adjust: exact;
            size: A4;
            /* auto is the initial value */
            /* this affects the margin in the printer settings */
            margin-left: 7mm;
            margin-right: 7mm;
            margin-top: 20mm;
            margin-bottom: 10mm;
            page-break-inside: avoid;

        }

        .box {
            margin: 10px;

        }
        body , .container{
            background-color: #eee8e1 !important;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 2px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: none !important;
        }

        @media print {
            * {
                color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>


</head>

<body style="margin-top:10px;">
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php if ($billing_company === "teppich_clean") { ?>
                <img src="../img/teppich_clean.png" class="img-responsive" width="160px" height="auto">
            <?php } else { ?>
                <img src="../img/carpet_world.png" class="img-responsive" width="160px" height="auto">
            <?php } ?>
        </div>
        <div class="col-sm-6">
            <h1 id="type" style="float: right;text-transform: uppercase"><?= $type; ?></h1>
        </div>
    </div>

    <div class="row box">
        <div class="col-sm-5" style="padding-left:0px;background: transparent !important;">

            <table class="table"  style="background: transparent !important;">
                <tbody id="tocustomer"  style="background: transparent !important;">
                <tr>
                    <td class="nocenter"><b><i class="fa fa-user"></i>&nbsp;Name:</b>
                        <?php echo $name; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><b><i class="fa fa-phone "></i>&nbsp;Phone:</b>
                        <?php echo $phone; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter"><b><i class="fa fa-book"></i>&nbsp;Address:</b>
                        <?php echo $zip_code . ' ' . $address . '<br> ' . $city . ', ' . $country; ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-sm-4 col-sm-offset-3" style="padding-right:0px;">
            <?php if ($billing_company === "teppich_clean") { ?>
                <table class="table table">
                    <tbody>
                    <tr>
                        <td class="nocenter">Teppich Clean24 Inh. Tipu Khan</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-building-o"></i>&nbsp;Im Taubental 40, 41468 Neuss</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-phone-square"></i>&nbsp;021 31/7 18 69-0</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-print"></i>&nbsp;021 31/7 18 69-21</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-envelope-open"></i>&nbsp;Info@teppich-clean24.de</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-globe"></i>&nbsp;www.teppich-clean24.de</td>
                    </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <table class="table table">
                    <tbody>
                    <tr>
                        <td class="nocenter">Carpet World24 Inh. Tipu Khan</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-building-o"></i>&nbsp;Im Taubental 40, 41468 Neuss</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-phone-square"></i>&nbsp;021 31/7 18 69-0</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-print"></i>&nbsp;021 31/7 18 69-21</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-envelope-open"></i>&nbsp;Info@carpet-world24.de</td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-globe"></i>&nbsp;www.carpet-world24.de</td>
                    </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
    <div class="row box">
        <b style="font-size: 16px"><?= $type; ?> No: <?php echo $billno; ?></b><input type="number" id="billno"
                                                                                      value="<?php echo $billno; ?>"
                                                                                      style="display:none;"/>
    </div>
    <div class="row box">
        <table class="table">
            <thead>
            <th class="text-center">
                <i class="fa fa-hashtag"></i>&nbsp;Pos.
            </th>
            <th class="text-center">
                Article no.
            </th>
            <th class="text-center">
                Origin
            </th>
            <th class="text-center">
                Description
            </th>
            <th class="text-center">
                Length
            </th>
            <th class="text-center">
                Width
            </th>
            <th class="text-center">
                QTY
            </th>
            <th class="text-center">
                SQM
            </th>
            <th class="text-center">
                Price Per SQM
            </th>
            <th class="text-center">
                <b>%</b>&nbsp;Discount
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;Amount
            </th>
            </thead>
            <tbody>
            <?php
            $result = query("SELECT l.*, p.article_no, p.origin,p.item_length,p.item_width, p.saleprice,p.des  FROM `lineitem` l, product p  WHERE l.bid = '$billno' and  l.product = p.id; ");
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td class="text-center"><?= $row['lid'] ?></td>
                    <td class="text-center"><?= $row['article_no'] ?></td>
                    <td class="text-center"><?= $row['origin'] ?></td>
                    <td class="text-center"><?= $row['des'] ?></td>
                    <td class="text-center"><?= $row['item_length'] ?></td>
                    <td class="text-center"><?= $row['item_width'] ?></td>
                    <td class="text-center"><?= $row['unit'] ?></td>
                    <td class="text-center"><?= number_format(($row['item_length'] * $row['item_width']) / 10000, 2); ?></td>
                    <td class="text-center"><?= $row['rate'] ?></td>
                    <td class="text-center"><?= $row['discount'] ?></td>
                    <td class="text-center"><?= $row['amount'] ?></td>
                </tr>
            <?php }
            ?>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="6" rowspan="3" style="border-style:none;">
                    <table class="table table-bordered">
                        <thead>
                        <th style="background:lightgrey;"><i class="fa fa-newspaper-o"></i>Notes</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <textarea id="mnot" class="form-control" rows="4" style="font-size:14px;"
                                          readonly><?= $note ?></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td colspan="4">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="nocenter"><b>Gross Total:</b></td>
                            <td class="nocenter">
                                <?= CURRENCY_SIGN . ' ' . number_format(($amount), 2) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>GST (<?= $customer_gst ?>)%:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($gst), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Net Total:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($amount + $gst), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Discount:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($discount), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Amount Received:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($paid), 2); ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter" style="background:lightgrey;"><b>Balance:</b></td>
                            <td class="nocenter"><?= CURRENCY_SIGN . ' ' . number_format(($pending - $discount), 2) ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <input id="cbalance" type="number" style="display:none;"
                   value="<?php echo $pending - $discount; ?>">
            </tfoot>
        </table>
    </div>
    <div class="row box">
        You are required to keep the invoice for tax purposes for two years.
        <p>
            Payable: Net upon receipt of Invoice Reductions In fees result from our current framework or conditions
        </p>
    </div>
    <div class="row box">
        <div class="col-sm-6">
            Sparkasse Neuss: Account number: 934 230 69 Bank code: 305 500 00<br>
            Sparkasse Neuss: IBAN: DE81 3055 0000 0093 4230 69
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"><b>
                Tax No. 125/5308/5032<br>
                UID No. DE 274915735
            </b>
        </div>
    </div>
    <div class="row box" style="padding: 20px">
        <div class="col-sm-3"></div>

        <?php if ($billing_company === "teppich_clean") { ?>
            <div class="col-sm-6">
                Terms and conditions at: <b>https://teppich-clean24.de/agb/</b>
            </div>
        <?php } else { ?>
            <div class="col-sm-6">
                Terms and conditions at: <b>https://carpet-clean24.de/agb</b>
            </div>
        <?php } ?>
    </div>

</div>
</body>

</html>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        // window.print();
        // setTimeout(function () {
        //     window.location = "../index.php?page=sell";
        // }, 2000);
    });

</script>    