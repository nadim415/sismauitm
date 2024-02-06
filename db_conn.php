<?php
$sname = "sql206.infinityfree.com";
$unmae = "if0_35920938";
$password = "AYFsV1p8OXwc";
$db_name = "if0_35920938_sisma";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
