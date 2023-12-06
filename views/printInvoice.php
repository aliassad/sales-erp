<html>

<head>
    <?php
    require_once("helpers.php");

    $billno = $_GET["billid"];
    $isDL = isset($_GET["DL"]);
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

        #rectangle {
            margin: auto;
            width: 20px;
            height: 20px;
            background: none;
            border: 2px solid #444;
        }

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

        body, .container {
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

        .customer-title-table {
            margin-top: 4cm;
            margin-left: 2cm;
        }

        .customer-title-table td {
            font-size: 18px !important;
        }

        .customer-title-table-1 td {
            font-size: 18px !important;
        }

        .amount-section tr td:last-child {
            text-align: right;
        }

        .print-page-footer {
            height: auto;
            position: fixed;
            width: 100%;
            margin: auto;
            bottom: 10px;
        }
    </style>


</head>

<body style="margin-top:10px;">
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php if ($billing_company === "teppich_clean") { ?>
                <img src="../img/teppich_clean.png" class="img-responsive" width="180px" height="auto">
            <?php } else { ?>
                <img src="../img/carpet_world.png" class="img-responsive" width="180px" height="auto">
            <?php } ?>
        </div>
        <div class="col-sm-6">
            <h1 id="type" style="float: right;text-transform: uppercase">
                <?php if ($type === "Invoice") { ?>
                    <?php if ($isDL) { ?>
                        LIFERSCHEIN
                    <?php } else { ?>
                        RECHNUNG
                    <?php } ?>
                <?php } else { ?>
                    WÄSCHE-/REPARATURAUFTRAG
                <?php } ?>
            </h1>
        </div>
    </div>

    <div class="row box">
        <div class="col-sm-5" style="padding-left:0px;background: transparent !important;">
            <table class="table customer-title-table" style="background: transparent !important;">
                <tbody id="tocustomer" style="background: transparent !important;">
                <?php if ($billing_company === "teppich_clean") { ?>
                    <tr>
                        <td style="font-size: 16px !important;" class="nocenter">Teppich Clean24 Inh, Im Taubental 40,
                            41468 Neuss
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td style="font-size: 16px !important;" class="nocenter">Carpet World24 Inh. Tipu Khan, Im
                            Taubental 40, 41468 Neuss
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="nocenter">
                        <?php echo $name; ?>
                    </td>
                </tr>
                <tr>
                    <td class="nocenter">
                        <?php echo $address . '<br>' . $zip_code . ' ' . $city . ' <br>' . $country; ?>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-sm-4 col-sm-offset-3" style="padding-right:0px;">
            <?php if ($billing_company === "teppich_clean") { ?>
                <table class="table table customer-title-table-1">
                    <tbody>
                    <tr>
                        <td class="nocenter">Teppich Clean24 Inh.</td>
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
                <table class="table table customer-title-table-1">
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
        <div class="col-sm-7" style="text-align: right">
            <b style="font-size: 16px;text-align: center">
                <?php if ($type === "Invoice") { ?>
                    <?php if ($isDL) { ?>
                        Liferschein
                    <?php } else { ?>
                        Rechnungs
                    <?php } ?> Nr.
                <?php } else { ?>
                    Auftrags Nr.
                <?php } ?>
                <?php echo str_pad($billno, 6, '0', STR_PAD_LEFT);; ?></b><input type="number" id="billno"
                                                                                 value="<?php echo $billno; ?>"
                                                                                 style="display:none;"/>
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-4">
            <span class="nocenter" style="font-size: 14px;float: right"><i
                        class="fa fa-calendar"></i>&nbsp;<b>Datum: </b>
                <?= $date; ?>
            </span>
        </div>
    </div>
    <div class="row box">
        <table class="table">
            <thead>
            <th class="text-center">
                <i class="fa fa-hashtag"></i>&nbsp;Pos.
            </th>
            <th class="text-center">
                Artikle no.
            </th>
            <th class="text-left">
                herkunft
            </th>
            <th class="text-left">
                Bezeichnung
            </th>
            <th class="text-center">
                Lang
            </th>
            <th class="text-center">
                Breit
            </th>
            <th class="text-center">
                Menge
            </th>
            <th class="text-right">
                Qm
            </th>
            <?php if ($type !== "Invoice") { ?>
                <th class="text-center">
                    Wascne
                </th>
                <th class="text-center">
                    heratur
                </th>
            <?php } ?>
            <th class="text-center">
                VK/Qm
            </th>
            <th class="text-center">
                <b>%</b>&nbsp;Rabatt
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;Gesamt
            </th>
            </thead>
            <tbody>
            <?php
            $result = query("SELECT l.*, p.article_no, p.origin,p.item_length,p.item_width, p.saleprice,p.des  FROM `lineitem` l, product p  WHERE l.bid = '$billno' and  l.product = p.id; ");
            $index = 0;
            $unit_total = 0;
            $sqm_total = 0;
            while ($row = mysqli_fetch_array($result)) {
                $index++;
                $unit_total = $unit_total + $row['unit'];
                $sqm = (($row['item_length'] * $row['item_width']) / 10000);
                $sqm_total = $sqm_total + $sqm;
                ?>
                <tr>
                    <td class="text-center"><?= $index ?></td>
                    <td class="text-center"><?= $row['article_no'] ?></td>
                    <td class="text-left"><?= $row['origin'] ?></td>
                    <td class="text-left"><?= $row['des'] ?></td>
                    <td class="text-center"><?= number_format($row['item_length'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?= number_format($row['item_width'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?= $row['unit'] ?></td>
                    <td class="text-right"><?= number_format($sqm, 2, ',', '.'); ?></td>
                    <?php if ($type !== "Invoice") { ?>
                        <td class="text-center">
                            <div id="rectangle"></div>
                        </td>
                        <td class="text-center">
                            <div id="rectangle"></div>
                        </td>
                    <?php } ?>
                    <td class="text-center"><?= number_format($row['rate'], 2, ',', '.'); ?></td>
                    <td class="text-center"><?= $row['discount'] ?></td>
                    <td class="text-center"
                        style="text-align: right; padding-right: 5px"><?= number_format($row['amount'], 2, ',', '.') . CURRENCY_SIGN; ?></td>
                </tr>
            <?php }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= $unit_total ?></td>
                <td class="text-right"><?= number_format($sqm_total, 2, ',', '.'); ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="<?= ($type === "Invoice") ? '6' : '8'; ?>" rowspan="3" style="border-style:none;">
                    <table class="table table-bordered">
                        <thead>
                        <th style="background:lightgrey;"><i class="fa fa-newspaper-o"></i>Anmerkungen</th>
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
                        <tbody class="text-center amount-section">
                        <tr>
                            <td class="nocenter"><b>Nettobetrag:</b></td>
                            <td class="nocenter">
                                <?= number_format(($amount), 2, ',', '.') . CURRENCY_SIGN; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>GST (<?= $customer_gst ?>)%:</b></td>
                            <td class="nocenter"><?= number_format(($gst), 2, ',', '.') . CURRENCY_SIGN; ?></td>
                        </tr>
                        <tr>
                            <td class="nocenter"><b>Rechnungs betrag:</b></td>
                            <td class="nocenter"><?= number_format(($amount + $gst), 2, ',', '.') . CURRENCY_SIGN; ?></td>
                        </tr>
                        <?php if ($discount * 1 > 0) { ?>
                            <tr>
                                <td class="nocenter"><b>Rabatt:</b></td>
                                <td class="nocenter"><?= number_format(($discount), 2, ',', '.') . CURRENCY_SIGN; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="nocenter"><b>Erhaltener Betrag:</b></td>
                            <td class="nocenter"><?= number_format(($paid), 2, ',', '.') . CURRENCY_SIGN; ?></td>
                        </tr>

                        <tr>
                            <td class="nocenter" style="background:lightgrey;"><b>Offener Betrag:</b></td>
                            <td class="nocenter"><?= number_format(($pending - $discount), 2, ',', '.') . CURRENCY_SIGN; ?>
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
    <div class="print-page-footer">
        <?php if ($type === "Invoice") { ?>
            <div class="row box">
                Sie sind verpflichtet, die Rechnung zu Steuerzwecken zwei Jahre lang aufzubewahren
                <p>
                    Zahibar: Nach Rechnungserhalt Netto
                    Entgeltminderungen ergeben sich us unserer aktuellen Rahmen- ode Konditionsbedingungen.
                </p>
            </div>
            <div class="row box">
                <div class="col-sm-6" style="padding-left: 0px">
                    Sparkasse Neuss: Account number: 934 230 69 Bank code: 305 500 00<br>
                    Sparkasse Neuss: IBAN: DE81 3055 0000 0093 4230 69
                </div>
                <div class="col-sm-3">
                    <b style="font-size: 18px">Gerichtsstand Neuss</b>
                </div>
                <div class="col-sm-3"><b>
                        Steuer Nr. 125/5308/5032<br>
                        UID Nr. DE 274915735
                    </b>
                </div>
            </div>
        <?php } else { ?>
            <div class="row box">
                <p>Für die Bearbeitung der Stücke benötigen wir je nach Saison und Auslastung ca. 6 Werktage
                    Gegenstand des Auftrages ist immer die ordnungsgemäße und komplette Durchführung der Wäsche.
                    Eine Gewähr für eine voliständige Entfernung von Flecken, Verfärbungen und anderer
                    gebrauchsbedingter Veränderungen, insbesondere der Versuch in Eigenarbeit diese
                    zu entfernen, ist damit ausdrücklich nicht verbunden.
                    Die Zusatzbehandlungen Appretur, Imprägnierung und Hygienespülung können ur in Verbindung
                    mit einer Reinigung bestellt werden.</p>
                <p>Sonderbehandlung von Flecken* und Verlärbungen* nur auf Bestellung. Die Berechnung
                    erfogt nach Kostenvoranschlag ode nach Zeitaufwand
                    *onne triolasgarante.</p>
            </div>
        <?php } ?>

        <div class="row box" style="padding: 20px">
            <div class="col-sm-3"></div>
            <?php if ($billing_company === "teppich_clean") { ?>
                <div class="col-sm-6 text-center">
                    AGB unter: <b>https://teppich-clean24.de/agb</b>
                </div>
            <?php } else { ?>
                <div class="col-sm-6 text-center">
                    AGB unter: <b>https://carpet-world24.de/pages/allgemeine-geschaftsbedingungen-agb</b>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>

</html>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script type="text/javascript">
    // When the document is ready


    $(document).ready(function () {
        window.print();
        setTimeout(function () {
            window.location = "../index.php?page=sell";
        }, 2000);
    });

</script>