<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<?php

require_once("views/helpers.php");

if (isset($_SESSION['id'])) {
    header("Location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>FAST SERP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <style>
        .body_top {
            padding-top: 60px;
        }

        body {
            background-color: rgba(245, 245, 245, 1);

        }

        .vertical-offset-100 {
            padding-top: 100px;
        }

        .loginheader {
            background-color: #0074cc;
            background-image: -moz-linear-gradient(top, #0088cc, #0055cc);
            background-image: -ms-linear-gradient(top, #0088cc, #0055cc);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0055cc));
            background-image: -webkit-linear-gradient(top, #0088cc, #0055cc);
            background-image: -o-linear-gradient(top, #0088cc, #0055cc);
            background-image: linear-gradient(top, #0088cc, #0055cc);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0088cc', endColorstr='#0055cc', GradientType=0);
            border-color: #0055cc #0055cc #003580;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        }

    </style>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading ">
                    <h3 class="panel-title ">Please sign in</h3>
                </div>
                <div class="panel-body">
                    <form onsubmit="return false;">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" placeholder="E-mail" name="email" id="email" type="text"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" placeholder="Password" name="password" id="password"
                                       type="password" value="" required>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label><a>Can't access your account?</a></label>
                        </div>
                        <div id="loginError" class="form-group" style="display:none;">
                            <center>
                                <h4><label class="label label-danger">Invalid username or password</label></h4></center>
                        </div>
                        <button type="submit" id="login" class="btn btn-custom btn-lg btn-success btn-block">Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#login').click(function () {

        $.ajax({
            url: "views/login.php",
            type: "post",
            data: {
                email: $('#email').val(),
                pass: $('#password').val()
            },
            success: function (response) {

                if (response == 1) {
                    $('#loginError').css("display", "block");
                    setTimeout(function () {
                        $('#loginError').css("display", "none");
                    }, 3000);
                }
                else if (response == 2) {
                    swal({
                        title: "Welcome!", text: "You're logged in successfully :)", type: "success", timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = "index.php";
                    }, 2000);
                }
                else if (response == 3) {
                    swal({
                        title: "Welcome!", text: "You're logged in successfully :)", type: "success", timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = "index.php?page=invoice";
                    }, 2000);
                }
                else {
                    swal({
                        title: "Computer Details Mismatch!", text: response, type: "error", timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });


    });
</script>