<?php
require_once("helpers.php");

$party = $_GET['report_type'];
$from = $_GET['from'];
$to = $_GET['to'];
$totalCredit = 0;
$totalDebit = 0;
$report_type = "";
$data = array();
if ($_GET['report_type'] == "STOCK LEDGER") {
    $report_type = "stock_ledger";
    $result = query('SELECT p.*,(select concat(v.id,":",v.vendor_no," ",v.name) from vendor v where v.id = p.vendor_id) as vendor_no  from product as p');
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'id' => $row['id'],
            'des' => $row['des'],
            'stock' => $row['stock'],
            'sprice' => $row['saleprice'],
            'pprice' => $row['purchaseprice'],
            'minstock' => $row['minstock'],
            'disc' => $row['discount'],
            'item_length' => $row['item_length'],
            'item_width' => $row['item_width'],
            'square_meter' => $row['square_meter'],
            's_no' => $row['s_no'],
            'article_no' => $row['article_no'],
            'origin' => $row['origin'],
            'vendor_no' => $row['vendor_no'],
        );
        array_push($data, $row_data);
    }
} else {
    $report_type = "sale_ledger";
    $result = query("select concat(' Bill Id: ',b.id,' QTY: ', l.unit,' ',
    (select concat(' Art no: ',p.article_no,', ',p.item_length,'*',p.item_width,' SQM: ', ROUND(p.item_length*p.item_width/10000,2) ) from product p where p.id = l.product )) as des, 
     l.amount as debit,
       (select gst from customer c where c.id = b.cid)as customer_gst,
        DATE_FORMAT(b
        .date,'%d-%m-%Y') as date  from 
        `bill` b,
        `lineitem` l where l
        .bid=b.id 
        and b.type='Invoice' and
        b.date BETWEEN 
        STR_TO_DATE
        ('$from','%d-%M-%Y') AND STR_TO_DATE('$to','%d-%M-%Y')");


    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            'des' => $row['des'],
            'debit' => ($row['debit']),
            'date' => $row['date'],
            'customer_gst' => $row['customer_gst']
        );
        array_push($data, $row_data);
    }
}

function ResolveSign($val)
{
    if ($val <= -1) {
        $val = $val * -1;
        $val = number_format($val, 2, ',', '.');
        $val .= " Dr.";
        return $val;
    } else if ($val >= 1) {
        $val = number_format($val, 2, ',', '.');
        return $val . " Cr.";
    }
    return number_format($val, 2, ',', '.');

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/taffy-min.js"></script>
    <script src="../js/jquery.json-2.4.min.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <style>
        @media print {
            #non-print-elem {
                display: none;
            }

            body {
                margin: 0px;
            }

            a[href] {
                content: none;
            }

            @page {
                margin: 10mm 10mm 10mm 10mm;
                size: 8.27in 11.69in;
            }
        }

        .table {
            border: 1px solid;
        }

        .table tbody th, .table tbody td {
            border-top: none !important;
            border-right: 1px solid;
        }

        .table thead th, .table thead td {
            border: none;
            border-right: 1px solid;
            border-bottom: 1px solid;
        }

        .table tfoot th, .table tfoot td {
            border: 1px solid;
            border: 1px solid;

        }


    </style>
</head>
<style>
    td {
        /* text-align: center; */
        text-align: inherit;
    }

    body {
        counter-reset: page
    }

    div.page {
        page-break-before: always;
        counter-increment: page
    }

    div.page:after {
        display: block;
        text-align: right;
        content: counter(page)
    }

    div.first.page {
        page-break-before: avoid
    }
</style>


<body style="background-color: white; font-size:12px;  ">

<div class="row" style=" margin-top:0.2in;">
    <div class="col-xs-12 text-right">
        <a class="btn btn-info" id="non-print-elem" onclick="window.print()"><i class=" fa fa-print"></i> Print</a>
    </div>
</div>
<div class="row" style="min-height:0.4in; max-height:0.4in">

    <div class="col-xs-12 text-center">
        <h3>INVENTUR</h3>
    </div>

</div>
<div class="row" style="min-height:0.75in; max-height:0.75in">
    <div class="col-xs-6">
        <div class="customer-details"><u>Tipu Khan Im Taubental 40, 41468 Neuss</u></div>
    </div>
    <div class="col-xs-6" style="text-align:right">
        <span class="small"><b>From: </b></span>
        <span class="customer-details very-small"><u><?php echo date("d-M-Y", strtotime($from)); ?></u></span>
        <span class="small"><b>To: </b></span>
        <span class="customer-details very-small"><u><?php echo date("d-M-Y", strtotime($to)); ?></u></span>
    </div>
</div>

<div class="row">
    <?php if ($report_type == "stock_ledger") { ?>
        <div style="margin-top:0px; padding: 0px" class="col-xs-12">
            <table class="table table-condensed" style="margin: 0px">
                <thead id="invoice-view-table-head">
                <tr>
                    <th class="text-center" width="5">
                        Id
                    </th>
                    <th class="text-center" width="5">
                        Sr
                    </th>
                    <th class="text-center" width="5">
                        Article
                    </th>
                    <th class="text-center" width="7">
                        Origin
                    </th>
                    <th class="text-center" width="15">
                        Description
                    </th>
                    <th class="text-center" width="5">
                        Length <span class="small">(cm)</span>
                    </th>
                    <th class="text-center" width="5">
                        Width <span class="small">(cm)</span>
                    </th>
                    <th class="text-center" width="5">
                        Square Meter
                    </th>
                    <th class="text-center" width="5">
                        Stock
                    </th>
                    <th class="text-center" width="7">
                        Purchase Per Sqm
                    </th>
                    <th class="text-center" width="7">
                        Total Price
                    </th>
                    <th class="text-center" width="13">
                        Vendor
                    </th>
                    <th class="text-center" width="6">
                        Remarks
                    </th>
                </tr>
                </thead>
                <tbody id="invoice-view-table-body">
                <?php
                $stock_total = 0;
                $square_meter_total = 0;
                $total_price = 0;
                foreach ($data as $stock_row) {
                    $square_meter = number_format(($stock_row['item_length'] * $stock_row['item_width']) / 10000, 2);
                    $price_per_meter = number_format($square_meter * $stock_row['sprice'], 2);
                    if ($stock_row['stock'] > 0) {
                        $stock_total = $stock_total + $stock_row['stock'];
                    }
                    if ($square_meter > 0) {
                        $square_meter_total = $square_meter_total + $square_meter;
                    }

                    if ($price_per_meter > 0) {
                        $total_price = $total_price + $price_per_meter;
                    }
                    ?>
                    <tr>
                        <td><?= $stock_row['id'] ?></td>
                        <td><?= $stock_row['s_no'] ?></td>
                        <td><?= $stock_row['article_no'] ?></td>
                        <td><?= $stock_row['origin'] ?></td>
                        <td><?= $stock_row['des'] ?></td>
                        <td><?= $stock_row['item_length'] ?></td>
                        <td><?= $stock_row['item_width'] ?></td>
                        <td><?= $square_meter ?></td>
                        <td><?= $stock_row['stock'] ?></td>
                        <td><?= $stock_row['pprice'] . CURRENCY_SIGN ?></td>
                        <td><?= $price_per_meter . CURRENCY_SIGN ?></td>
                        <td><?= $stock_row['vendor_no'] ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7" style="text-align:right; font-size:18px;"></th>
                    <th colspan="1" style="font-size:18px;"><?= $square_meter_total; ?></th>
                    <th colspan="1" style="font-size:18px;"><?= $stock_total; ?></th>
                    <th colspan="1" style="font-size:18px;"></th>
                    <th colspan="1" style="font-size:18px;"><?= $total_price; ?></th>
                    <th colspan="1" style="font-size:18px;"></th>
                    <th colspan="1" style="font-size:18px;"></th>
                </tr>

                </tfoot>
            </table>
        </div>
    <?php } else { ?>
        <div class="row">
            <div style="margin-top:0px;" class="col-xs-12">
                <table class="table table-condensed">
                    <thead id="invoice-view-table-head">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Total Amount</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody id="invoice-view-table-body">
                    <?php
                    $i = 2;
                    $openingBlanace = $totalCredit - $totalDebit;
                    for ($j = 0; $j < count($data); $j++) {
                        $totalCredit += $data[$j]['credit'];

                        $total_debit_with_gst = $data[$j]['debit'] + (number_format($data[$j]['debit'] * $data[$j]['customer_gst'] / 100, 2)) * 1.0;

                        $totalDebit += $total_debit_with_gst;

                        echo '<tr><td class="text-center">' . $i . '</td><td>' . $data[$j]['date'] . '</td><td >' . $data[$j]['des'] . '</td><td>' . number_format($total_debit_with_gst, 2, ',', '.') . '</td><td>' . ResolveSign($totalCredit - $totalDebit) . '</td></tr>';
                        $i++;
                    }

                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right; font-size:18px;">Total</th>
                        <th colspan="1"
                            style="font-size:18px;"><?php echo ResolveSign($totalCredit - $totalDebit); ?></th>
                    </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    <?php } ?>

</body>
</html>
