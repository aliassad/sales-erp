<?php

require_once("helpers.php");
set_time_limit(0);

if(isset($_FILES["sqlFile"]['tmp_name']))
{
//    reset_database();
    loadData();
    echo 'true';
    exit();
}

if (isset($_GET['action']) == 1){
    download_backup();
    exit();
}

if(isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 2) {
        reset_database();
        create_sampleData();
        echo 'true';
    }
    exit();
}
echo 'false';
exit();

function create_sampleData()
{

    multi_query('
INSERT INTO accountcurrency VALUES("1","PKR(Pakistan Rupee)");
INSERT INTO accountcurrency VALUES("2","AED(UAE  Dirham)");
INSERT INTO accountcurrency VALUES("3","CAD(Canadian Dollar)");
INSERT INTO accountcurrency VALUES("4","EUR(Euro)");
INSERT INTO accountcurrency VALUES("5","SAR(Saudi Riyal)");
INSERT INTO accountcurrency VALUES("6","USD(US Dollar)");
INSERT INTO accountcurrency VALUES("7","CAD(Canadian Dollar)");
INSERT INTO accountcurrency VALUES("8","EUR(Euro)");
INSERT INTO accountcurrency VALUES("9","SAR(Saudi Riyal)");
INSERT INTO accountcurrency VALUES("10","USD(US Dollar)");
INSERT INTO accounttypes VALUES("1","CASH");
INSERT INTO accounttypes VALUES("2","BANK");
INSERT INTO customer (id,name,email,phone,address)VALUES("1","Walk In Customer","a@b.com","0000-0000000","Walk In Customer");
INSERT INTO login (email,pass,role) VALUES("ali@fastsoftwaresolutions.com","5dd1a7f25b6cba5c0c56911572d978d4","Admin");
INSERT INTO login (email,pass,role) VALUES("umar@serpadmin.com","16f59172c43a2ee13072a05f91715b2e","Admin");
INSERT INTO login (email,pass,role) VALUES("saleperson@nextcable.com","0e8edc56e1a485cbcc3cf0df220de948","Sale");');
}
function reset_database()
{
 $result=query("SELECT GROUP_CONCAT(Concat('TRUNCATE TABLE ',table_schema,'.',TABLE_NAME) SEPARATOR ';') as quries  FROM INFORMATION_SCHEMA.TABLES 
 where 
 table_schema 
 in ('".DATABASE_NAME."');");
 while ($row=mysqli_fetch_array($result))
     $quries=$row['quries'];
 multi_query($quries);
}
function download_backup()
{
    $tables = '*';

    //get all of the tables
    if ($tables == '*') {
        $tables = array();
        $result = query('SHOW TABLES');
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }
    $return = '';
    //cycle through
//    $return .= 'DROP DATABASE IF EXISTS ' . DATABASE_NAME . ';';
//    $return .= "\n";
    foreach ($tables as $table) {
        $result = query('SELECT * FROM ' . $table);
        $num_fields = mysqli_num_fields($result);

//        $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
//        $row2 = mysqli_fetch_row(query('SHOW CREATE TABLE ' . $table));
//        $return .= "\n\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"' . $row[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
    }

    $date = date("d-m-Y");
    $name = DATABASE_NAME . '_' . $date;

    //add below code to download it as a sql file
    Header('Content-type: application/octet-stream');
    Header('Content-Disposition: attachment; filename=' . $name . '.sql');

    echo $return;
}
function loadData(){
    // Temporary variable, used to store current query
    $templine = '';
// Read in entire file
    $lines = file($_FILES["sqlFile"]['tmp_name']);
// Loop through each line
    foreach ($lines as $line)
    {
// Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

// Add this line to the current segment
        $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }

}
?>