<?php
date_default_timezone_set('Europe/Berlin');
define("DATABASE_NAME", "sale_erp");
define("DATABASE_SERVER", "localhost");
define("DATABASE_USER", "root");
define("DATABASE_PASS", "");
define("CURRENCY", "EURO");
define("CURRENCY_SIGN", "\xE2\x82\xAc");
function render($file, $data = array())
{
    $path = __DIR__ . "/" . $file . ".php";
    if (file_exists($path)) {
        extract($data);
        require($path);
    }
}

function query($sql)
{

    // Establishing Connection
    $connection = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_NAME) or die("Database Connection Error");

    // SQL query
    $query = mysqli_query($connection, $sql);

    if (!$query)
        echo("Error description: " . mysqli_error($connection));

    return $query;
}

function creatDatabase($name)
{
    // Establishing Connection
    $mysqli = new mysqli(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS) or die(".........");
    if ($mysqli->query("Create database if not exists " . $name)) ;
}

function multi_query($sql_data)
{
    // Establishing Connection

    $connection = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    // SQL query
    $query = mysqli_multi_query($connection, $sql_data);

    if (!$query) {
        echo "<script>alert('ERROR');</script>";
    }
}


?>