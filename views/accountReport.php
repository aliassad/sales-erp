<?php
require_once("helpers.php");

$party = $_GET['vname'];
$from = $_GET['from'];
$to = $_GET['to'];
$totalCredit=0;
$totalDebit=0;



$result=query("select id,code,type,openingbalance from account where concat(id,': ',code)='$party';");
while($row=mysqli_fetch_array($result)) {
    $pid = $row['id'];
    $pname=$row['code'];
    $type=$row['type'];
    $openingbalance=$row['openingbalance'];
}
$totalCredit=$openingbalance;

$result=query("select sum(credit) as credit  from `accounttransaction` where aid='$pid' and date < STR_TO_DATE('$from','%d-%M-%Y')");
while($row=mysqli_fetch_array($result))
    $totalCredit+=$row['credit'];


$result=query("select sum(debit) as debit  from `accounttransaction` where aid='$pid' and date < STR_TO_DATE('$from','%d-%M-%Y')");
while($row=mysqli_fetch_array($result))
    $totalDebit+=$row['debit'];







$data=array();
$result=query("select discription as des,credit,DATE_FORMAT(date,'%d-%M-%Y') as date  from `accounttransaction` where aid='$pid' and date
 BETWEEN 
STR_TO_DATE
('$from','%d-%M-%Y') AND STR_TO_DATE('$to','%d-%M-%Y') ");

while($row = mysqli_fetch_array($result)){

    if($row['credit'] !=0){
    $row_data = array(
        'des' => $row['des'],
        'debit' => 0,
        'credit' => $row['credit'],
        'date' =>$row['date']
    );
    array_push($data, $row_data);
    }
}

$result=query("select discription as des,debit,DATE_FORMAT(date,'%d-%M-%Y') as date  from `accounttransaction` where aid='$pid' and date BETWEEN 
STR_TO_DATE
('$from','%d-%M-%Y') AND STR_TO_DATE('$to','%d-%M-%Y') ");

while($row = mysqli_fetch_array($result)){

if($row['debit'] !=0){
    $row_data = array(
        'des' => $row['des'],
        'debit' =>$row['debit'],
        'credit' =>0,
        'date' =>$row['date']
    );
    array_push($data, $row_data);
}
}


function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}
function verifyAndInWords($string) {
    $comma = strrpos ($string, ",");
    if(!$comma) return $string;
    $and = strrpos($string, " and ");

    if($and) return $string;

    $string = substr($string, 0, $comma) . " and ". substr($string, $comma+1);
    return $string;
}
function ResolveSign($val) {
    if($val <= -1) {
        $val = $val * -1;
        $val .= " Dr.";
        return $val;
    }
    else if($val >= 1) {
        return $val." Cr.";
    }
    return $val;

}



function date_compare($a, $b)
{
    $t1 = strtotime($a['date']);
    $t2 = strtotime($b['date']);
    return $t1 - $t2;
}
usort($data, 'date_compare');


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--    <title>--><?php //echo COMPANY_NAME; ?><!--</title>-->

    <!-- Bootstrap Core CSS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/taffy-min.js"></script>
    <script src="../js/jquery.json-2.4.min.js"></script>



    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <style>
        @media print {
            #non-print-elem {
                display:none;
            }
            body {
                margin: 0px;
            }
            a[href] {
                content: none;
            }
            @page
            {
                margin: 10mm 10mm 10mm 10mm;
                size: 8.27in 11.69in;
            }
        }
        .table {
            border: 1px solid;
        }

        .table tbody th, .table tbody td {
            border-top: none !important;
            border-right:1px solid;
        }
        .table thead th, .table thead td {
            border: none;
            border-right:1px solid;
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
</style>


<body style="background-color: white; font-size:12px;  ">

<div class="row" style=" margin-top:0.2in;">
    <div class="col-xs-12 text-right">
        <a class="btn btn-info" id="non-print-elem" onclick="window.print();"><i class=" fa fa-print"></i> Print</a>
    </div>
</div>
<div class="row" style="min-height:0.4in; max-height:0.4in">

    <div class="col-xs-12 text-center" >
        <h3>Ledger</h3>
    </div>

</div>
<div class="row" style="min-height:0.75in; max-height:0.75in">
    <div class="col-xs-6">
        <div><b>Party:</b></div>
        <div class="customer-details"><u><?php echo $pname."     (".$type. ")"; ?></u></div>
    </div>

    <div class="col-xs-6" style="text-align:right">
        <span class="small"><b>From: </b></span>
        <span class="customer-details very-small"><u><?php echo date("d-M-Y", strtotime($from)); ?></u></span>
        <span class="small"><b>To: </b></span>
        <span class="customer-details very-small"><u><?php echo date("d-M-Y", strtotime($to)); ?></u></span>
    </div>

</div>
<div class="row">
    <div style="margin-top:0px;" class="col-xs-12">
        <table class="table table-condensed">
            <thead id = "invoice-view-table-head">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody id = "invoice-view-table-body">
            <tr><td class="text-center">1</td><td>--</td><td>Opening Balance</td><td>--</td><td>--</td><td><?php echo ResolveSign($totalCredit-$totalDebit);
                    ?></td></tr>
            <?php
            $i=2;
            $openingBlanace=$totalCredit-$totalDebit;
            for($j=0;$j<count($data);$j++){
                $totalCredit+=$data[$j]['credit'];
                $totalDebit+=$data[$j]['debit'];

                echo '<tr><td class="text-center">'.$i.'</td><td>'.$data[$j]['date'].'</td><td >'.$data[$j]['des'].'</td><td>'.$data[$j]['debit']
                    .'</td><td>
'
                    .$data[$j]['credit'].'</td><td>'.ResolveSign($totalCredit-$totalDebit).'</td></tr>';
                $i++;
            }

            ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5" style="text-align:right; font-size:18px;">Balance</th>
                <th colspan="1"  style="font-size:18px;"><?php echo ResolveSign($totalCredit-$totalDebit); ?></th>
            </tr>
            <tr>
                <th colspan="2" style="text-align:right">Balance In Words</th>
                <th colspan="4" style="text-align:left"><?php
                    if(($totalCredit-$totalDebit)<=-1)
                        $type='Debit';
                    else
                        $type='Credit';


                    echo verifyAndInWords(convert_number_to_words($totalCredit-$totalDebit)).'   '.$type; ?> </th>
            </tr>

            </tfoot>
        </table>
        <hr>
        <div class="row">
            <p style="float:left"><b>Note:</b>&nbsp;Computer Generated Slip is invalid Without Signature and Stamp.<p style="float:right">Signature and Stamp</p>
        </div>
    </div>
</div>

</body>

</html>

