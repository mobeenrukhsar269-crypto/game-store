<?php
$serverName = "DESKTOP-L8J9UHP\SQLEXPRESS";
$database = "f230007";
$uid = "";
$pass = "";
$connection = [
    "Database" => $database,
    "uid" => $uid,
    "PWD" => $pass
];
$conn = sqlsrv_connect($serverName,$connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else
    echo 'connection established';
?>
