<?php if (isset($_GET['page']))
    $page = $_GET['page'];
else {
    $page = "home";
}

?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="AliAsad" content="">
    <title>FAST SERP</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">

    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker.css"/>

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
     WARNING: Respond.js doesn't work if you view the page via file://
    [if lt IE 9]
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    [endif]-->
    <input type="hidden" id="CURRENCY" value="<?= CURRENCY ?>"/>
    <input type="hidden" id="CURRENCY_SIGN" value="<?= CURRENCY_SIGN ?>"/>
</head>

<body style="margin-top: 50px;">

<style>
    .col-md-1 {
        padding-left: 0px;
        padding-right: 0px;
    }

    .col-md-1 > a > span {
        font-size: 17px;

    }

    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
        padding: 2px;
        font-size: 13px;
    }

    .btn-sm {
        padding: 2px 5px;
    }

    .loader {
        position: fixed;
        background-color: #FFF;
        opacity: 1;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 10;
    }


    .home {

        /*      / background-color: #f43438;*/
    <?php
            $result=query("select t.name,t.value,c.name from themes t,company c where c.theme=t.id and c.id=2;");
            while($row=mysqli_fetch_array($result)){
            $theme=$row['value'];
            $name=$row['name'];
            }
    ?>
    }

    #page-wrapper {
        background-image: url(img/white_brick_wall.png);

    }


</style>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!--<div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        </div>-->
    <div class="navbar-inner">

        <a class="brand"><img src="img/erp.png" alt="logo"/><span style=" font-size:28px; color:#fff;">&nbsp;FAST&nbsp;SERP</span></a>
        <ul class="nav navbar-right top-nav">
        </ul>


    </div>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" style="left: 0px;" id="side_menu">
            <li id="menu">
                <a style="padding-bottom:30px; ">
                    <i class="fa  goleft fa-arrow-right" id="arrow" style="font-size:18px;">
                    </i>
                </a>
            </li>
            <li <?php if ($page == "home") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=home">
                    <i class="fa fa-home" style="font-size:18px;">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Dashboard</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "customers" || $page == "showCustomer") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=customers">
                    <i class="fa fa-group fa-5x" style="font-size:16px;">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Customers</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "vendors" || $page == "showvendor") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=vendors">
                    <i class="fa fa-id-card fa-5x" style="font-size:16px;">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Vendors</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "stock") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=stock">
                    <i class="fa fa-briefcase fa-5x" style="font-size:18px;">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Inventory</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "sell" || $page == "invoice" || $page == "showBill" || $page == "production" || $page == "editBill") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=sell">
                    <i class="fa fa-shopping-cart fa-5x" style="font-size:18px; ">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Selling</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "teppich_sell" || $page == "teppich_invoice" || $page == "teppich_showBill" || $page == "teppich_editBill") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=teppich_sell">
                    <i class="fa fa-pagelines fa-5x" style="font-size:18px; ">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Teppich Clean</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "wcustomers") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=wcustomers">
                    <i class="fa fa-map-signs fa-5x" style="font-size:18px;">
                        <b style="margin-left:0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">&nbsp;&nbsp;Walk
                            In Cus</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "members") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=members">
                    <i class="fa fa-credit-card-alt fa-5x" style="font-size:18px; ">
                        <b style="margin-left:8px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Members</b>
                    </i>
                </a>
            </li>
            <!--                    <li --><?php //if($page=="cheques" ) { ?><!-- class="active"-->
            <!--                        --><?php //} ?><!-- >-->
            <!--                            <a href="index.php?page=cheques">-->
            <!--                                <i class="fa fa-money fa-2x" style="font-size:18px; margin-left:0px;">-->
            <!--                              <b style="margin-left:10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Cheques</b>-->
            <!--                            </i>-->
            <!--                            </a>-->
            <!--                    </li>-->
            <li <?php if ($page == "accounts") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=accounts">
                    <i class="fa fa-dollar fa-5x" style="font-size:18px; margin-left:5px;">
                        <b style="margin-left:10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Accounts</b>
                    </i>
                </a>
            </li>
            <li <?php if ($page == "reports") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=reports">
                    <i class="fa fa-bar-chart fa-5x" style="font-size:18px; margin-left:5px;">
                        <b style="margin-left:0px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Reports</b>
                    </i>
                </a>
            </li>
            <?php if ($_SESSION['role'] == "Admin") { ?>
                <li <?php if ($page == "settings") { ?> class="active"<?php } ?> >
                    <a href="index.php?page=settings">
                        <i class="fa fa-gear fa-5x" style="font-size:18px; margin-left:5px;">
                            <b style="margin-left:10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Settings</b>
                        </i>
                    </a>
                </li>
            <?php } ?>
            <li <?php if ($page == "logout") { ?> class="active"
            <?php } ?> >
                <a href="index.php?page=logout">
                    <i class="fa fa-power-off fa-5x" style="font-size:18px; margin-left:5px;">
                        <b style="margin-left:10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">Log
                            out</b>
                    </i>
                </a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<div id="wrapper">
    <div class="loader">
        <center style="margin-top:10%;" style="margin-top:10%;"><img src="img/loading.gif"></center>
    </div>
    <div class="row">
        <div id="page-wrapper">
